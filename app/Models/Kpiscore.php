<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kpiscore extends Model
{
    /** @use HasFactory<\Database\Factories\KpiscoreFactory> */
    use HasFactory;
    protected $fillable = [
        'id_kpiquestion',
        'id_user',
        'skor',
        'bukti',
        'keterangan',
        'status'
    ];

    protected $table = 'kpiscore';
    protected $primarykey = 'id';

     public function kpiquestion(){
        return $this->belongsTo(Kpiquestion::class, 'id_kpiquestion');
    }
}
