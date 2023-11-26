<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_Pertanian extends Model
{
    use HasFactory;
    protected $table = 'data_pertanian';
    protected $primaryKey = 'id_pertanian';
    protected $fillable = [
        'id_pertanian',
        'id_user',
        'id_variabel',
        'kode_pertanian',
        'nilai',
        'tgl_tanam',
        'tgl_panen'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function variabel() {
        return $this->belongsTo(Variabel_Himpunan::class, 'id_variabel');
    }

    public function hasilFuzzy() {
        return $this->hasOne(Fuzzy_Hasil::class, 'kode_pertanian');
    }

}
