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
            <label for="">Danh mục</label>
            <input type="text" class = "form-control" name="category" placeholder="Danh mục" value="{{ old('category') }}">
            @error('category')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="{{ route('admin.categories.index') }}" class= "btn btn-warning">Quay lại</a>
        @csrf
    </form> 

@endsection
