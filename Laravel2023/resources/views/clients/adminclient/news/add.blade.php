@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection

@section('content')
    @if (session('msg'))
    <div class="alert alert-success">{{ session('msg') }}</div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">Vui lòng kiểm tra lại</div>

    @endif
    <h1>{{ $title }}</h1>

    <form action="" method="POST">
        <div class="mb-3">
            <label for="">Tiêu đề</label>
            <input type="text" class = "form-control" name="title" placeholder="Tiêu đề" value="{{ old('title') }}">
            @error('title')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Nội dung</label>
            <textarea rows="10" type="text" class = "form-control" name="content" placeholder="Nội dung" value="{{ old('content') }}"></textarea>
            @error('content')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="{{ route('admin.news.index') }}" class= "btn btn-warning">Quay lại</a>
        @csrf
    </form> 

@endsection
