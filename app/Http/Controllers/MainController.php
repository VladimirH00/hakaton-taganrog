<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Lesson;
use App\Models\LessonStudentGroup;
use App\Models\Student;
use App\Models\StudentGroup;
use App\Models\StudentGroupStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (Student::query()->where('s_user', '=', $user->id)->exists()) {
            $profile = Student::query()->where('s_user', '=', $user->id)->first();
            $assignment = StudentGroupStudent::query()->where('s_student', '=', $profile->id)->first();
            $group = StudentGroup::query()->find($assignment->s_student_group);
            $assignment = LessonStudentGroup::query()->where('s_student_group', '=', $group->id)->first();
            $lessons = Lesson::query()->where('id', '=', $assignment->s_lesson)->get();
        } else if (Employee::query()->where('passport', '=', $user->id)->exists()) {
            $profile = Employee::query()->where('passport', '=', $user->id)->first();
//            $lessons = Lesson::query()->where();
        } else {
            abort(401, 'Пользователь не авторизован');
        }

        return view('welcome', [
            'lessons' => $lessons,
        ]);
    }
}
