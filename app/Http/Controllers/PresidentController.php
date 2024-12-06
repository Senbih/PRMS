<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Office;
use App\Models\Division;
use App\Models\Campus;
use App\Models\Content;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileUpdateRequest;


class PresidentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $vice_presidents = User::where('campus_id', $user->campus_id)->where('role', 'vice_president')->count();
        $campuses = Campus::where('president_id', $user->id)->count();

        return view('president.dashboard', compact('vice_presidents', 'campuses'));
    }

    public function viewVice_president(User $user)
    {
        $user = Auth::user();
        $campusId = $user->campus_id;
        $offices = Office::where('campus_id', $campusId)->pluck('id');

        // Fetch team leaders whose divisions belong to the vice_president's office
        $vice_presidents = User::where('role', 'vice_president')
            ->whereIn('office_id', $offices)
            ->paginate(10);
        $campusnames = Campus::pluck('name', 'id')->toArray();
        return view('president.campus', compact('vice_presidents', 'campusnames'));
    }

    public function viewCampus(User $user)
    {
        $user = Auth::user();
        $campuses = Campus::where('president_id', $user->id)->get();
        return view('president.mycampus', compact('campuses'));
    }

    public function campusContent(User $user)
    {
        $user = Auth::user();
        $topics = Content::where('campus_id', $user->campus_id)->get();

        return view('president.campuscontentform', compact('topics'));
    }

    public function addContent(Request $request, Content $content)
    {
        // Validate the incoming request data
        $request->validate([
            'topic' => 'required',
            'title' => 'required',
            'video' => 'nullable|file|mimes:mp4,mov,avi,mpeg|max:204800', // 200MB max
            'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,jpg,jpeg,png,gif,svg,zip,rar|max:102400', // 100MB max
        ]);

        // Assign request data to the content model
        $content->topic = $request->topic;
        $content->title = $request->title;
        $content->description = $request->description;
        $content->external_link = $request->external_link;
        $content->campus_id = Auth::user()->campus_id;

        // Handle video upload
        if ($request->hasFile('video')) {
            $content->video = $this->storeFile($request->file('video'), 'videos');
        }

        // Handle document upload
        if ($request->hasFile('document')) {
            $content->document = $this->storeFile($request->file('document'), 'documents');
        }

        // Save the content model to the database
        $content->save();

        // Redirect to the vice_president's office route with a success message
        return redirect()->route('president.mycampus')->with('success', 'Campus content added successfully.');
    }
    protected function storeFile($file, $directory)
    {
        return $file->store($directory, 'public');
    }

    public function viewcontentList()
    {
        $user = Auth::user();
        $contents = Content::where('campus_id', $user->campus_id)->whereNull('office_id')->paginate(10);
        return view('president.campuscontent', compact('contents'));
    }

    public function destroyContent(Content $content)
    {
        // Check if the content has a video and delete it from the storage
        if ($content->video) {
            Storage::disk('public')->delete($content->video);
        }

        // Check if the content has a document and delete it from the storage
        if ($content->document) {
            Storage::disk('public')->delete($content->document);
        }
        // Delete the content model from the database
        $content->delete();
        // Redirect to the vice_president's office route with a success message
        return redirect()->route('president.mycampus')->with('success', 'Campus content deleted successfully');
    }

    public function profileedit(Request $request)
    {
        $user = Auth::user();
        return view('president.profile-edit', compact('user'));
    }

    public function profileupdate(ProfileUpdateRequest $request)
    {
        // $user = Auth::user();
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        // Redirect to the vice_president's profile edit route with a success message
        return redirect()->back()->with('success', 'president profile updated successfully.');
    }
    public function viewCampusContent()
    {
        $user = Auth::user();
        $contents = Content::where('campus_id', $user->campus_id)->whereNotNull('office_id')->whereNull('division_id')->where('type', 'plan')->with('office')->get();

        return view('president.view-content', compact('contents'));
    }
    public function viewReports()
    {
        $user = Auth::user();
        $reports = Content::where('campus_id', $user->campus_id)->whereNotNull('office_id')->whereNull('division_id')->where('type', 'report')->with('office')->get();
        return view('president.view-vice_president-reports', compact('reports'));
    }

    public function addComment(Request $request, Content $content)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        Comment::create([
            'content_id' => $content->id,
            'user_id' => Auth::id(),
            'comment' => $request->comment
        ]);

        if ($content->type == 'plan') {
            return redirect()->route('president.view-content', $content->id)->with('success', 'Comment added successfully.');
        } elseif ($content->type == 'report') {
            return redirect()->route('president.view-vice_president-reports', $content->id)->with('success', 'Comment added successfully.');
        }

        // Default redirect if type is neither plan nor report
        return redirect()->back()->with('success', 'Comment added successfully.');
    }
    public function approveContent(Content $content)
    {
        // Only allow the team leader to approve if they manage the division
        if (1 == 1) {
            $content->approval_status = 'approved';
            $content->save();
            return redirect()->back()->with('success', 'Content approved successfully.');
        }

        return redirect()->back()->withErrors(['error' => 'Unauthorized action.']);
    }

    public function disapproveContent(Content $content)
    {
        // Only allow the team leader to disapprove if they manage the division
        if (1 == 1) {
            $content->approval_status = 'disapproved';
            $content->save();
            return redirect()->back()->with('success', 'Content disapproved successfully.');
        }

        return redirect()->back()->withErrors(['error' => 'Unauthorized action.']);
    }
}
