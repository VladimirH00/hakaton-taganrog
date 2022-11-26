<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubjectTheme
 *
 * @property int $s_subject
 * @property int $s_theme
 *
 * @property SprSubject $subject
 * @property SprTheme $theme
 *
 * @package App\Models
 */
class SubjectTheme extends Model
{
    use HasFactory;
    protected $table = 'subject_theme';
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(SprSubject::class, 's_subject');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function theme()
    {
        return $this->belongsTo(SprTheme::class, 's_theme');
    }
}
