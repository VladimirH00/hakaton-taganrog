<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Lesson
 *
 * @property int $id
 * @property int $s_subject
 * @property int $s_user_creator
 * @property int $s_start_lesson
 * @property int $s_theme
 *
 * @property SprSubject $subject
 * @property User $userCreator
 * @property SprPairTime $startLesson
 * @property SprTheme $theme
 *
 * @package App\Models
 */
class Lesson extends Model
{
    public $timestamps = false;
    protected $table = 'lesson';


    /**
     * Получить препода занятия.
     */
    public function subject()
    {
        return $this->belongsTo(SprSubject::class, 's_subject');
    }

    /**
     * Получить препода занятия.
     */
    public function userCreator()
    {
        return $this->belongsTo(User::class, 's_user_creator');
    }

    /**
     * Получить пару.
     */
    public function startLesson()
    {
        return $this->belongsTo(SprPairTime::class, 's_start_lesson');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function theme()
    {
        return $this->belongsTo(SprTheme::class, 's_theme');
    }
}
