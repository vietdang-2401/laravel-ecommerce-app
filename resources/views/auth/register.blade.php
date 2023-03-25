@extends('site.app')
@section('title', 'Đăng ký')
@section('content')
<section class="section-pagetop bg-dark">
    <div class="container clearfix">
        <h2 class="title-page">Đăng ký</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title mt-2">Đăng ký</h4>
                </header>
                <article class="card-body">
                    <form action="{{ route('register') }}" method="POST" role="form">
                        @csrf
                        <div class="form-row">
                            <div class="col form-group">
                                <label for="first_name">Họ</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    name="first_name" id="first_name" value="{{ old('first_name') }}">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col form-group">
                                <label for="last_name">Tên</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    name="last_name" id="last_name" value="{{ old('last_name') }}">
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Địa chỉ Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                id="email" value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Nhập lại mật khẩu</label>
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" id="password_confirmation">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <input class="form-control" type="text" name="address" id="address"
                                value="{{ old('address') }}">
                        </div>
                        <div class="form-row">
                            {{-- <div class="form-group col-md-6">
                                <label for="city">Tỉnh/Thành phố</label>
                                <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}">
                            </div> --}}
                            {{-- <div class="form-group col-md-6">
                                <label for="country">Quốc gia</label>
                                <select id="country" class="form-control" name="country">
                                    <option> Choose...</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="France">France</option>
                                    <option value="United States" selected="">United States</option>
                                </select>
                            </div> --}}
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-block"> Đăng ký </button>
                        </div>
                        {{-- <small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our
                            <br>
                            Terms of use and Privacy Policy.</small> --}}
                    </form>
                </article>
                <div class="border-top card-body text-center">Đã có tài khoản? <a href="{{ route('login') }}">Đăng
                        nhập</a>
                </div>
            </div>
        </div>
    </div>
</section>
@stop