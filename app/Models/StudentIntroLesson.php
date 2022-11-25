<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentIntroLesson
 *
 * @property int $id
 * @property int $s_lesson
 * @property int $s_student
 *
 * @property Lesson $lesson
 * @property Student $student
 *
 * @package App\Models
 */
class StudentIntroLesson extends Model
{
    use HasFactory;

    protected $table = 'student_intro_lesson';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 's_student');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 's_lesson');
    }
}
