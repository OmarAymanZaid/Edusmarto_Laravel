<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluationQuestion;
use App\Models\EvaluationResponse;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = EvaluationQuestion::all();

        return view('questions.index', ['questions' => $questions]);
    }

    public function create()
    {
        return view('questions.create');
    }

    public function store(Request $request)
    {
        $valid = $request ->validate([
            'questionText' => 'required|string|max:255',
        ]);

        $question = EvaluationQuestion::create([
            'questionText' => $valid['questionText'],
        ]);

        $question->save();

        return to_route('questions.index') ->with('success', 'Question Added Successfully !');
    }

    public function destroy($questionID)
    {
        $question = EvaluationQuestion::findOrFail($questionID);
        $question ->delete();

        return to_route('questions.index') ->with('success', 'Question Deleted Successfully !');
    }

    public function edit($questionID)
    {
        $question =  EvaluationQuestion::findOrFail($questionID);

        return view('questions.edit', ['question' => $question]);
    }

    public function update(Request $request, $questionID)
    {
        $question = EvaluationQuestion::findORFail($questionID);

        $valid = $request -> validate([
            'questionText' => 'required|string|max:255',
        ]);

        $question -> questionText = $valid['questionText'];
        $question -> save();

        return to_route('questions.index') ->with('success', 'Question Updated Successfully !');

    }

    public function showEvaluationForm($teacherID)
    {
        $questions = EvaluationQuestion::all();

        $role = auth()->user()->roleID;

        if($role == config('constants.role.STUDENT'))
            return view('questions.evaluateTeacher', ['questions' => $questions, 'teacherID' => $teacherID]);

        elseif($role == config('constants.role.TEACHER'))
            return view('questions.evaluateFellowTeacher', ['questions' => $questions, 'teacherID' => $teacherID]);

    }

    public function storeEvaluationResponse(Request $request, $teacherID)
    {
        $valid = $request ->validate([
            'evaluationResponse'   => 'required|array',
            'evaluationResponse.*' => 'required|integer|min:1|max:5',
        ]);


        $responses = $valid['evaluationResponse'];

        foreach ($responses as $questionNumber => $selectedOption) {

            EvaluationResponse::create([
                'teacherID' => $teacherID,
                'selectedOption' => $selectedOption,
            ]);
        }

        
        $role = auth()->user()->roleID;

        if($role == config('constants.role.STUDENT'))
            return to_route('teachers.index')->with('success', 'Evaluation submitted successfully!');

        elseif($role == config('constants.role.TEACHER'))
            return to_route('fellowTeachers.index')->with('success', 'Evaluation submitted successfully!');
    }

}
