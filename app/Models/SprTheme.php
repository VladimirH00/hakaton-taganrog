<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SprTheme
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 *
 * @package App\Models
 */
class SprTheme extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'spr_theme';
}
