<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SidebarMenu extends Model
{
    use HasFactory;
    protected $table = 'sidebars_menu';
    protected $fillable = [
        'menu_group',
        'menu_name',
        'view'
    ];
}
