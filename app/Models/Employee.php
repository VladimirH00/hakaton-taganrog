<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 *
 * @property int $id
 * @property int $s_user
 * @property string $passport
 * @property string $surname
 * @property string $first_name
 * @property string $patronymic
 * @property string $dolgn
 *
 * @property User $user
 *
 * @package App\Models
 */
class Employee extends Model
{
    use HasFactory;

    protected $table = 'employee';
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 's_user');
    }
}
