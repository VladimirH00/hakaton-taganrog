<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Question;
use App\Models\QuestionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $lessonId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, $lessonId)
    {
        $lesson = Lesson::query()->find($lessonId)->first();
        if (!Lesson::query()->find($lessonId)->exists() || $lesson->s_user_creator != Auth::user()->id) {
            abort(404);
        }
        $questionGroup = new QuestionGroup();
        $questionGroup->s_lesson = $lessonId;
        $questionGroup->name = $request->question;
        $questionGroup->duration = 30;
        $questionGroup->save();
        $buttons = ['one', 'two', 'three', 'four'];
        foreach ($buttons as $button) {
            $question = new Question([
                's_question_group' => $questionGroup->id,
                'name' => $request->$button,
                'code' => $request->$button,
                'is_true' => $button == $request->get('question-value-true'),
            ]);
            $question->save();
        }
        return redirect(route('questions', ['id' => $lessonId]));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
