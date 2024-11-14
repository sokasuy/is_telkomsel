<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    // protected $table = 'permission';
    protected $fillable = [
        'role_id',
        'role',
        'sidebar_id',
        'menu_group',
        'menu_name',
        'view',
        'create',
        'update',
        'read',
        'delete'
    ];

    public static function checkPermission($role,$menu_group,$menu_name,$view,$action)
    {
        $data = self::on()
                ->where('role', $role)
                ->where('menu_group', $menu_group)
                ->where('menu_name', $menu_name)
                ->where('view',$view)
                ->where($action, true)
                ->exists();
        return $data;
    }
}
