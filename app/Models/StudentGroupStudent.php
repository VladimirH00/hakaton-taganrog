<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentGroupStudent
 *
 * @property int $s_student_group
 * @property int $s_student
 *
 * @property Student $student
 * @property StudentGroup $studentGroup
 *
 * @package App\Models
 */
class StudentGroupStudent extends Model
{
    use HasFactory;

    protected $table = 'student_group_student';
    public $timestamps = false;

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
    public function studentGroup()
    {
        return $this->belongsTo(StudentGroup::class, 's_student_group');
    }
}
