<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Student
 *
 * @property int $id
 * @property int $s_user
 * @property string $passport
 * @property string $surname
 * @property string $first_name
 * @property string $patronymic
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

//    public function groups()
//    {
//        return $this->belongsToMany(StudentGroup::class, 'student_group_student', 'user_id', 's_');
//    }
}
