<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class KategoriModel extends Model
{
    protected $primaryKey = 'kategori_id';
    protected $table = 'm_kategori';

    protected $fillable = ['kategori_kode', 'kategori_nama'];

}