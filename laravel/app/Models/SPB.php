<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPB extends Model
{
    use HasFactory;
    protected $table = 'trspbsales';
    protected $primaryKey = ['nospb'];
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    // const CREATED_AT = 'adddate';
    // const UPDATED_AT = 'editdate';
}
