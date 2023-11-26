<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Fuzzy_Hasil extends Model
{
    use HasFactory;
    protected $table = 'hasil_fuzzy';
    protected $primaryKey = 'id_hasil';
    protected $fillable = [
        'id_hasil',
        'kode_pertanian',
        'jml_prediksi',
        'jml_produksi'
    ];

    public function dataPertanian() {
        return $this->belongsTo(Data_pertanian::class, 'kode_pertanian');
    }

}
