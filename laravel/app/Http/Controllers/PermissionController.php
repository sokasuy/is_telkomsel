<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;
use App\Models\Role;
use App\Models\SidebarMenu;
use Session;

class PermissionController extends Controller
{
    //
    public function index()
    {
        //
        // $datarole = Permission::get();
        // dd($datarole);
        // $hasUpdatePermission = Permission::where('role', Auth::user()->role)
        //     ->where('view', 'permission')
        //     ->where('update', true)
        //     ->exists();
        // $hasDeletePermission = Permission::where('role', Auth::user()->role)
        //     ->where('view', 'permission')
        //     ->where('delete', true)
        //     ->exists();
        $hasCreateNewPermission = Permission::checkPermission(Auth::user()->role,'authentication','permission','permission','create');
        $hasUpdatePermission = Permission::checkPermission(Auth::user()->role,'authentication','permission','permission','update');
        $hasDeletePermission = Permission::checkPermission(Auth::user()->role,'authentication','permission','permission','delete');
        return view('auth.permission', compact('hasCreateNewPermission','hasUpdatePermission','hasDeletePermission'));
        // return view('auth.permission', ['hasUpdatePermission' => $hasUpdatePermission], ['hasDeletePermission' => $hasDeletePermission]);
    }


    public function getPermissionList(Request $request)
    {
        // dd($request->search['value']);
        $datapermission = Permission::orderBy('id','desc')->get();
        // $searchValue=$request->search['value'];
        // $datapermission = Permission::orderBy('created_at','desc')->orderBy('updated_at','desc')->get();
        return response()->json(
            array(
                'status' => 'ok',
                'data' => $datapermission
            ),
            200
        );
    }

    public function addPermissions(Request $request)
    {
        $datarole = Role::select('id','role_name')->get();
        $datamenu = SidebarMenu::select('id','menu_group','menu_name','view')->get();
        return view('auth.addpermission', compact('datarole','datamenu'));
    }

    public function actionRegister(Request $request)
    {
        // Buat data permission
        // $role_name = Role::select('role_name')->where('id',$request->get('role'))->first();
        $role_name = Role::where('id',$request->get('role'))->value('role_name');
        // dd($role_name->role_name);
        // dd($role_name);

        foreach ($request->input('data_menu') as $data) {
                // Jika Anda membutuhkan lebih banyak data dari setiap $data, Anda bisa menyesuaikan sesuai kebutuhan
                $datamenu = SidebarMenu::select('id','menu_group','menu_name','view')->where('id',$data)->first();
                // dd($datamenu->menu_group);
                $newData = new Permission();
                $newData->role_id = $request->get('role');
                $newData->role = $role_name;
                $newData->sidebar_id = $datamenu->id;
                $newData->menu_group = $datamenu->menu_group;
                $newData->menu_name = $datamenu->menu_name;
                $newData->view = $datamenu->view;
                $newData->create = 'true';
                $newData->update = 'true';
                $newData->read = 'true';
                $newData->delete = 'true';
                $newData->save();
        }
        // Session::flash('message-success', 'Penambahan Role baru berhasil.');
        return redirect(route('auth.permission'))->with('message-success', 'Penambahan Permission baru berhasil!');
    }

    public function changePermission(Request $request)
    {
        //
        $id = $request->get('id');
        $data = Permission::find($id);
        return response()->json(
            array(
                'status' => 'ok',
                'msg' => view('auth.changepermission', compact('data'))->render() //untuk modal data dan view diambil dari sini
            ),
            200
        );
    }
    public function actionChangePermission(Request $request)
    {
        $id = $request->get('id');
        $create = $request->get('create');
        $read = $request->get('read');
        $update = $request->get('update');
        $delete = $request->get('delete');

        $permission = Permission::find($id);

        if ($permission) {
            $permission->update([
                'create' => $create,
                'read' => $read,
                'update' => $update,
                'delete' => $delete,
            ]);

            return response()->json(['status' => 'ok', 'msg' => 'Permissions updated successfully!']);
        }

        return response()->json(['status' => 'error', 'msg' => 'Permission not found.']);
    }
}
