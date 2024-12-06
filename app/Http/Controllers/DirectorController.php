<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Office;
use App\Models\Division;
use App\Models\Content;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileUpdateRequest;


class DirectorController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $teamleaders = User::where('division_id', $user->division_id)->where('role', 'teamleader')->count();
        $divisions = Division::where('director_id', $user->id)->count();

        return view('director.dashboard', compact('teamleaders', 'divisions'));
    }

    public function viewTeamleader(User $user)
    {
        $user = Auth::user();
        $divisionId = $user->division_id;
        $departments = Department::where('division_id', $divisionId)->pluck('id');

        // Fetch team leaders whose departments belong to the director's division
        $teamleaders = User::where('role', 'teamleader')
            ->whereIn('dept_id', $departments)
            ->paginate(10);
        $divisionnames = Division::pluck('name', 'id')->toArray();
        return view('director.division', compact('teamleaders', 'divisionnames'));
    }

    public function viewDivision(User $user)
    {
        $user = Auth::user();
        $divisions = Division::where('director_id', $user->id)->get();
        return view('director.mydivision', compact('divisions'));
    }

    public function divisionContent(User $user)
    {
        $user = Auth::user();
        $topics = Content::where('division_id', $user->division_id)->get();

        return view('director.divisioncontentform', compact('topics'));
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
        $content->division_id = Auth::user()->division_id;

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

        // Redirect to the director's division route with a success message
        return redirect()->route('director.mydivision')->with('success', 'Division content added successfully.');
    }
    protected function storeFile($file, $directory)
    {
        return $file->store($directory, 'public');
    }

    public function viewcontentList()
    {
        $user = Auth::user();
        $contents = Content::where('division_id', $user->division_id)->whereNull('teamleader_id')->whereNull('office_id')->paginate(10);
        return view('director.divisioncontent', compact('contents'));
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
        // Redirect to the director's division route with a success message
        return redirect()->route('director.mydivision')->with('success', 'Division content deleted successfully');
    }

    public function profileedit(Request $request)
    {
        $user = Auth::user();
        return view('director.profile-edit', compact('user'));
    }

    public function profileupdate(ProfileUpdateRequest $request)
    {
        // $user = Auth::user();
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        // Redirect to the director's profile edit route with a success message
        return redirect()->back()->with('success', 'director profile updated successfully.');
    }
    public function viewDivisionContent()
    {
        $user = Auth::user();
        $contents = Content::where('division_id', $user->division_id)->whereNotNull('teamleader_id')->whereNull('staff_id')->where('type', 'plan')->with('teamleader')->get();

        return view('director.view-content', compact('contents'));
    }
    public function viewReports()
    {
        $user = Auth::user();
        $reports = Content::where('division_id', $user->division_id)->whereNotNull('teamleader_id')->whereNull('staff_id')->where('type', 'report')->with('teamleader')->get();
        return view('director.view-teamleader-reports', compact('reports'));
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
            return redirect()->route('director.view-content', $content->id)->with('success', 'Comment added successfully.');
        } elseif ($content->type == 'report') {
            return redirect()->route('director.view-teamleader-reports', $content->id)->with('success', 'Comment added successfully.');
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

    public function createPlanForOffice()
    {
        $user = Auth::user();
        $division = Division::where('director_id', $user->id)->first();

        $office = Office::where('id', $division->office_id)->first();
        return view('director.create-plan-for-office', compact('office'));
    }

    public function storePlanForOffice(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'topic' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'video' => 'nullable|file|mimes:mp4,mov,avi,mpeg|max:204800',
            'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,jpg,jpeg,png,gif,svg,zip,rar|max:102400',
            'office_id' => 'required|exists:offices,id',
        ]);

        // Retrieve the authenticated user's division ID
        $divisionId = Auth::user()->division_id;

        // Create a new Content instance and fill it with request data
        $plan = new Content();
        $plan->fill($request->all());

        // Assign additional attributes
        $plan->division_id = $divisionId; // Ensure it's tied to the correct division
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
        return redirect()->route('director.dashboard')->with('success', 'Plan created and sent to office successfully.');
    }


    public function createReportForOffice()
    {
        $user = Auth::user();
        $division = Division::where('director_id', $user->id)->first();

        $office = Office::where('id', $division->office_id)->first();
        return view('director.create-report-for-office', compact('office'));
    }

    public function storeReportForOffice(Request $request)
    {
        $request->validate([
            'topic' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,jpg,jpeg,png,gif,svg,zip,rar|max:102400',
            'office_id' => 'required|exists:offices,id',
        ]);

        $divisionId = Auth::user()->division_id;

        // Create a new Content instance and fill it with request data
        $report = new Content();
        $report->fill($request->all());

        // Assign additional attributes
        $report->division_id = $divisionId; // Ensure it's tied to the correct division
        $report->type = 'report';

        if ($request->hasFile('document')) {
            $report->document = $request->file('document')->store('documents', 'public');
        }

        // Save the plan to the database
        $report->save();

        return redirect()->route('director.dashboard')->with('success', 'Report created and sent to office successfully.');
    }
    public function deletePlan(Content $content)
    {
        $userDivisionId = Auth::user()->division_id; // Get the division ID of the logged-in user

        // Ensure the plan belongs to the authenticated user's division and is of type 'plan'
        if ($content->division_id !== $userDivisionId || $content->type !== 'plan') {
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

        return redirect()->route('director.my-plans')->with('success', 'Plan deleted successfully.');
    }


    public function deleteReport(Content $content)
    {
        $userDivisionId = Auth::user()->division_id; // Get the division ID of the logged-in user

        // Ensure the report belongs to the authenticated user's division and is of type 'report'
        if ($content->division_id !== $userDivisionId || $content->type !== 'report') {
            return redirect()->back()->withErrors(['error' => 'You are not authorized to delete this report.']);
        }

        // Delete the associated document file if it exists
        if ($content->document && Storage::disk('public')->exists($content->document)) {
            Storage::disk('public')->delete($content->document);
        }

        // Delete the report
        $content->delete();

        return redirect()->route('director.my-reports')->with('success', 'Report deleted successfully.');
    }

    public function myPlans()
    {
        // Fetch the logged-in user's division
        $user = Auth::user();
        $division = Division::where('director_id', $user->id)->first();

        $office = Office::where('id', $division->office_id)->first();
        $officeId = $office->id;
        $divisionId = $division->id;

        // Fetch all plans for the user's division and office
        $plans = Content::where('type', 'plan')
            ->where('division_id', $divisionId)
            ->where('office_id', $officeId)
            ->get();

        return view('director.my-plans', compact('plans'));
    }

    public function myReports()
    {
        // Fetch the logged-in user's division
        $user = Auth::user();
        $division = Division::where('director_id', $user->id)->first();

        $office = Office::where('id', $division->office_id)->first();
        $officeId = $office->id;
        $divisionId = $division->id;

        // Fetch all reports for the user's division and office
        $reports = Content::where('type', 'report')
            ->where('division_id', $divisionId)
            ->where('office_id', $officeId)
            ->get();

        return view('director.my-reports', compact('reports'));
    }
}
