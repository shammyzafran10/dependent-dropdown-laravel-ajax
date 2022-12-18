<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\provinsi;
use App\Models\kabkota;
use App\Models\kecamatan;
use App\Models\keldes;

class dropdown extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama','id_provinsi','id_kabkota','id_kecamatan','id_keldes'
    ];

    public function DataProvinsi()
    {
        return $this->belongsTo(provinsi::class,'id_provinsi','id');
    }
    public function DataKabkota()
    {
        return $this->belongsTo(kabkota::class,'id_kabkota','id');
    }
    public function DataKecamatan()
    {
        return $this->belongsTo(kecamatan::class,'id_kecamatan','id');
    }
    public function DataKeldes()
    {
        return $this->belongsTo(keldes::class,'id_keldes','id');
    }
}
