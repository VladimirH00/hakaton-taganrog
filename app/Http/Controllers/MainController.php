<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Lesson;
use App\Models\LessonStudentGroup;
use App\Models\Question;
use App\Models\QuestionChoose;
use App\Models\QuestionGroup;
use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\StudentGroupStudent;
use App\Models\StudentQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = Auth::user();
        if (Student::query()->where('s_user', '=', $user->id)->exists()) {
            $profile = Student::query()->where('s_user', '=', $user->id)->first();
            $assignment = StudentGroupStudent::query()->where('s_student', '=', $profile->id)->first();
            $group = StudentGroup::query()->find($assignment->s_student_group);
            $assignment = LessonStudentGroup::query()->where('s_student_group', '=', $group->id)->first();
            $lessons = Lesson::query()->where('id', '=', $assignment->s_lesson)->orderBy('s_start_lesson')->get();
        } else if (Employee::query()->where('s_user', '=', $user->id)->exists()) {
            $profile = Employee::query()->where('s_user', '=', $user->id)->first();
            $lessons = Lesson::query()->where('s_user_creator', '=', $user->id)->orderBy('s_start_lesson')->get();
        } else {
            abort(401, 'Пользователь не авторизован');
        }

        return view('welcome', [
            'lessons' => $lessons,
            'isEmployee' => get_class($profile) == Employee::class
        ]);
    }

    /**
     * @param $lessonId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function lesson($lessonId)
    {
        $lesson = Lesson::query()->find($lessonId);
        if (!$lesson) {
            abort(404);
        }

        $questionGroups = QuestionGroup::query()->where('s_lesson', '=', $lesson->id)->get();

        return view('lesson', [
            'lesson' => $lesson,
            'questions' => $questionGroups,
        ]);
    }

    /**
     * @param $lessonId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function questions($lessonId)
    {
        $lesson = Lesson::query()->find($lessonId)->first();
        if (!Lesson::query()->find($lessonId)->exists()) {
            abort(404);
        }
        $questions = QuestionGroup::query()->where('s_lesson', '=', $lessonId)->get();
        return view('questions', [
            'lesson' => $lesson,
            'questions' => $questions,
        ]);
    }

    public function selectQuestion(Request $request, $lessonId)
    {
        $lesson = Lesson::query()->find($lessonId);
        if (!$lesson) {
            abort(404);
        }

        $questionId = $request->get('question-value-true');
        $question= Question::query()->find($questionId);
        $questionGroup = QuestionGroup::query()->find($question->s_question_group);
        $user = Auth::user();
        $student = Student::query()->where('s_user', '=', $user->id)->first();

        $questionChoose = new QuestionChoose([
            's_student' => $student->id,
            's_question_group' => $questionGroup->id,
            's_question' => $questionId,
        ]);

        $questionChoose->save();

        return redirect(route('lesson', ['id'=>$lessonId]));
    }

    public function postQuestion($questionId)
    {
        $questionGroup = QuestionGroup::query()->find($questionId);
        if (!$questionGroup) {
            abort(404);
        }

        $lesson = $questionGroup->lesson;
        if ($lesson->s_user_creator != Auth::user()->id) {
            abort(403);
        }

        $studentsGroups = LessonStudentGroup::query()->where('s_lesson', '=', $lesson->id)->get();

        foreach ($studentsGroups as $studentsGroup) {
            $studentQuestion = new StudentQuestions([
                's_question_group' => $questionGroup->id,
                's_select_group' => $studentsGroup->s_student_group,
                'created_at' => date('Y-m-d H:m:i'),
            ]);
            $studentQuestion->save();
        }

        return redirect(route('questions', ['id' => $lesson->id]));
    }
}
