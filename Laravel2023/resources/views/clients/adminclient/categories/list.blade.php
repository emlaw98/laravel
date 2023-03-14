@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
    
@section('content')

    @if (session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <a href=" {{ route('admin.categories.addCategory') }}" class="btn btn-primary">Thêm danh mục</a>
    {{--  --}}
    <a href=" {{ route('admin.index') }}" class="btn btn-warning">Quay lại</a>
    
    <hr>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="10%">STT</th>
                    <th width=>Danh mục</th>
                    <th width="25%">Thời gian</th>
                    <th width="10%">Sửa</th>
                    <th width="10%">Xoá</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($categoryList))
                    @foreach ($categoryList as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->create_at }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', ['id'=>$item->id]) }}" class= "btn btn-warning btn-sm" >Sửa</a>
                            {{--  --}}
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xoá không?')" href="{{ route('admin.categories.delete', ['id'=>$item->id]) }}" class= "btn btn-danger btn-sm" >Xoá</a>
                            {{--  --}}
                        </td>
                    </tr>
                    @endforeach               
                @else
                <tr>
                    <td colspan="6">Không có danh mục</td>
                </tr>
                @endif
            </tbody>
    </table>
    @endsection