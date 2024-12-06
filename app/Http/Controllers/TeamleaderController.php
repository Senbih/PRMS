<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentUser;
use App\Models\Division;
use App\Models\Content;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileUpdateRequest;


class TeamleaderController extends Controller
{
  public function dashboard()
  {
    $user = Auth::user();
    $staffs = User::where('dept_id', $user->dept_id)->where('role', 'staff')->count();
    $departments = Department::where('teamleader_id', $user->id)->count();

    return view('teamleader.dashboard', compact('staffs', 'departments'));
  }

  public function viewStaff(User $user)
  {
    $user = Auth::user();
    $staffs = User::where('dept_id', $user->dept_id)->where('role', 'staff')->paginate(10);
    $departmentnames = Department::pluck('name', 'id')->toArray();
    return view('teamleader.department', compact('staffs', 'departmentnames'));
  }

  public function viewDepartment(User $user)
  {
    $user = Auth::user();
    $departments = Department::where('teamleader_id', $user->id)->get();
    return view('teamleader.mydepartment', compact('departments'));
  }

  public function departmentContent(User $user)
  {
    $user = Auth::user();
    $topics = Content::where('teamleader_id', $user->id)->get();

    return view('teamleader.departmentcontentform', compact('topics'));
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
    $content->teamleader_id = Auth::id();
    $content->department_id = Auth::user()->dept_id;

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

    // Redirect to the teamleader's department route with a success message
    return redirect()->route('teamleader.mydepartment')->with('success', 'Department content added successfully.');
  }
  protected function storeFile($file, $directory)
  {
    return $file->store($directory, 'public');
  }

  public function viewcontentList()
  {
    $user = Auth::user();
    $contents = Content::where('teamleader_id', $user->id)->whereNull('staff_id')->paginate(10);
    return view('teamleader.departmentcontent', compact('contents'));
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
    // Redirect to the teamleader's department route with a success message
    return redirect()->route('teamleader.mydepartment')->with('success', 'Department content deleted successfully');
  }

  public function profileedit(Request $request)
  {
    $user = Auth::user();
    return view('teamleader.profile-edit', compact('user'));
  }

  public function profileupdate(ProfileUpdateRequest $request)
  {
    // $user = Auth::user();
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
      $request->user()->email_verified_at = null;
    }

    $request->user()->save();
    // Redirect to the teamleader's profile edit route with a success message
    return redirect()->back()->with('success', 'Teamleader profile updated successfully.');
  }
  public function viewDepartmentContent()
  {
    $user = Auth::user();
    $contents = Content::where('teamleader_id', $user->id)->whereNotNull('staff_id')->where('type', 'plan')->with('staff')->get();

    return view('teamleader.view-content', compact('contents'));
  }
  public function viewReports()
  {
    $user = Auth::user();
    $reports = Content::where('teamleader_id', $user->id)->whereNotNull('staff_id')->where('type', 'report')->with('staff')->get();
    return view('teamleader.view-staff-reports', compact('reports'));
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
      return redirect()->route('teamleader.view-content', $content->id)->with('success', 'Comment added successfully.');
    } elseif ($content->type == 'report') {
      return redirect()->route('teamleader.view-staff-reports', $content->id)->with('success', 'Comment added successfully.');
    }

    // Default redirect if type is neither plan nor report
    return redirect()->back()->with('success', 'Comment added successfully.');
  }
  public function approveContent(Content $content)
  {
    // Only allow the team leader to approve if they manage the department
    if ($content->teamleader_id == Auth::id()) {
      $content->approval_status = 'approved';
      $content->save();
      return redirect()->back()->with('success', 'Content approved successfully.');
    }

    return redirect()->back()->withErrors(['error' => 'Unauthorized action.']);
  }

  public function disapproveContent(Content $content)
  {
    // Only allow the team leader to disapprove if they manage the department
    if ($content->teamleader_id == Auth::id()) {
      $content->approval_status = 'disapproved';
      $content->save();
      return redirect()->back()->with('success', 'Content disapproved successfully.');
    }

    return redirect()->back()->withErrors(['error' => 'Unauthorized action.']);
  }

  public function createPlanForDivision()
  {
    $department = Department::where('id', Auth::user()->dept_id)->first();
    $division = Division::where('id', Auth::user()->department->division_id)->first();
    return view('teamleader.create-plan-for-division', compact('division'));
  }

  public function storePlanForDivision(Request $request)
  {
    $request->validate([
      'topic' => 'required',
      'title' => 'required',
      'description' => 'nullable',
      'video' => 'nullable|file|mimes:mp4,mov,avi,mpeg|max:204800',
      'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,jpg,jpeg,png,gif,svg,zip,rar|max:102400',
      'division_id' => 'required|exists:divisions,id',
    ]);
    $departmentId = Auth::user()->dept_id;
    $plan = new Content();
    $plan->fill($request->all());
    $plan->teamleader_id = Auth::id(); // Associate with the team leader
    $plan->department_id = $departmentId;
    $plan->division_id = $request->division_id; // Ensure it's tied to the correct division
    $plan->type = 'plan'; // Type as 'plan'
    $plan->save();

    if ($request->hasFile('video')) {
      $plan->video = $request->file('video')->store('videos', 'public');
    }

    if ($request->hasFile('document')) {
      $plan->document = $request->file('document')->store('documents', 'public');
    }

    $plan->save();

    return redirect()->route('teamleader.dashboard')->with('success', 'Plan created and sent to division successfully.');
  }

  public function createReportForDivision()
  {
    $division = Division::where('id', Auth::user()->department->division_id)->first();
    return view('teamleader.create-report-for-division', compact('division'));
  }

  public function storeReportForDivision(Request $request)
  {
    $request->validate([
      'topic' => 'required',
      'title' => 'required',
      'description' => 'nullable',
      'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,jpg,jpeg,png,gif,svg,zip,rar|max:102400',
      'division_id' => 'required|exists:divisions,id',
    ]);
    $departmentId = Auth::user()->dept_id;

    $report = new Content();
    $report->fill($request->all());
    $report->teamleader_id = Auth::id(); // Associate with the team leader
    $report->department_id = $departmentId;
    $report->division_id = $request->division_id; // Ensure it's tied to the correct division
    $report->type = 'report'; // Type as 'report'
    $report->save();

    if ($request->hasFile('document')) {
      $report->document = $request->file('document')->store('documents', 'public');
    }

    $report->save();

    return redirect()->route('teamleader.dashboard')->with('success', 'Report created and sent to division successfully.');
  }
  public function deletePlan(Content $content)
  {
    // Ensure the plan belongs to the authenticated team leader
    if ($content->teamleader_id != Auth::id() || $content->type != 'plan') {
      return redirect()->back()->withErrors(['error' => 'You are not authorized to delete this plan.']);
    }

    // Delete the associated files if they exist
    if ($content->video) {
      Storage::disk('public')->delete($content->video);
    }

    if ($content->document) {
      Storage::disk('public')->delete($content->document);
    }

    // Delete the plan
    $content->delete();

    return redirect()->route('teamleader.my-plans')->with('success', 'Plan deleted successfully.');
  }

  public function deleteReport(Content $content)
  {
    // Ensure the report belongs to the authenticated team leader
    if ($content->teamleader_id != Auth::id() || $content->type != 'report') {
      return redirect()->back()->withErrors(['error' => 'You are not authorized to delete this report.']);
    }

    // Delete the associated files if they exist
    if ($content->document) {
      Storage::disk('public')->delete($content->document);
    }

    // Delete the report
    $content->delete();

    return redirect()->route('teamleader.my-reports')->with('success', 'Report deleted successfully.');
  }
  public function myPlans()
  {
    // Fetch all plans created by the logged-in team leader
    $divisionId = Auth::user()->department->division_id;

    $plans = Content::where('teamleader_id', Auth::id())->where('type', 'plan')->where('division_id', $divisionId)->get();

    return view('teamleader.my-plans', compact('plans'));
  }

  public function myReports()
  {
    $divisionId = Auth::user()->department->division_id;
    // Fetch all reports created by the logged-in team leader
    $reports = Content::where('teamleader_id', Auth::id())->where('type', 'report')->where('division_id', $divisionId)->get();

    return view('teamleader.my-reports', compact('reports'));
  }
}
