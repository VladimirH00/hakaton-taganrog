<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class QuestionGroup
 *
 * @property int $id
 * @property int $s_lesson
 * @property string $name
 * @property int $duration
 *
 * @property Lesson $lesson
 *
 * @package App\Models
 */
class QuestionGroup extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'question';


    /**
     * Получить препода занятия.
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 's_lesson');
    }
}
