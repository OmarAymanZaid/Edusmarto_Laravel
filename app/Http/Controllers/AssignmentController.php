<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;

class AssignmentController extends Controller
{
    public function store(Request $request, $courseID)
    {
        $valid = $request ->validate([
            'assignment' => 'required|file',
        ]);

        if($request ->hasFile('assignment'))
        {
            $assignmentPath = $request->file('assignment')->store('assignments','public');
        }

        $assignment = Assignment::create([
            'studentID'           => auth()->user()->id,
            'courseID'            => $courseID,
            'name'                => $request->file('assignment')->getClientOriginalName(),
            'location'           => $assignmentPath,            
        ]);


        return to_route('courses.assignments');
    }

    public function showUploadedAssignments($courseID)
    {
        $assignments = Assignment::where('courseID', $courseID)->get();

        return view('assignmentsViews.courseAssignments', ['assignments' => $assignments]);
    }

}
