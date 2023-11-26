<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variabel_Himpunan extends Model
{
    use HasFactory;

    protected $table = 'variabel_himpunan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'nama',
        'satuan',
        'tipe_variabel',
    ];

    public function himpunan() {
        return $this->hasMany(Fuzzy_Himpunan::class, 'id_variabel');
    }

    public function dataPertanian() {
        return $this->hasMany(Data_pertanian::class, 'id_variabel');
    }
}
