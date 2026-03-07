@extends('layouts.app')

@section('content')
<style>
    .auth-page{
        padding: 40px 0 70px;
    }

    .auth-header{
        margin: 18px 0 24px;
        border-radius: 18px;
        padding: 28px 22px;
        background: linear-gradient(135deg, rgba(10,12,16,1) 0%, rgba(20,24,34,1) 60%, rgba(13,110,253,.22) 100%);
        color: #fff;
        box-shadow: 0 16px 45px rgba(0,0,0,.18);
        overflow: hidden;
        position: relative;
        text-align: center;
    }

    .auth-header::after{
        content:"";
        position:absolute;
        inset:0;
        background: radial-gradient(900px 400px at 20% 40%, rgba(255,255,255,.10), rgba(255,255,255,0) 60%);
        pointer-events:none;
    }

    .auth-title{
        font-weight: 900;
        margin: 0;
        letter-spacing: .2px;
        position: relative;
        z-index: 1;
    }

    .auth-subtitle{
        margin: 8px 0 0;
        opacity: .88;
        position: relative;
        z-index: 1;
    }

    .auth-card{
        border-radius: 20px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 18px 50px rgba(0,0,0,.10);
        overflow: hidden;
    }

    .auth-card .card-header{
        background: #fff;
        border-bottom: 1px solid rgba(0,0,0,.06);
        font-weight: 800;
        font-size: 1.15rem;
        padding: 18px 24px;
    }

    .auth-card .card-body{
        padding: 30px 24px;
    }

    .col-form-label{
        font-weight: 700;
        color: #1f2937;
    }

    .form-control{
        border-radius: 14px;
        border: 1px solid rgba(0,0,0,.12);
        padding: 12px 14px;
        box-shadow: none;
    }

    .form-control:focus{
        border-color: rgba(13,110,253,.45);
        box-shadow: 0 0 0 .2rem rgba(13,110,253,.12);
    }

    .btn-primary{
        border-radius: 999px;
        padding: 11px 22px;
        font-weight: 700;
    }

    .invalid-feedback strong{
        font-weight: 600;
    }

    @media (max-width: 768px){
        .auth-card .card-body{
            padding: 22px 16px;
        }

        .col-form-label{
            text-align: left !important;
            margin-bottom: 8px;
        }
    }
</style>

<div class="container auth-page">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">

            <div class="auth-header">
                <h1 class="auth-title">Авторизация</h1>
                <p class="auth-subtitle">Войдите в аккаунт, чтобы управлять заявками и работать с каталогом автомобилей</p>
            </div>

            <div class="card auth-card">
                <div class="card-header">{{ __('Логин') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="login" class="col-md-4 col-form-label text-md-end">{{ __('Логин') }}</label>

                            <div class="col-md-6">
                                <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('name') }}" required autocomplete="login" autofocus>

                                @error('login')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Авторизоваться') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection