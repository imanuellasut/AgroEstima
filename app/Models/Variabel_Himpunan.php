<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variabel_Himpunan extends Model
{
    use HasFactory;

    protected $table = 'variabel_himpunan';
    protected $fillable = [
        'id',
        'nama',
        'satuan',
    ];

    public function himpunan() {
        return $this->hasMany(FuzzyHimpunan::class, 'id_variabel');
    }
}
