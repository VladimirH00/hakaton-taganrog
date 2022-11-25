<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentQuestions
 *
 * @property int $id
 * @property int $s_question_group
 * @property int $s_select_group
 *
 * @property QuestionGroup $questionGroup
 * @property  StudentGroup $selectStudentGroup
 *
 * @package App\Models
 */
class StudentQuestions extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'student_question';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function questionGroup()
    {
        return $this->belongsTo(QuestionGroup::class, 's_question_group');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function selectStudentGroup()
    {
        return $this->belongsTo(StudentGroup::class, 's_select_group');
    }
}
