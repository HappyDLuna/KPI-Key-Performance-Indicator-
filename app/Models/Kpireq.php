<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class kpireq extends Model
{
    /** @use HasFactory<\Database\Factories\KpireqFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'id_role',
        'id_vocation',
    ];

    public function role(){
        return $this->belongsTo(Role::class, 'id_role');
    }
    public function vocation(){
        return $this->belongsTo(Vocation::class, 'id_vocation');
    }

    public function kpiquestion(){
        return $this->hasMany(Kpiquestion::class, 'id_kpi');
    }

    public function kpiscore(): HasManyThrough{
        return $this->hasManyThrough(
            Kpiscore::class,
            Kpiquestion::class,
            'id_kpi',
            'id_kpiquestion',
            'id',
            'id'
        );
    }

}
