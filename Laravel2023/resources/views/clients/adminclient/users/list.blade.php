@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <a href=" {{ route('admin.users.addUser') }}" class="btn btn-primary">Thêm người dùng</a>
    <a href=" {{ route('admin.index') }}" class="btn btn-warning">Quay lại</a>
    <hr>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="10%">STT</th>
                    <th>Tên danh mục</th>
                    <th width="25%">Thời gian</th>
                    <th width="10%">Sửa</th>
                    <th width="10%">Xoá</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($ad_usersList))
                    @foreach ($ad_usersList as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->fullname }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <a href="{{ route('admin.users.editUser', ['id'=>$item->id]) }}" class= "btn btn-warning btn-sm" >Sửa</a>
                            {{--  --}}
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xoá không?')" href="{{ route('admin.users.deleteUser', ['id'=>$item->id]) }}" class= "btn btn-danger btn-sm" >Xoá</a>
                            {{-- " --}}
                        </td>
                    </tr>
                    @endforeach               
                @else
                <tr>
                    <td colspan="6">Không có người dùng</td>
                </tr>
                @endif
            </tbody>
    </table>
    @endsection