<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Division;
use App\Models\Campus;
use App\Models\User;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index()
    {
        $offices = Office::all();
        return view('admin.offices.index', compact('offices'));
    }

    public function create()
    {
        $vice_presidents = User::where('role', 'vice_president')->get();
        $divisions = Division::all();
        $campuses = Campus::all();
        return view('admin.offices.create', compact('vice_presidents', 'campuses', 'divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'vice_president_id' => 'nullable|exists:users,id',
            'campus_id' => 'nullable|exists:campuses,id'
        ]);

        // Create the office
        $office = Office::create($request->all());

        // Attach divisions to the office if provided
        if ($request->has('division_ids')) {
            $office->divisions()->attach($request->division_ids);
        }

        // Update the vice president's office_id
        if ($request->vice_president_id) {
            $vicePresident = User::find($request->vice_president_id);
            $vicePresident->office_id = $office->id;
            $vicePresident->save();
        }

        return redirect()->route('office.index')->with('success', 'Office created successfully');
    }


    public function show(Office $office) {}

    public function edit(Office $office)
    {
        $vice_presidents = User::where('role', 'vice_president')->get();
        $campuses = Campus::all();
        $divisions = Division::where('divisions.office_id', $office->id)
            ->leftJoin('users', 'divisions.director_id', '=', 'users.id')
            ->select('divisions.*', 'users.name as director_name')
            ->get();
        return view('admin.offices.edit', compact('office', 'vice_presidents', 'campuses', 'divisions'));
    }

    public function update(Request $request, Office $office)
    {
        $request->validate([
            'name' => 'required',
            'vice_president_id' => 'nullable|exists:users,id',
            'campus_id' => 'nullable|exists:campuses,id'
        ]);

        // Update the office details
        $office->update($request->all());

        // Sync the divisions if provided
        if ($request->has('division_ids')) {
            $office->divisions()->sync($request->division_ids);
        }

        // Update the vice president's office_id
        if ($request->vice_president_id) {
            $vicePresident = User::find($request->vice_president_id);
            $vicePresident->office_id = $office->id;
            $vicePresident->save();
        }

        return redirect()->route('office.index')->with('success', 'Office updated successfully');
    }


    public function destroy(Office $office)
    {
        $office->delete();
        return redirect()->route('office.index')->with('success', 'Office deleted successfully');
    }
}
