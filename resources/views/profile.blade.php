@extends('layouts.app')

@section('content')
<style>
    .profile-page{
        padding: 34px 0 70px;
    }

    .profile-header{
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

    .profile-header::after{
        content:"";
        position:absolute;
        inset:0;
        background: radial-gradient(900px 400px at 20% 40%, rgba(255,255,255,.10), rgba(255,255,255,0) 60%);
        pointer-events:none;
    }

    .profile-header h1{
        margin: 0;
        font-weight: 900;
        position: relative;
        z-index: 1;
    }

    .profile-header p{
        margin: 8px 0 0;
        opacity: .9;
        position: relative;
        z-index: 1;
    }

    .profile-card{
        border-radius: 22px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 18px 50px rgba(0,0,0,.10);
        overflow: hidden;
    }

    .profile-card-body{
        padding: 30px 24px;
    }

    .profile-main{
        border-radius: 18px;
        background: #f8f9fa;
        border: 1px solid rgba(0,0,0,.06);
        padding: 22px;
        margin-bottom: 22px;
    }

    .profile-name{
        font-size: 1.8rem;
        font-weight: 900;
        color: #111827;
        margin-bottom: 8px;
    }

    .profile-subtitle{
        color: #6b7280;
        margin: 0;
    }

    .profile-grid{
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .profile-item{
        border-radius: 16px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        padding: 18px;
        box-shadow: 0 8px 20px rgba(0,0,0,.04);
    }

    .profile-label{
        font-size: .9rem;
        color: #6c757d;
        margin-bottom: 6px;
    }

    .profile-value{
        font-size: 1.05rem;
        font-weight: 800;
        color: #111827;
        word-break: break-word;
    }

    .profile-note{
        margin-top: 22px;
        border-radius: 16px;
        background: rgba(13,110,253,.06);
        border: 1px solid rgba(13,110,253,.12);
        padding: 16px;
        color: #374151;
        line-height: 1.7;
    }

    @media (max-width: 768px){
        .profile-card-body{
            padding: 22px 16px;
        }

        .profile-grid{
            grid-template-columns: 1fr;
        }

        .profile-name{
            font-size: 1.5rem;
        }
    }
</style>

<div class="container profile-page">

    <div class="profile-header">
        <h1>Профиль</h1>
        <p>Личная информация пользователя VELOX</p>
    </div>

    <div class="profile-card">
        <div class="profile-card-body">

            <div class="profile-main">
                <div class="profile-name">
                    {{ Auth::user()->surname ?? '' }}
                    {{ Auth::user()->name ?? '' }}
                    {{ Auth::user()->patronymic ?? '' }}
                </div>
                <p class="profile-subtitle">
                    Аккаунт пользователя в системе VELOX
                </p>
            </div>

            <div class="profile-grid">
                <div class="profile-item">
                    <div class="profile-label">Имя</div>
                    <div class="profile-value">{{ Auth::user()->name }}</div>
                </div>

                <div class="profile-item">
                    <div class="profile-label">Фамилия</div>
                    <div class="profile-value">{{ Auth::user()->surname }}</div>
                </div>

                <div class="profile-item">
                    <div class="profile-label">Отчество</div>
                    <div class="profile-value">{{ Auth::user()->patronymic ?: 'Не указано' }}</div>
                </div>

                <div class="profile-item">
                    <div class="profile-label">Логин</div>
                    <div class="profile-value">{{ Auth::user()->login }}</div>
                </div>

                <div class="profile-item">
                    <div class="profile-label">Почта</div>
                    <div class="profile-value">{{ Auth::user()->email }}</div>
                </div>

                <div class="profile-item">
                    <div class="profile-label">Роль</div>
                    <div class="profile-value">
                        @if(Auth::user()->role_id == 2)
                            Администратор
                        @else
                            Пользователь
                        @endif
                    </div>
                </div>
            </div>

            <div class="profile-note">
                Здесь можно будет позже добавить историю заявок, избранные автомобили или последние действия пользователя.
            </div>

        </div>
    </div>

</div>
@endsection