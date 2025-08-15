<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Material;
use App\Models\Assignment;
use App\Models\Course;


class FileController extends Controller
{
    // Material ///////////////////////////////////////////////////////////////////////////////////
    public function showCourseMaterial($courseID)
    {
        $materials = Material::where('courseID', $courseID)->get();

        return view('materialViews.courseMaterial', ['materials' => $materials]);
    }

    public function showCoursesToUpoadMaterial()
    {
        $teacherID = auth()->user()->id;

        $courses = Course::join('teachers_courses', 'courses.ID', '=', 'teachers_courses.courseID')
            ->where('teachers_courses.teacherID', $teacherID)
            ->select('courses.*')
            ->get();
        
        return view('materialViews.coursesToUploadMaterial', ['courses' => $courses]);
    }

    public function uploadMaterial(Request $request, $courseID)
    {
        $valid = $request ->validate([
            'material' => 'required|file',
        ]);

        if($request ->hasFile('material'))
        {
            $materialPath = $request->file('material')->store('material','public');
        }

        $material = Material::create([
            'courseID'            => $courseID,
            'name'                => $request->file('material')->getClientOriginalName(),
            'location'           => $materialPath,            
        ]);

        return to_route('materials.coursesToUploadeMaterialFor') -> with('success', 'Material Uploaded Successfully!');
    }

    public function downloadMaterial($materialID)
    {
        $material   = Material::findOrFail($materialID);
        $path       = $material ->location;
        $name       = $material ->materialCourse->name . '_Material.' . pathinfo($material->name, PATHINFO_EXTENSION);

        return Storage::disk('public')->download($path, $name);
    }

    // Assignments ///////////////////////////////////////////////////////////////////////////////
    public function uploadAssignment(Request $request, $courseID)
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


        return to_route('courses.assignments') -> with('success', 'Assignment Uploaded Successfully!');
    }

    public function showUploadedAssignments($courseID)
    {
        $assignments = Assignment::where('courseID', $courseID)->get();

        return view('assignmentsViews.courseAssignments', ['assignments' => $assignments]);
    }

    public function downloadAssignment($assignmentID)
    {
        $assignment = Assignment::findOrFail($assignmentID);
        $path       = $assignment ->location;
        $name = $assignment->assignmentUploader->name . '_Assignment.' . pathinfo($assignment->name, PATHINFO_EXTENSION);

        return Storage::disk('public')->download($path, $name);
    }
}
