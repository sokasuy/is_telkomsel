<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\SidebarMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $datarole = Role::get();
        // dd($datarole);
        // $hasUpdateRoles = Permission::where('role', Auth::user()->role)
        //     ->where('view', 'roles')
        //     ->where('update', true)
        //     ->exists();
        // $hasDeleteRoles = Permission::where('role', Auth::user()->role)
        //     ->where('view', 'roles')
        //     ->where('delete', true)
        //     ->exists();
        // $datarole = Role::get();
        // dd($datarole);
        $hasCreateNewRoles = Permission::checkPermission(Auth::user()->role,'authentication','roles','roles','create');
        $hasUpdateRoles = Permission::checkPermission(Auth::user()->role,'authentication','roles','roles','update');
        $hasDeleteRoles = Permission::checkPermission(Auth::user()->role,'authentication','roles','roles','delete');
        return view('auth.roles', compact('hasCreateNewRoles','hasUpdateRoles','hasDeleteRoles'));
        // return view('auth.roles', ['hasUpdateRoles' => $hasUpdateRoles], ['hasDeleteRoles' => $hasDeleteRoles]);
    }

    public function addRoles(Request $request)
    {

    }
    public function actionRegister(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $datamenu = SidebarMenu::get();
        // dd($datamenu);
        return view('auth.addroles', compact('datamenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Buat data role
        // dd($request->all());
        $check = Role::select('role_name')
        ->where('role_name', '=', $request->input('role_name'))
        ->count();
        if ($check == 0) {
            // $datamenu = MenuSidebar::get();
            // foreach ($datamenu as $data) {
            //     Permission::create([
            //         'role' => $request->input('role_name'),
            //         'view' => $data['nama_menu'],
            //         'grup_menu'  => $data['grup_menu']
            //     ]);
            // }
            // foreach ($request->input('data_menu') as $data) {
            //     // Jika Anda membutuhkan lebih banyak data dari setiap $data, Anda bisa menyesuaikan sesuai kebutuhan
            //     Permission::where('role', $request->input('role_name'))
            //         ->where('view', $data)
            //         ->update(['read' => '1']);
            // }

            $role = Role::create([
                'role_name' => $request->input('role_name'),
            ]);
            Session::flash('message-success', 'Penambahan Role baru berhasil.');
        } else {
            Session::flash('message-failed', 'Penambahan Role gagal. Sudah ada role dengan nama yang sama');
        }
        return redirect(route('roles.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
        $datarole = $role::orderBy('id', 'desc')->get();
        // dd($data);
        return response()->json(
            array(
                'status' => 'ok',
                'data' => $datarole
            ),
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
