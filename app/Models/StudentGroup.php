<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StudentGroup
 *
 * @property int $id
 * @property string $name
 * @property int $course
 *
 * @package App\Models
 */
class StudentGroup extends Model
{
    use HasFactory;
    protected $table = 'spr_theme';
    public $timestamps = false;
}
