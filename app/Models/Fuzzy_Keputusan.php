<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuzzy_Keputusan extends Model
{
    use HasFactory;
    protected $table = 'fuzzy_keputusan';
    protected $primaryKey = 'id_keputusan';
    protected $fillable = [
        'id_keputusan',
        'nama_keputusan',
        'jenis_kurva',
        'kep_nilai_bawah',
        'kep_nilai_atas',
    ];
}
