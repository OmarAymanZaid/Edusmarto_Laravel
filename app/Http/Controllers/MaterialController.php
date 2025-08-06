<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Course;

class MaterialController extends Controller
{
    public function showCourseMaterial($courseID)
    {
        $materials = Material::where('courseID', $courseID)->get();

        return view('material.courseMaterial', ['materials' => $materials]);
    }

    public function showCoursesToUpoadMaterial()
    {
        $teacherID = auth()->user()->id;

        $courses = Course::join('teachers_courses', 'courses.ID', '=', 'teachers_courses.courseID')
            ->where('teachers_courses.teacherID', $teacherID)
            ->select('courses.*')
            ->get();
        
        return view('material.coursesToUploadMaterial', ['courses' => $courses]);
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


        return to_route('materials.coursesToUploadeMaterialFor');
    }

}
