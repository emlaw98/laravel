@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
    
@section('content')

    @if (session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <a href=" {{ route('admin.news.addNew') }}" class="btn btn-primary">Thêm tin tức</a>
    <a href=" {{ route('admin.index') }}" class="btn btn-warning">Quay lại</a>
    {{-- --}}
    
    <hr>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th width="20%" >Tiêu đề</th>
                    <th>Nội dung</th>
                    <th width="10%">Thời gian</th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Xoá</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($newList))
                    @foreach ($newList as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->content }}</td>
                        <td>{{ $item->create_at }}</td>
                        <td>
                            <a href="{{ route('admin.news.editNew', ['id'=>$item->id]) }}" class= "btn btn-warning btn-sm" >Sửa</a>
                            {{--  --}}
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xoá không?')" href="{{ route('admin.news.deleteNew', ['id'=>$item->id]) }}" class= "btn btn-danger btn-sm" >Xoá</a>
                            {{--  --}}
                        </td>
                    </tr>
                    @endforeach               
                @else
                <tr>
                    <td colspan="6">Không có tin tức</td>
                </tr>
                @endif
            </tbody>
    </table>
    @endsection