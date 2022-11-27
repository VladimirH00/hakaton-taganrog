<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionChoose
 *
 *
 *
 * @package App\Models
 */
class QuestionChoose extends Model
{
    use HasFactory;
    protected $table = 'question_choose';
    public $timestamps = false;
    protected $fillable = ['s_student', 's_question_group', 's_question'];

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
    public function questionGroup()
    {
        return $this->belongsTo(QuestionGroup::class, 's_question_group');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Question::class, 's_question');
    }
}
