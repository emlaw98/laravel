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
            <label for="">Họ và tên</label>
            <input type="text" class = "form-control" name="fullname" placeholder="Họ và tên" value="{{ old('fullname') }}">
            @error('fullname')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" class = "form-control" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="">Mật khẩu</label>
            <input type="password" class = "form-control" name="password" placeholder="Mật khẩu" >
            @error('password')
            <span style="color:red">{{ $message }}</span>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="{{ route('admin.users.index') }}" class= "btn btn-warning">Quay lại</a>
        @csrf
    </form>

@endsection
