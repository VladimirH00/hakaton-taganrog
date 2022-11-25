<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 *
 * @property int $id
 * @property int $s_user
 * @property string $num_record_book
 *
 *
 * @property User $user
 *
 * @package App\Models
 */
class Student extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'student';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 's_user');
    }
}
