<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 *
 * @property int $id
 * @property int $s_question_group
 * @property string $name
 * @property $code
 * @property $is_true
 *
 *
 * @property QuestionGroup $questionGroup
 *
 * @package App\Models
 */
class Question extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'question';


    /**
     * Получить препода занятия.
     */
    public function questionGroup()
    {
        return $this->belongsTo(QuestionGroup::class, 's_question_group');
    }
}
