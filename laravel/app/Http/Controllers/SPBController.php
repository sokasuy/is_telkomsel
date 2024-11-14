<?php

namespace App\Http\Controllers;

use App\Models\SPB;
use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class SPBController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $hasCreateNewRecords = Permission::checkPermission(Auth::user()->role, 'sales', 'spb', 'spb', 'create');
        $hasUpdateRecords = Permission::checkPermission(Auth::user()->role, 'sales', 'spb', 'spb', 'update');
        $hasDeleteRecords = Permission::checkPermission(Auth::user()->role, 'sales', 'spb', 'spb', 'delete');

        return view('spb.index', compact('hasCreateNewRecords', 'hasUpdateRecords', 'hasDeleteRecords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SPB $sPB)
    {
        //
        $data = $sPB::getDataSPB();
        return response()->json(
            array(
                'status' => 'ok',
                'data' => $data
            ),
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SPB $sPB)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SPB $sPB)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SPB $sPB)
    {
        //
    }
}
