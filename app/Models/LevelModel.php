<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class LevelModel extends Model
{
    protected $primaryKey = 'level_id';
    protected $table = 'm_level';

    protected $fillable = ['level_kode', 'level_nama'];

}