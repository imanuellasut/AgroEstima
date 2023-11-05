<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fuzzy_aturan extends Model
{
    use HasFactory;
    protected $table = 'fuzzy_aturan';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_himpunan',
        'id_keputusan',
        'kode_aturan',
        'keterangan',
    ];

    public function himpunanFuzzy()
    {
        return $this->belongsTo(Variabel_Himpunan::class, 'id_himpunan');
    }

    public function keputusan()
    {
        return $this->belongsTo(Fuzzy_Keputusan::class, 'id_keputusan');
    }

}
