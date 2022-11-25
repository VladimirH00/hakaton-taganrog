<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LessonStudentGroup
 *
 * @property $s_lesson int
 * @property $s_student_group int
 *
 * @property Lesson $lesson
 * @property StudentGroup $studentGroup
 *
 * @package App\Models
 */
class LessonStudentGroup extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'lesson_student_group';

    /**
     * Получить препода занятия.
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 's_lesson');
    }

    /**
     * Получить препода занятия.
     */
    public function studentGroup()
    {
        return $this->belongsTo(StudentGroup::class, 's_student_group');
    }
}
