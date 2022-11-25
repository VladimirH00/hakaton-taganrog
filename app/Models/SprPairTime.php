<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SprPairTime
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $time
 *
 * @package App\Models
 */
class SprPairTime extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'spr_pair_time';

}
