<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuzzy_Himpunan extends Model
{
    use HasFactory;
    protected $table = 'fuzzy_himpunan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_variabel',
        'nama',
        'jenis_kurva',
        'nilai_bawah',
        'nilai_atas',
    ];

    public function variabelHimpunan()
    {
        return $this->belongsTo(Variabel_Himpunan::class, 'id_variabel');
    }

    public function fuzzyAturan()
    {
        return $this->hasOne(Fuzzy_Aturan::class, 'id_himpunan', 'id');
    }
}
