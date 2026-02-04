@extends('admin.layout')

@section('title', 'Admin Dashboard')
@section('header', 'Dashboard Overview')

@section('content')
    <div class="card">
        <h2 style="margin-top:0;">Welcome back, {{ auth('admin')->user()->name ?? 'Admin' }}</h2>
        <p style="margin-bottom:0;color:#5a6473;">
            This is your admin dashboard. Use the sidebar to navigate between visits, reports, and settings.
        </p>
    </div>
@endsection
