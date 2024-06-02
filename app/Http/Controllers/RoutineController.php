<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    public function index()
    {
        $timeEntries = TimeEntry::all();
        return response()->json($timeEntries);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'duration' => 'required|integer',
            'entry_date' => 'required|date',
        ]);

        $timeEntry = TimeEntry::create($validatedData);
        return response()->json($timeEntry, 201);
    }

    public function show($id)
    {
        $timeEntry = TimeEntry::find($id);
        if ($timeEntry) {
            return response()->json($timeEntry);
        } else {
            return response()->json(['message' => 'Time entry not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $timeEntry = TimeEntry::find($id);
        if ($timeEntry) {
            $timeEntry->update($request->all());
            return response()->json($timeEntry);
        } else {
            return response()->json(['message' => 'Time entry not found'], 404);
        }
    }

    public function destroy($id)
    {
        $timeEntry = TimeEntry::find($id);
        if ($timeEntry) {
            $timeEntry->delete();
            return response()->json(['message' => 'Time entry deleted successfully']);
        } else {
            return response()->json(['message' => 'Time entry not found'], 404 );
        }
    }
}