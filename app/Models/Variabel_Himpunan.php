<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variabel_Himpunan extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'variabel_himpunan';
    protected $fillable = [
        'kode',
        'nama',
        'satuan',
    ];
}
