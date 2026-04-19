<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kpiquestion extends Model
{
    protected $fillable = [
        'id_kpi',
        'kpi',
        'target',
        'bobot',
        'keterangan'
    ];

    public function kpireqs(){
        return $this->belongsTo(Kpireq::class, 'id_kpi');
    }

    public function kpiscore(){
        return $this->hasMany(Kpiscore::class, 'id_kpiquestion');
    }
}
