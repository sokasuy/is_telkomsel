<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class SPB extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'trspbsales';
    protected $primaryKey = ['nospb'];
    public $incrementing = false;
    protected $keyType = 'string';
    // public $timestamps = true;
    // const CREATED_AT = 'adddate';
    // const UPDATED_AT = 'editdate';
    protected $fillable = [
        'nospb',
        'tglspb',
        'idksales',
        'keterangan',
        'userid'
    ];

    public static function getDataSPB()
    {
        $data = DB::table('trspbsales as s')->join('mskaryawan as k', function ($join) {
                $join->on('k.idk', '=', 's.idksales');
        })
        ->select('s.rid', 's.nospb', 's.tglspb', 's.idksales','k.nama', 's.keterangan', 's.created_at', 's.updated_at', 's.userid')
        ->OrderByDesc('rid')
        ->get();
        return $data;
    }
}
