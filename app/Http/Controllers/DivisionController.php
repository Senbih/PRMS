<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Department;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::all();
        return view('admin.divisions.index', compact('divisions'));
    }

    public function create()
    {
        $directors = User::where('role', 'director')->get();
        $offices = Office::all();
        $departments = Department::all(); // Fetch all departments
        return view('admin.divisions.create', compact('directors', 'offices', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'director_id' => 'nullable|exists:users,id',
            'office_id' => 'nullable|exists:offices,id',

        ]);

        $division = Division::create($request->all());
        // Assign the director to the division
        if ($request->director_id) {
            $director = User::find($request->director_id);
            $director->division_id = $division->id;
            $director->save();
        }
        // Optionally, assign departments to the division here if passed in the request
        if ($request->has('department_ids')) {
            $division->departments()->attach($request->department_ids);
        }

        return redirect()->route('division.index')->with('success', 'Division created successfully');
    }

    public function show(Division $division) {}

    public function edit(Division $division)
    {
        $directors = User::where('role', 'director')->get();
        $offices = Office::all();
        $departments = Department::where('departments.division_id', $division->id)
            ->leftJoin('users', 'departments.teamleader_id', '=', 'users.id')
            ->select('departments.*', 'users.name as teamleader_name')
            ->get();

        return view('admin.divisions.edit', compact('division', 'directors', 'offices', 'departments',));
    }

    public function update(Request $request, Division $division)
    {
        $request->validate([
            'name' => 'required',
            'director_id' => 'nullable|exists:users,id',
            'office_id' => 'nullable|exists:offices,id'
        ]);

        $division->update($request->all());
        // Assign the director to the division
        if ($request->director_id) {
            $director = User::find($request->director_id);
            $director->division_id = $division->id;
            $director->save();
        }
        // Optionally, reassign departments to the division
        if ($request->has('department_ids')) {
            $division->departments()->sync($request->department_ids);
        }

        return redirect()->route('division.index')->with('success', 'Division updated successfully');
    }


    public function destroy(Division $division)
    {
        $division->delete();
        return redirect()->route('division.index')->with('success', 'Division deleted successfully');
    }
}
