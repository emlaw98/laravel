@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection

@section('sidebar')
    @parent
    <h3> Home Sidebar</h3>
@endsection

@section('content')
    @if (session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <h1>Trang Chủ</h1>
@endsection

@section('css')
@endsection

@section('js')
@endsection