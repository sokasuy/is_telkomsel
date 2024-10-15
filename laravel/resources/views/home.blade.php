@extends('layouts.main')

@section('title')
    <title>{{ Config::get('app.name') }} | Dashboard</title>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@if ($hasReadPermission)
    @section('content')
        <div class="p-6 text-gray-900">
            {{ __("You're logged in!") }}
        </div>
    @endsection
@else
    @section('content')
        <div style="text-align: center;">
            <div style="display: flex; flex-direction: column; align-items: center;">
                <img src="{{ asset('assets/dist/img/LaravelLOGO.png') }}" alt="MedboXLOGO" height="60" width="60"
                    style="margin-bottom: 20px;">
                <h1 style="color: #868686">USER NOT AUTHORIZED</h1>
            </div>
        </div>
    @endsection
@endif

@section('jsbawah')
@endsection
