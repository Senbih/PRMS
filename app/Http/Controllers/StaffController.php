<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class StaffController extends Controller
{
  public function dashboard()
  {
    $user = Auth::user();

    $contents = Content::where('department_id', $user->dept_id)->whereNull('staff_id')->paginate(10);
    return view('staff.dashboard', compact('contents'));
  }
  public function createContent()
  {
    // Retrieve the logged-in user's department
    $department = Department::where('id', Auth::user()->dept_id)->first();

    // Pass the department to the view
    return view('staff.create-content', compact('department'));
  }
  public function createReport()
  {
    $department = Department::where('id', Auth::user()->dept_id)->first();
    return view('staff.create-report', compact('department'));
  }

  public function storeContent(Request $request)
  {
    $request->validate([
      'topic' => 'required',
      'title' => 'required',
      'description' => 'nullable',
      'video' => 'nullable|file|mimes:mp4,mov,avi,mpeg|max:204800', // 200MB max
      'document' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,jpg,jpeg,png,gif,svg,zip,rar|max:102400', // 100MB max
      'department_id' => 'required|exists:departments,id',
    ]);

    // Ensure the department_id belongs to the user's department
    if ($request->department_id != Auth::user()->dept_id) {
      return redirect()->back()->withErrors(['department_id' => 'Invalid department selection.']);
    }

    $content = new Content();
    $content->fill($request->all());
    $content->staff_id = Auth::id(); // Set the staff member who created it
    $content->teamleader_id = Department::find($request->department_id)->teamleader_id;
    $content->type = 'plan'; // Automatically set the team leader who can view it
    $content->save();

    // Handle video and document upload if present
    if ($request->hasFile('video')) {
      $content->video = $request->file('video')->store('videos', 'public');
    }

    if ($request->hasFile('document')) {
      $content->document = $request->file('document')->store('documents', 'public');
    }

    $content->save();

    return redirect()->route('staff.dashboard')->with('success', 'Content created and sent to department successfully.');
  }
  public function myContent()
  {
    // Fetch all content created by the logged-in staff along with comments
    $contents = Content::where('staff_id', Auth::id())
      ->where('type', 'plan')
      ->with('comments.user') // Eager load comments and the user who made the comment
      ->get();

    return view('staff.my-content', compact('contents'));
  }
  public function deleteContent(Content $content)
  {
    // Ensure the content belongs to the authenticated staff member
    if ($content->staff_id != Auth::id()) {
      return redirect()->back()->withErrors(['error' => 'You are not authorized to delete this content.']);
    }

    // Delete the associated files if they exist
    if ($content->video) {
      Storage::disk('public')->delete($content->video);
    }

    if ($content->document) {
      Storage::disk('public')->delete($content->document);
    }

    // Delete the content
    $content->delete();

    return redirect()->route('staff.my-content')->with('success', 'Content deleted successfully.');
  }


  public function storeReport(Request $request)
  {
    $request->validate([
      'topic' => 'required',
      'title' => 'required',
      'description' => 'nullable',
      'document' => 'nullable|file|mimes:pdf,doc,docx|max:102400',
      'department_id' => 'required|exists:departments,id', // 100MB max
    ]);
    if ($request->department_id != Auth::user()->dept_id) {
      return redirect()->back()->withErrors(['department_id' => 'Invalid department selection.']);
    }

    $report = new Content();
    $report->fill($request->all());
    $report->staff_id = Auth::id();
    $report->teamleader_id = Department::find($request->department_id)->teamleader_id;
    $report->type = 'report'; // Set type to report
    $report->save();

    if ($request->hasFile('document')) {
      $report->document = $request->file('document')->store('reports', 'public');
    }

    $report->save();

    return redirect()->route('staff.my-reports')->with('success', 'Report created successfully.');
  }
  public function myReports()
  {
    $reports = Content::where('staff_id', Auth::id())->where('type', 'report')->with('comments.user')->get();
    return view('staff.my-reports', compact('reports'));
  }

  public function deleteReport(Content $report)
  {
    if ($report->staff_id != Auth::id()) {
      return redirect()->back()->withErrors(['error' => 'You are not authorized to delete this report.']);
    }

    if ($report->document) {
      Storage::disk('public')->delete($report->document);
    }

    $report->delete();

    return redirect()->route('staff.my-reports')->with('success', 'Report deleted successfully.');
  }
}
