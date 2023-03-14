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

    <form action="{{ route('admin.news.post-editNew') }}" method="POST">
        <div class="mb-3">
            <label for="">Tiêu đề</label>
            <input type="text" class = "form-control" name="title" placeholder="Tiêu đề" value="{{ old('title') ?? $newDetail->title }}">
            @error('title')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Nội dung</label><textarea name="" id="" cols="30" rows="10"></textarea>
            <input type="text" class = "form-control" name="content" placeholder="Nội dung" value="{{ old('content') ?? $newDetail->content }}">
            @error('content')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.news.index') }}" class= "btn btn-warning">Quay lại</a>
        @csrf
    </form>

@endsection
