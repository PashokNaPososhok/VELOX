@extends('layouts.app')

@section('content')
@php
    $segment = $array->segment ?? 'Комфорт';
    $color = $array->color ?? 'Не указан';
    $transmission = $array->transmission ?? 'Автомат';
    $fuel = $array->fuel_type ?? 'Бензин';
    $drive = $array->drive_type ?? 'Передний';
    $condition = (int)($array->condition_percent ?? 90);
    $seats = $array->seats ?? 5;
    $dailyCost = (int)preg_replace('/\D+/', '', (string)$array->cost);
    $deposit = $array->deposit ?? max(0, $dailyCost * 3);
    $status = $array->availability_status ?? 'Свободен';
    $bodyType = $array->body_type ?? 'Не указан';
    $enginePower = $array->engine_power ?? 'Не указано';
    $engineVolume = $array->engine_volume ?? 'Не указано';
    $fuelConsumption = $array->fuel_consumption ?? 'Не указано';
@endphp
<style>
    .car-page{ padding: 30px 0 60px; }
    .car-title{ font-weight: 900; margin: 40px 0 30px; letter-spacing: .3px; }

    .car-main{
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 18px 50px rgba(0,0,0,.10);
        padding: 24px;
    }

    .car-img{ width: 100%; height: 380px; object-fit: cover; border-radius: 16px; border: 1px solid rgba(0,0,0,.06); }
    .car-side{ height: 100%; display: flex; flex-direction: column; justify-content: center; }

    .price-box{
        display: inline-flex;
        width: fit-content;
        align-items: center;
        gap: 10px;
        padding: 10px 16px;
        border-radius: 999px;
        background: rgba(13,110,253,.10);
        border: 1px solid rgba(13,110,253,.18);
        font-weight: 900;
        font-size: 1.2rem;
        color: rgba(10,12,16,1);
        margin-bottom: 16px;
    }

    .quick-rent{ display:flex; flex-wrap:wrap; gap:10px; margin-bottom: 18px; }
    .quick-chip{
        display:inline-flex;
        align-items:center;
        padding:8px 14px;
        border-radius:999px;
        background:#f3f4f6;
        border:1px solid rgba(0,0,0,.06);
        color:#374151;
        font-weight:700;
    }

    .order-btn{ border-radius: 999px; padding: 12px 22px; font-weight: 700; }
    .section-title{ font-weight: 900; margin: 60px 0 30px; }

    .car-description{
        border-radius: 20px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 12px 30px rgba(0,0,0,.06);
        padding: 22px 24px;
        line-height: 1.9;
        font-size: 1rem;
        color: #374151;
        white-space: pre-wrap;
        word-break: break-word;
    }

    .spec-card{
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,.06);
        background: #f8f9fa;
        padding: 18px;
        text-align: center;
        transition: transform .15s ease, box-shadow .15s ease;
        height: 100%;
    }

    .spec-card:hover{ transform: translateY(-3px); box-shadow: 0 12px 30px rgba(0,0,0,.08); }
    .spec-label{ font-size: .9rem; color: #6c757d; margin-bottom: 6px; }
    .spec-value{ font-weight: 800; font-size: 1.05rem; color: #111827; }

    .condition-panel{
        border-radius: 20px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 12px 30px rgba(0,0,0,.06);
        padding: 22px 24px;
    }

    .condition-head{ display:flex; justify-content:space-between; gap:16px; align-items:center; margin-bottom:14px; }
    .condition-title{ font-weight:900; font-size:1.15rem; }
    .condition-percent{ font-weight:900; font-size:1.8rem; color:#0d6efd; }
    .condition-track{ height: 14px; border-radius:999px; background:#e9ecef; overflow:hidden; }
    .condition-fill{ height:100%; border-radius:999px; background: linear-gradient(90deg, #198754, #0d6efd); }

    .condition-details{ display:grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap:12px; margin-top:16px; }
    .condition-item{ border-radius:14px; background:#f8f9fa; border:1px solid rgba(0,0,0,.06); padding:14px; }
    .condition-item strong{ display:block; color:#111827; margin-bottom:4px; }
    .condition-item span{ color:#6c757d; font-size:.95rem; }

    @media (max-width: 992px){
        .car-img{ height: 260px; }
        .car-side{ align-items: flex-start; }
        .condition-details{ grid-template-columns: 1fr; }
    }
</style>

<div class="container car-page">

    <div class="text-center">
        <h1 class="car-title">{{$array->name}} {{$array->model}}</h1>
    </div>

    <div class="car-main">
        <div class="row align-items-center g-4">
            <div class="col-md-5">
                <img src="{{ asset(ltrim($array->image, '/')) }}" class="car-img" alt="Автомобиль {{$array->name}}">
            </div>

            <div class="col-md-7">
                <div class="car-side">
                    <div class="price-box">от {{$array->cost}} ₽/сутки</div>

                    <div class="quick-rent">
                        <span class="quick-chip">{{$segment}}</span>
                        <span class="quick-chip">Статус: {{$status}}</span>
                        <span class="quick-chip">Залог: {{$deposit}} ₽</span>
                        <span class="quick-chip">Цвет: {{$color}}</span>
                    </div>

                    @if($status === 'Свободен')
                        <form action="{{ route('contact') }}" method="GET">
                            <input type="hidden" name="car_id" value="{{ $array->id }}">
                            <input type="hidden" name="car" value="{{ $array->name }} {{ $array->model }}">
                            <input type="hidden" name="segment" value="{{ $segment }}">
                            <input type="hidden" name="color" value="{{ $color }}">
                            <input type="hidden" name="condition_percent" value="{{ $condition }}">
                            <button type="submit" class="btn btn-dark order-btn">@auth Забронировать авто @else Войти и забронировать @endauth</button>
                        </form>
                    @else
                        <button type="button" class="btn btn-secondary order-btn" disabled>Автомобиль занят</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="text-center"><h2 class="section-title">Описание аренды</h2></div>

    <div class="car-description">
        @if($array->description)
            {{$array->description}}
        @else
            Автомобиль доступен для краткосрочной аренды. Подходит для городских поездок, встреч и небольших путешествий. Перед выдачей машина проходит осмотр, мойку и базовую проверку.
        @endif
    </div>

    <div class="text-center"><h2 class="section-title">Состояние автомобиля</h2></div>

    <div class="condition-panel">
        <div class="condition-head">
            <div>
                <div class="condition-title">Общий рейтинг состояния</div>
                <div class="text-muted">Внешний вид, пробег, возраст, салон и техническая готовность</div>
            </div>
            <div class="condition-percent">{{$condition}}%</div>
        </div>
        <div class="condition-track">
            <div class="condition-fill" style="width: {{$condition}}%"></div>
        </div>
        <div class="condition-details">
            <div class="condition-item">
                <strong>Кузов</strong>
                <span>Оценка входит в общий процент состояния</span>
            </div>
            <div class="condition-item">
                <strong>Салон</strong>
                <span>Подготовлен перед выдачей клиенту</span>
            </div>
            <div class="condition-item">
                <strong>Пробег и техника</strong>
                <span>Учитываются при расчете рейтинга</span>
            </div>
        </div>
    </div>

    <div class="text-center"><h2 class="section-title">Характеристики из базы данных</h2></div>

    <div class="row g-3 justify-content-center">
        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Модель</div><div class="spec-value">{{$array->model}}</div></div></div>
        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Сегмент</div><div class="spec-value">{{$segment}}</div></div></div>
        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Цвет</div><div class="spec-value">{{$color}}</div></div></div>
        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Тип кузова</div><div class="spec-value">{{$bodyType}}</div></div></div>
        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Год выпуска</div><div class="spec-value">{{$array->year}}</div></div></div>
        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Пробег</div><div class="spec-value">{{$array->mileage}} км</div></div></div>
        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Коробка</div><div class="spec-value">{{$transmission}}</div></div></div>
        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Топливо</div><div class="spec-value">{{$fuel}}</div></div></div>
        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Привод</div><div class="spec-value">{{$drive}}</div></div></div>
        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Мест</div><div class="spec-value">{{$seats}}</div></div></div>
        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Мощность</div><div class="spec-value">{{$enginePower}}</div></div></div>
        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Объем двигателя</div><div class="spec-value">{{$engineVolume}}</div></div></div>
        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Расход</div><div class="spec-value">{{$fuelConsumption}}</div></div></div>
        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Город выдачи</div><div class="spec-value">{{$array->country}}</div></div></div>        <div class="col-12 col-md-3"><div class="spec-card"><div class="spec-label">Статус</div><div class="spec-value">{{$status}}</div></div></div>    </div>

</div>

@endsection
