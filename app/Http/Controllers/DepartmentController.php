<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use App\Models\Division;
use Illuminate\Http\Request;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();

        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teamleaders = User::where('role', 'teamleader')->get();
        $divisions = Division::all();

        return view('admin.departments.create', compact('teamleaders', 'divisions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',

        ]);
        Department::create($request->all());
        return redirect()->route('department.index')->with('success', 'Department created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        // Fetch all users in the department
        $users = User::where('dept_id', $department->id)->get();

        // Fetch all users who can be assigned as a team leader
        $teamLeaders = User::where('role', 'teamleader')->get();

        $divisions = Division::all();


        return view('admin.departments.edit', compact('department', 'users', 'teamLeaders', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $department->update($request->all());
        return redirect()->route('department.index')->with('success', 'Department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('department.index')->with('success', 'Department deleted successfully');
    }

    /**
     * Assign a team leader to a department.
     */
    public function assignTeamLeader(Request $request, Department $department)
    {
        // Validate the request input
        $request->validate([
            'teamleader_id' => 'required|exists:users,id'
        ]);

        // Update the department with the selected team leader
        $department->update(['teamleader_id' => $request->teamleader_id]);

        // Fetch the user who is assigned as the team leader
        $teamLeader = User::find($request->teamleader_id);

        if ($teamLeader) {
            // Assign the user to the department
            $teamLeader->dept_id = $department->id;
            $teamLeader->save();
        }

        return redirect()->back()->with('success', 'Team Leader assigned successfully and user assigned to the department.');
    }
    public function searchUsers(Request $request)
    {
        // Search query
        $query = $request->input('query');

        // Search for all users matching the query, regardless of their department assignment
        $searchResults = User::where(function ($q) use ($query) {
            $q->where('name', 'LIKE', "%$query%")
                ->orWhere('email', 'LIKE', "%$query%");
        })->get();

        // Find the department by ID
        $department = Department::find($request->department_id);

        // Check if department exists
        if (!$department) {
            // Handle the case when the department is not found
            return redirect()->back()->with('error', 'Department not found.');
        }

        // Fetch users and team leaders
        $users = User::where('dept_id', $department->id)->get();
        $teamLeaders = User::where('role', 'teamleader')->get();

        return view('admin.departments.edit', compact('department', 'users', 'teamLeaders', 'searchResults'));
    }


    public function addMember(Department $department, User $user)
    {
        // Assign the user to the department
        $user->dept_id = $department->id;
        $user->save();

        return redirect()->back()->with('success', 'User added to the department successfully.');
    }
}
