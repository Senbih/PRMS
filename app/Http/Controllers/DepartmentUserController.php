<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentUser;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->where('role', '!=', 'user')->paginate(10);
        $departmentids = DepartmentUser::pluck('user_id')->toArray();
        $departmentnames = Department::pluck('name', 'id')->toArray();


        return view('admin.departmentUsers.index', compact('users', 'departmentids', 'departmentnames'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        $departments = Department::all();
        return view('admin.departmentUsers.create', compact('user', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $check = DepartmentUser::where('user_id', $request->user_id)->first();
        if ($check) {
            $check->delete();
        }
        $request->validate([
            'department_id' => 'required',
            'role' => 'required',
        ]);
        DepartmentUser::create($request->all());

        // Update the user with the department_id
        $user = User::find($request->user_id);
        if ($user) {
            $user->dept_id = $request->department_id;
            $user->save();
        }

        return redirect()->route('dept.users')->with('success', 'Department User assigned to department successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(DepartmentUser $departmentUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(departmentUser $departmentUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DepartmentUser $departmentUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepartmentUser $departmentUser)
    {
        //
    }
}
