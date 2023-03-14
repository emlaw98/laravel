@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
    
@section('content')

    @if (session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <a href=" " class="btn btn-primary">Thêm tin tức</a>
    {{-- {{ route('admin.news.addNew') }} --}}
    <a href=" {{ route('admin.index') }}" class="btn btn-warning">Quay lại</a>
    {{-- --}}
    
    <hr>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="5%">STT</th>
                    <th width="15%" >Tên sản phẩm</th>
                    <th width="15%">Hình ảnh</th>
                    <th >Mô tả sản phẩm</th>
                    <th width="10%">Giá</th>
                    <th width="10%">Thời gian</th>
                    <th width="5%">Sửa</th>
                    <th width="5%">Xoá</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($ProductList))
                    @foreach ($ProductList as $key => $item)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->product }}</td>
                        <td><img width="100%" src="{{ $item->img_product }}" alt=""></td>
                        <td>{{ $item->describe_product }}</td>
                        <td>{{ $item->price }} VNĐ</td>
                        <td>{{ $item->create_at }}</td>
                        <td>
                            <a  class= "btn btn-warning btn-sm" >Sửa</a>
                            {{-- href="{{ route('admin.news.editNew', ['id'=>$item->id]) }}" --}}
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn có chắc chắn muốn xoá không?')"  class= "btn btn-danger btn-sm" >Xoá</a>
                            {{-- href="{{ route('admin.news.deleteNew', ['id'=>$item->id]) }}" --}}
                        </td>
                    </tr>
                    @endforeach               
                @else
                <tr>
                    <td colspan="6">Không có sản phẩm</td>
                </tr>
                @endif
            </tbody>
    </table>
    @endsection