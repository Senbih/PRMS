<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    public function index()
    {
        $campuses = Campus::all();

        return view('admin.campuses.index', compact('campuses'));
    }

    public function create()
    {
        $presidents = User::where('role', 'president')->get();
        $offices = Office::all();
        return view('admin.campuses.create', compact('presidents', 'offices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'president_id' => 'nullable|exists:users,id'
        ]);

        $campus = Campus::create($request->all());

        // Assign the president to the campus
        if ($request->president_id) {
            $president = User::find($request->president_id);
            $president->campus_id = $campus->id;
            $president->save();
        }

        // Optionally, attach offices to the campus
        if ($request->has('office_ids')) {
            $campus->offices()->attach($request->office_ids);
        }

        return redirect()->route('campus.index')->with('success', 'Campus created successfully');
    }

    public function show(Campus $campus) {}

    public function edit(Campus $campus)
    {
        $presidents = User::where('role', 'president')->get();
        $offices = Office::where('offices.campus_id', $campus->id)
            ->leftJoin('users', 'offices.vice_president_id', '=', 'users.id')
            ->select('offices.*', 'users.name as vice_president_name')
            ->get();
        return view('admin.campuses.edit', compact('campus', 'presidents', 'offices'));
    }

    public function update(Request $request, Campus $campus)
    {
        $request->validate([
            'name' => 'required',
            'president_id' => 'nullable|exists:users,id'
        ]);

        $campus->update($request->all());

        // Assign the president to the campus
        if ($request->president_id) {
            $president = User::find($request->president_id);
            $president->campus_id = $campus->id;
            $president->save();
        }

        // Optionally, sync offices with the campus
        if ($request->has('office_ids')) {
            $campus->offices()->sync($request->office_ids);
        }

        return redirect()->route('campus.index')->with('success', 'Campus updated successfully');
    }


    public function destroy(Campus $campus)
    {
        $campus->delete();
        return redirect()->route('campus.index')->with('success', 'Campus deleted successfully');
    }
}
