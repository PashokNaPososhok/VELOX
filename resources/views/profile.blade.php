@extends('layouts.app')

@section('content')
<style>
    .profile-page{ padding: 34px 0 70px; }

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

    .profile-header h1{ margin: 0; font-weight: 900; position: relative; z-index: 1; }
    .profile-header p{ margin: 8px 0 0; opacity: .9; position: relative; z-index: 1; }

    .profile-card{
        border-radius: 22px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 18px 50px rgba(0,0,0,.10);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .profile-card-body{ padding: 30px 24px; }

    .profile-main{
        border-radius: 18px;
        background: #f8f9fa;
        border: 1px solid rgba(0,0,0,.06);
        padding: 22px;
        margin-bottom: 22px;
    }

    .profile-name{ font-size: 1.8rem; font-weight: 900; color: #111827; margin-bottom: 8px; }
    .profile-subtitle{ color: #6b7280; margin: 0; }

    .profile-grid{ display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }

    .profile-item{
        border-radius: 16px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        padding: 18px;
        box-shadow: 0 8px 20px rgba(0,0,0,.04);
    }

    .profile-label{ font-size: .9rem; color: #6c757d; margin-bottom: 6px; }
    .profile-value{ font-size: 1.05rem; font-weight: 800; color: #111827; word-break: break-word; }

    .orders-title{ font-weight: 900; margin-bottom: 16px; color: #111827; }

    .order-card{
        border-radius: 18px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 12px 30px rgba(0,0,0,.07);
        padding: 18px;
        height: 100%;
    }

    .order-top{ display: flex; justify-content: space-between; gap: 12px; align-items: flex-start; margin-bottom: 12px; }
    .order-car{ font-weight: 900; color: #111827; font-size: 1.1rem; }
    .order-status{ display: inline-flex; padding: 7px 11px; border-radius: 999px; background: rgba(13,110,253,.10); border: 1px solid rgba(13,110,253,.18); font-weight: 800; white-space: nowrap; }
    .order-lines{ display: grid; gap: 8px; color: #4b5563; }
    .order-line strong{ color: #111827; }
    .order-comment{ margin-top: 12px; border-radius: 14px; background: #f8f9fa; border: 1px solid rgba(0,0,0,.06); padding: 12px; color: #4b5563; white-space: pre-wrap; }
    .empty-orders{ border-radius: 18px; background: #fff; border: 1px solid rgba(0,0,0,.06); padding: 20px; color: #6c757d; text-align: center; }
    .success-message{ border-radius: 16px; background: rgba(25,135,84,.10); border: 1px solid rgba(25,135,84,.18); padding: 14px 16px; color: #146c43; font-weight: 800; margin-bottom: 18px; }


    .password-form label{ font-weight: 700; margin-bottom: 6px; }
    .password-form .form-control{ border-radius: 12px; padding: 10px 12px; }
    .password-form .btn{ border-radius: 999px; font-weight: 800; padding: 10px 18px; }
    .error-message{ color:#dc3545; font-size:.9rem; margin-top:5px; }

    @media (max-width: 768px){
        .profile-card-body{ padding: 22px 16px; }
        .profile-grid{ grid-template-columns: 1fr; }
        .profile-name{ font-size: 1.5rem; }
        .order-top{ flex-direction: column; }
    }
</style>

<div class="container profile-page">

    <div class="profile-header">
        <h1>Профиль</h1>
        <p>Личная информация и ваши заявки на аренду VELOX</p>
    </div>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <div class="profile-card">
        <div class="profile-card-body">

            <div class="profile-main">
                <div class="profile-name">
                    {{ Auth::user()->surname ?? '' }}
                    {{ Auth::user()->name ?? '' }}
                    {{ Auth::user()->patronymic ?? '' }}
                </div>
                <p class="profile-subtitle">Аккаунт пользователя в системе VELOX</p>
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
                    <div class="profile-label">Телефон</div>
                    <div class="profile-value">{{ Auth::user()->phone ?: 'Не указан' }}</div>
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

        </div>
    </div>


    <div class="profile-card">
        <div class="profile-card-body">
            <h3 class="orders-title">Смена пароля</h3>

            @if(session('password_message'))
                <div class="success-message">{{ session('password_message') }}</div>
            @endif

            <form method="POST" action="{{ route('profile.password') }}" class="password-form">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-md-4">
                        <label for="old_password" class="form-label">Старый пароль</label>
                        <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" required>
                        @error('old_password')<div class="error-message">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="password" class="form-label">Новый пароль</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')<div class="error-message">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="password_confirmation" class="form-label">Повторите пароль</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-dark">Изменить пароль</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="profile-card">
        <div class="profile-card-body">
            <h3 class="orders-title">Мои заявки на аренду</h3>

            <div class="row g-3">
                @forelse($orders as $order)
                    <div class="col-12 col-lg-6">
                        <div class="order-card">
                            <div class="order-top">
                                <div>
                                    <div class="order-car">{{ $order->car }}</div>
                                    <div class="text-muted">Заявка №{{ $order->id }}</div>
                                </div>
                                <div class="order-status">{{ $order->status }}</div>
                            </div>

                            <div class="order-lines">
                                <div class="order-line"><strong>Дата и время:</strong> {{ $order->date }} в {{ substr($order->time, 0, 5) }}</div>
                                <div class="order-line"><strong>Имя:</strong> {{ $order->name }}</div>
                                <div class="order-line"><strong>Телефон:</strong> {{ $order->phone }}</div>
                                <div class="order-line"><strong>Способ связи:</strong> {{ $order->contact_method }}</div>
                                @if($order->created_at)
                                    <div class="order-line"><strong>Создана:</strong> {{ $order->created_at }}</div>
                                @endif
                            </div>

                            @if($order->comment)
                                <div class="order-comment">{{ $order->comment }}</div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-orders">
                            У вас пока нет оформленных заявок. Выберите автомобиль в каталоге и нажмите “Забронировать авто”.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>
@endsection
