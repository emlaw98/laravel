@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection

{{-- @section('sidebar')
    @parent
    <h3> Products Sidebar</h3>
@endsection --}}

@section('content')
    @if (session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <h1>Sản phẩm</h1>
    {{-- <x-package-alert></x-package-alert> --}}
@endsection

@section('css')
@endsection

@section('js')
   <script>

   </script>
@endsection