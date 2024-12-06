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


class VicePresidentController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $directors = User::where('office_id', $user->office_id)->where('role', 'director')->count();
        $offices = Office::where('vice_president_id', $user->id)->count();

        return view('vice_president.dashboard', compact('directors', 'offices'));
    }

    public function viewDirector(User $user)
    {
        $user = Auth::user();
        $officeId = $user->office_id;
        $divisions = Division::where('office_id', $officeId)->pluck('id');

        // Fetch team leaders whose divisions belong to the vice_president's office
        $directors = User::where('role', 'director')
            ->whereIn('division_id', $divisions)
            ->paginate(10);
        $officenames = Office::pluck('name', 'id')->toArray();
        return view('vice_president.office', compact('directors', 'officenames'));
    }

    public function viewOffice(User $user)
    {
        $user = Auth::user();
        $offices = Office::where('vice_president_id', $user->id)->get();
        return view('vice_president.myoffice', compact('offices'));
    }

    public function officeContent(User $user)
    {
        $user = Auth::user();
        $topics = Content::where('office_id', $user->office_id)->get();

        return view('vice_president.officecontentform', compact('topics'));
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
        $content->office_id = Auth::user()->office_id;

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
        return redirect()->route('vice_president.myoffice')->with('success', 'Office content added successfully.');
    }
    protected function storeFile($file, $directory)
    {
        return $file->store($directory, 'public');
    }

    public function viewcontentList()
    {
        $user = Auth::user();
        $contents = Content::where('office_id', $user->office_id)->whereNull('division_id')->whereNull('campus_id')->paginate(10);
        return view('vice_president.officecontent', compact('contents'));
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
        return redirect()->route('vice_president.myoffice')->with('success', 'Office content deleted successfully');
    }

    public function profileedit(Request $request)
    {
        $user = Auth::user();
        return view('vice_president.profile-edit', compact('user'));
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
        return redirect()->back()->with('success', 'vice_president profile updated successfully.');
    }
    public function viewOfficeContent()
    {
        $user = Auth::user();
        $contents = Content::where('office_id', $user->office_id)->whereNotNull('division_id')->whereNull('teamleader_id')->where('type', 'plan')->with('division')->get();

        return view('vice_president.view-content', compact('contents'));
    }
    public function viewReports()
    {
        $user = Auth::user();
        $reports = Content::where('office_id', $user->office_id)->whereNotNull('division_id')->whereNull('teamleader_id')->where('type', 'report')->with('division')->get();
        return view('vice_president.view-director-reports', compact('reports'));
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
            return redirect()->route('vice_president.view-content', $content->id)->with('success', 'Comment added successfully.');
        } elseif ($content->type == 'report') {
            return redirect()->route('vice_president.view-director-reports', $content->id)->with('success', 'Comment added successfully.');
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

    public function createPlanForCampus()
    {
        $user = Auth::user();
        $office = Office::where('vice_president_id', $user->id)->first();

        $campus = Campus::where('id', $office->campus_id)->first();
        return view('vice_president.create-plan-for-campus', compact('campus'));
    }

    public function storePlanForCampus(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'topic' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'video' => 'nullable|file|mimes:mp4,mov,avi,mpeg|max:204800',
            'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,jpg,jpeg,png,gif,svg,zip,rar|max:102400',
            'campus_id' => 'required|exists:campuses,id',
        ]);

        // Retrieve the authenticated user's office ID
        $officeId = Auth::user()->office_id;

        // Create a new Content instance and fill it with request data
        $plan = new Content();
        $plan->fill($request->all());

        // Assign additional attributes
        $plan->office_id = $officeId; // Ensure it's tied to the correct office
        $plan->type = 'plan'; // Set the content type as 'plan'

        // Handle video upload if provided
        if ($request->hasFile('video')) {
            $plan->video = $request->file('video')->store('videos', 'public');
        }

        // Handle document upload if provided
        if ($request->hasFile('document')) {
            $plan->document = $request->file('document')->store('documents', 'public');
        }

        // Save the plan to the database
        $plan->save();

        // Redirect to the dashboard with a success message
        return redirect()->route('vice_president.dashboard')->with('success', 'Plan created and sent to office successfully.');
    }


    public function createReportForCampus()
    {
        $user = Auth::user();
        $office = Office::where('vice_president_id', $user->id)->first();

        $campus = Campus::where('id', $office->campus_id)->first();
        return view('vice_president.create-report-for-campus', compact('campus'));
    }

    public function storeReportForCampus(Request $request)
    {
        $request->validate([
            'topic' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,jpg,jpeg,png,gif,svg,zip,rar|max:102400',
            'campus_id' => 'required|exists:campuses,id',
        ]);

        $officeId = Auth::user()->office_id;

        // Create a new Content instance and fill it with request data
        $report = new Content();
        $report->fill($request->all());

        // Assign additional attributes
        $report->office_id = $officeId; // Ensure it's tied to the correct office
        $report->type = 'report';

        if ($request->hasFile('document')) {
            $report->document = $request->file('document')->store('documents', 'public');
        }

        // Save the plan to the database
        $report->save();

        return redirect()->route('vice_president.dashboard')->with('success', 'Report created and sent to campus successfully.');
    }
    public function deletePlan(Content $content)
    {
        $userOfficeId = Auth::user()->office_id; // Get the office ID of the logged-in user

        // Ensure the plan belongs to the authenticated user's office and is of type 'plan'
        if ($content->office_id !== $userOfficeId || $content->type !== 'plan') {
            return redirect()->back()->withErrors(['error' => 'You are not authorized to delete this plan.']);
        }

        // Delete the associated video file if it exists
        if ($content->video && Storage::disk('public')->exists($content->video)) {
            Storage::disk('public')->delete($content->video);
        }

        // Delete the associated document file if it exists
        if ($content->document && Storage::disk('public')->exists($content->document)) {
            Storage::disk('public')->delete($content->document);
        }

        // Delete the plan
        $content->delete();

        return redirect()->route('vice_president.my-plans')->with('success', 'Plan deleted successfully.');
    }


    public function deleteReport(Content $content)
    {
        $userOfficeId = Auth::user()->office_id; // Get the office ID of the logged-in user

        // Ensure the report belongs to the authenticated user's office and is of type 'report'
        if ($content->office_id !== $userOfficeId || $content->type !== 'report') {
            return redirect()->back()->withErrors(['error' => 'You are not authorized to delete this report.']);
        }

        // Delete the associated document file if it exists
        if ($content->document && Storage::disk('public')->exists($content->document)) {
            Storage::disk('public')->delete($content->document);
        }

        // Delete the report
        $content->delete();

        return redirect()->route('vice_president.my-reports')->with('success', 'Report deleted successfully.');
    }

    public function myPlans()
    {
        // Fetch the logged-in user's office
        $user = Auth::user();
        $office = Office::where('vice_president_id', $user->id)->first();

        $campus = Campus::where('id', $office->campus_id)->first();
        $campusId = $campus->id;
        $officeId = $office->id;

        // Fetch all plans for the user's office and campus
        $plans = Content::where('type', 'plan')
            ->where('office_id', $officeId)
            ->where('campus_id', $campusId)
            ->get();

        return view('vice_president.my-plans', compact('plans'));
    }

    public function myReports()
    {
        // Fetch the logged-in user's office
        $user = Auth::user();
        $office = Office::where('vice_president_id', $user->id)->first();

        $campus = Campus::where('id', $office->campus_id)->first();
        $campusId = $campus->id;
        $officeId = $office->id;

        // Fetch all reports for the user's office and campus
        $reports = Content::where('type', 'report')
            ->where('office_id', $officeId)
            ->where('campus_id', $campusId)
            ->get();

        return view('vice_president.my-reports', compact('reports'));
    }
}
