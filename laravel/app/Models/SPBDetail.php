<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPBDetail extends Model
{
    use HasFactory;
    protected $table = 'trspbsales';
    protected $primaryKey = ['nospb','kodeitem'];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'nospb',
        'kodeitem',
        'namaitem',
        'qty',
        'satuan',
        'keterangan',
        'userid'
    ];
}
