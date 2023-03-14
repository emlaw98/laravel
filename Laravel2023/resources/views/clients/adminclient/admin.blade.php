@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection

@section('content')
    <hr>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="30%">STT</th>
                    <th>Quản lý</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th width="30%">1</th>
                    <th><a href="{{ route('admin.categories.index') }}" style="none">Danh mục</a></th>
                </tr>

                <tr>
                    <th width="30%">2</th>
                    <th><a href="{{ route('admin.users.index') }}" style="none">Người dùng</a></th>
                    {{--  --}}
                </tr>
                
                <tr>
                    <th width="30%">3</th>
                    <th><a href="{{ route('admin.news.index') }}" style="none">Tin tức</a></th>
                </tr>
            </tbody>
    </table>
    @endsection