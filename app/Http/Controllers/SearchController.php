<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\DepartmentUser;
use App\Models\Content;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchContent(Request $request)
    {
        $search = $request->input('search');
        $contents = Content::whereNotNull('department_id')
            ->where(function ($query) use ($search) {
                $query->where('topic', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('teamleader.departmentcontent', compact('contents'));
    }
    public function searchContentd(Request $request)
    {
        $search = $request->input('search');
        $contents = Content::whereNotNull('division_id')->whereNull('office_id')->whereNull('department_id')
            ->where(function ($query) use ($search) {
                $query->where('topic', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('director.divisioncontent', compact('contents'));
    }
    public function searchContentv(Request $request)
    {
        $search = $request->input('search');
        $contents = Content::whereNotNull('office_id')->whereNull('campus_id')->whereNull('division_id')
            ->where(function ($query) use ($search) {
                $query->where('topic', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('vice_president.officecontent', compact('contents'));
    }
    public function searchContentp(Request $request)
    {
        $search = $request->input('search');
        $contents = Content::whereNotNull('campus_id')->whereNull('office_id')
            ->where(function ($query) use ($search) {
                $query->where('topic', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('president.campuscontent', compact('contents'));
    }
    public function searchStaff(Request $request)
    {
        $search = $request->input('search');
        $staffs = User::where('name', 'like', '%' . $search . '%')

            ->paginate(10);
        $departmentnames = Department::pluck('name', 'id')->toArray();
        return view('teamleader.department', compact('staffs', 'departmentnames'));
    }

    public function adminSearchUser(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('role', 'like', '%' . $search . '%')
            ->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    public function adminSearchDepartmentUser(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('role', 'like', '%' . $search . '%')
            ->paginate(10);
        $departmentids = DepartmentUser::pluck('user_id')->toArray();
        $departments = Department::pluck('name', 'id')->toArray();

        return view('admin.departmentUsers.index', compact('users', 'departmentids', 'departmentnames'));
    }
}
