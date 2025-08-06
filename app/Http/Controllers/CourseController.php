<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\StudentCourses;
use App\Models\TeachersCourses;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', ['courses' => $courses]);
    }


    public function show($courseID)
    {
        $course = Course::findOrFail($courseID);

        return view('courses.show', ['course' => $course]);
    }


    public function create()
    {
        $categories = Category::all();
        return view('courses.create', ['categories' => $categories]);
    }


    public function store(Request $request)
    {
        $valid = $request ->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'required|string|max:255',
            'categoryID'     => 'required|exists:categories,id',
            'image'          => 'required|image',
        ]);

        if($request ->hasFile('image'))
        {
            $image = $request->file('image')->store('','public');
        }

        $course = Course::create([
            'name'           => $valid['name'],
            'description'    => $valid['description'],
            'categoryID'     => $valid['categoryID'],
            'image'          => $image,            
        ]);

        return to_route('courses.index') ->with('success', 'Course created successfully !');
    }


    public function edit($courseID)
    {
        $course = Course::findOrFail($courseID);
        $categories = Category::all();

        return view('courses.edit', ['course' => $course, 'categories' => $categories]);
    }


    public function update(Request $request, $courseID)
    {
        $course = Course::findOrFail($courseID);

        $valid = $request ->validate([
            'name'           => 'required|string|max:255',
            'description'    => 'required|string|max:255',
            'categoryID'     => 'required|exists:categories,id',
            'image'          => 'required|image',
        ]);

        if($request ->hasFile('image'))
        {
            $image = $request->file('image')->store('','public');
        }

        $course->name        = $valid['name'];
        $course->description = $valid['description'];
        $course->categoryID  = $valid['categoryID'];
        $course->image       = $image;

        $course->save();

        return to_route('courses.show', $courseID)->with('success', 'Course updated successfully !');
    }


    public function destroy($courseID)
    {
        $course = Course::findOrFail($courseID);
        $course->delete();
        
        return to_route('courses.index')->with('success', 'Course deleted successfully !');
    }


    public function viewEnrolledCourses()
    {
        $studentID = auth()->user()->id;

        $courses = Course::join('student_courses', 'courses.ID', '=', 'student_courses.courseID')
            ->where('student_courses.studentID', $studentID)
            ->select('courses.*')
            ->get();
        
        return view('coursesViews.enrolledCourses', ['courses' => $courses]);
    }


    public function viewCoursesForStudents()
    {
        $studentID = auth()->user()->id;

        $courses = Course::leftJoin('student_courses', 'courses.ID', '=', 'student_courses.courseID')
            ->where(function ($query) use ($studentID) {
                $query->where('student_courses.studentID', '!=', $studentID)
                    ->orWhereNull('student_courses.studentID');
            })
            ->whereNotIn('courses.ID', function ($query) use ($studentID) {
                $query->select('courseID')
                    ->from('student_courses')
                    ->where('studentID', $studentID);
            })
            ->select('courses.*')
            ->get();

        return view('coursesViews.coursesForStudents', ['courses' => $courses]);
    }


    public function enrollInCourse($courseID)
    {
        $studentCourse = new StudentCourses;

        $studentCourse->studentID = auth()->user()->id;
        $studentCourse->courseID  = $courseID;

        $studentCourse ->save();

        return to_route('courses.enrolledCourses') -> with('success', 'Successful Enrollment !');

    }


    public function dropCourse($courseID)
    {
        $studentID = auth()->user()->id;

        StudentCourses::where('courseID', $courseID)
                     ->where('studentID', $studentID)
                     ->delete();

        return to_route('courses.enrolledCourses') -> with('success', 'Course Dropped !');
    }

    public function showEnrolledCoursesForAssignments()
    {
        $studentID = auth()->user()->id;

        $courses = Course::join('student_courses', 'courses.ID', '=', 'student_courses.courseID')
            ->where('student_courses.studentID', $studentID)
            ->select('courses.*')
            ->get();
            
        return view('coursesViews.coursesUploadAssignments', ['courses' => $courses]);
    }

    public function showAssignedCourses()
    {
        $teacherID = auth()->user()->id;

        $courses = Course::join('teachers_courses', 'courses.ID', '=', 'teachers_courses.courseID')
            ->where('teachers_courses.teacherID', $teacherID)
            ->select('courses.*')
            ->get();

        return view('coursesViews.assignedCourses', ['courses' => $courses]);
    }

    public function showCoursesToTeach()
    {
        $teacherID = auth()->user()->id;

        $courses = Course::leftJoin('teachers_courses', 'courses.ID', '=', 'teachers_courses.courseID')
            ->where(function ($query) use ($teacherID) {
                $query->where('teachers_courses.teacherID', '!=', $teacherID)
                    ->orWhereNull('teachers_courses.teacherID');
            })
            ->whereNotIn('courses.ID', function ($query) use ($teacherID) {
                $query->select('courseID')
                    ->from('teachers_courses')
                    ->where('teacherID', $teacherID);
            })
            ->select('courses.*')
            ->get();

        return view('coursesViews.coursesToTeach', ['courses' => $courses]);
    }

    public function applyToTeachCourse($courseID)
    {
        $teacherCourse = new TeachersCourses;

        $teacherCourse->teacherID = auth()->user()->id;
        $teacherCourse->courseID  = $courseID;

        $teacherCourse ->save();

        return to_route('courses.assignedCourses') -> with('success', 'Course Assigned To You Successfully !');
    }

    public function cancelTeachingCourse($courseID)
    {
        $teacherID = auth()->user()->id;

        TeachersCourses::where('courseID', $courseID)
                     ->where('teacherID', $teacherID)
                     ->delete();

        return to_route('courses.assignedCourses') -> with('success', 'Course Cancelled Successfully !');
    }

    public function showAssignedCoursesForAssignments()
    {
        $teacherID = auth()->user()->id;

        $courses = Course::join('teachers_courses', 'courses.ID', '=', 'teachers_courses.courseID')
            ->where('teachers_courses.teacherID', $teacherID)
            ->select('courses.*')
            ->get();

        return view('coursesViews.assignedCoursesForAssignments', ['courses' => $courses]);
    }

}
