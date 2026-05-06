@extends('layouts.app')

@section('content')
@php
    $user = Auth::user();
    $fullName = trim(($user->surname ?? '') . ' ' . ($user->name ?? '') . ' ' . ($user->patronymic ?? ''));
    if($fullName === '') $fullName = $user->name ?? '';

    $carValue = old('car') ?: ($selectedCar ? $selectedCar->name . ' ' . $selectedCar->model : (request('car') ?: request('segment')));
    $productId = old('product_id') ?: ($selectedCar->id ?? request('car_id'));
@endphp
<style>
    .testdrive-page{ padding: 34px 0 70px; }

    .testdrive-header{
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

    .testdrive-header::after{
        content:"";
        position:absolute;
        inset:0;
        background: radial-gradient(900px 400px at 20% 40%, rgba(255,255,255,.10), rgba(255,255,255,0) 60%);
        pointer-events:none;
    }

    .testdrive-header h1{ margin: 0; font-weight: 900; position: relative; z-index: 1; }
    .testdrive-header p{ margin: 8px 0 0; opacity: .9; position: relative; z-index: 1; }

    .testdrive-card{
        border-radius: 22px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 18px 50px rgba(0,0,0,.10);
        overflow: hidden;
    }

    .testdrive-card-body{ padding: 30px 24px; }
    .form-label{ font-weight: 700; color: #1f2937; margin-bottom: 8px; }

    .form-control,
    .form-select{
        border-radius: 14px;
        border: 1px solid rgba(0,0,0,.12);
        padding: 12px 14px;
        box-shadow: none;
    }

    .form-control:focus,
    .form-select:focus{
        border-color: rgba(13,110,253,.45);
        box-shadow: 0 0 0 .2rem rgba(13,110,253,.12);
    }

    .info-box{
        border-radius: 16px;
        background: #f8f9fa;
        border: 1px solid rgba(0,0,0,.06);
        padding: 16px;
        color: #4b5563;
        line-height: 1.7;
    }

    .account-box{
        border-radius: 16px;
        background: rgba(13,110,253,.06);
        border: 1px solid rgba(13,110,253,.14);
        padding: 16px;
        color: #374151;
        line-height: 1.7;
        margin-bottom: 18px;
    }

    .submit-btn{ border-radius: 999px; padding: 12px 22px; font-weight: 700; min-width: 220px; }
    .success-message{ margin-top: 14px; color: #198754; font-weight: 600; text-align: center; }
    .error-message{ margin-top: 8px; color: #dc3545; font-weight: 600; }

    @media (max-width: 768px){ .testdrive-card-body{ padding: 22px 16px; } }
</style>

<div class="container testdrive-page">

    <div class="testdrive-header">
        <h1>Заявка на аренду автомобиля</h1>
        <p>Оформление доступно только после входа в аккаунт, чтобы заявка появилась в вашем профиле</p>
    </div>

    <div class="testdrive-card">
        <div class="testdrive-card-body">
            <div class="account-box">
                Данные имени и телефона подставлены из аккаунта. Их можно изменить прямо перед отправкой, если в профиле указано что-то случайное или устаревшее.
            </div>

            <form method="POST" action="{{ route('addcontact') }}">
                @csrf
                <input type="hidden" name="product_id" value="{{ $productId }}">

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label">Имя</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $fullName) }}" placeholder="Введите имя" required>
                        @error('name')<div class="error-message">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone ?? '') }}" placeholder="+7..." required>
                        @error('phone')<div class="error-message">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="car" class="form-label">Автомобиль или пожелание</label>
                        <input type="text" class="form-control @error('car') is-invalid @enderror" id="car" name="car" value="{{ $carValue }}" placeholder="Например: BMW M5 F90 или бизнес-класс" required>
                        @error('car')<div class="error-message">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="date" class="form-label">Дата получения</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" required>
                        @error('date')<div class="error-message">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="time" class="form-label">Время получения</label>
                        <input type="time" class="form-control @error('time') is-invalid @enderror" id="time" name="time" value="{{ old('time') }}" required>
                        @error('time')<div class="error-message">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="contact_method" class="form-label">Удобный способ связи</label>
                        <select class="form-select @error('contact_method') is-invalid @enderror" id="contact_method" name="contact_method" required>
                            @foreach(['Телефон','Telegram','WhatsApp','Почта'] as $method)
                                <option value="{{ $method }}" {{ old('contact_method') == $method ? 'selected' : '' }}>{{ $method }}</option>
                            @endforeach
                        </select>
                        @error('contact_method')<div class="error-message">{{ $message }}</div>@enderror
                    </div>

                    <div class="col-12">
                        <label for="comment" class="form-label">Комментарий</label>
                        <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Например: нужна выдача утром, детское кресло или связь через Telegram">{{ old('comment') }}</textarea>
                    </div>

                    <div class="col-12">
                        <div class="info-box">
                            После отправки заявка появится в вашем профиле. Менеджер VELOX проверит статус автомобиля и подтвердит выдачу.
                        </div>
                    </div>

                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="btn btn-dark submit-btn">Отправить заявку на аренду</button>
                    </div>

                    @if(session('success'))
                        <div class="col-12">
                            <div class="success-message">{{ session('success') }}</div>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
