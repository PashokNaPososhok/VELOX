@extends('layouts.app')

@section('content')
<style>
    .catalog-wrap{ padding: 26px 0 50px; }

    .catalog-header{
        margin: 10px 0 18px;
        border-radius: 18px;
        padding: 28px 22px;
        background: linear-gradient(135deg, rgba(10,12,16,1) 0%, rgba(20,24,34,1) 60%, rgba(13,110,253,.22) 100%);
        color: #fff;
        box-shadow: 0 16px 45px rgba(0,0,0,.18);
        overflow: hidden;
        position: relative;
    }

    .catalog-header::after{
        content:"";
        position:absolute;
        inset:0;
        background: radial-gradient(900px 400px at 20% 40%, rgba(255,255,255,.10), rgba(255,255,255,0) 60%);
        pointer-events:none;
    }

    .catalog-title{ font-weight: 900; margin: 0; letter-spacing: .2px; position: relative; z-index: 1; }
    .catalog-subtitle{ margin: 8px 0 0; opacity: .88; max-width: 76ch; position: relative; z-index: 1; }

    .filter-panel{
        margin: 18px 0 22px;
        border-radius: 18px;
        background: rgba(255,255,255,.9);
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 14px 40px rgba(0,0,0,.08);
        padding: 16px;
    }

    .filter-panel .form-select{ border-radius: 14px; border: 1px solid rgba(0,0,0,.12); padding: 10px 12px; }
    .filter-panel .btn{ border-radius: 999px; padding: 10px 18px; font-weight: 700; }

    .car-card{
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 12px 30px rgba(0,0,0,.08);
        transition: transform .15s ease, box-shadow .15s ease;
        background: #fff;
    }

    .car-card:hover{ transform: translateY(-3px); box-shadow: 0 18px 45px rgba(0,0,0,.12); }

    .car-img{ width: 100%; aspect-ratio: 16 / 9; object-fit: cover; border-radius: 14px; border: 1px solid rgba(0,0,0,.06); }
    .car-name{ font-weight: 900; margin: 0; }

    .price-pill{
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(13,110,253,.10);
        border: 1px solid rgba(13,110,253,.18);
        font-weight: 800;
        color: rgba(10,12,16,1);
        white-space: nowrap;
    }

    .actions .btn{ border-radius: 999px; padding: 10px 16px; font-weight: 700; }
    .actions .btn-danger{ padding: 10px 14px; }
    .car-meta{ display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }

    .meta-chip{
        display: inline-flex;
        align-items: center;
        padding: 8px 14px;
        border-radius: 999px;
        background: #f3f4f6;
        border: 1px solid rgba(0,0,0,.06);
        color: #374151;
        font-size: .95rem;
        font-weight: 600;
        line-height: 1;
    }

    .status-chip{ background: rgba(25,135,84,.10); border-color: rgba(25,135,84,.18); color: #146c43; }
    .busy-chip{ background: rgba(220,53,69,.10); border-color: rgba(220,53,69,.18); color: #b02a37; }

    .condition-mini{ margin-top: 12px; max-width: 280px; }
    .condition-top{ display:flex; justify-content:space-between; font-size:.85rem; font-weight:800; color:#374151; margin-bottom:6px; }
    .condition-track{ height: 9px; border-radius:999px; background:#e9ecef; overflow:hidden; }
    .condition-fill{ height:100%; border-radius:999px; background: linear-gradient(90deg, #198754, #0d6efd); }
    .car-actions-col{ min-width: 0; }

    @media (min-width: 768px) and (max-width: 991.98px){
        .car-card .row{ align-items: flex-start !important; }
        .car-actions-col{ margin-top: 10px; }
        .actions{ align-items: stretch; }
        .price-pill{ width: 100%; justify-content: center; text-align: center; white-space: normal; }
        .actions .btn{ width: 100%; }
    }
</style>

<div class="container catalog-wrap">

    <div class="catalog-header text-center">
        <h1 class="catalog-title">Автомобили в аренду</h1>
        <p class="catalog-subtitle mx-auto">
            Выбирай автомобиль по категории и сортировке. Все характеристики берутся из базы данных:
            сегмент, цвет, состояние, коробка, привод, залог и статус доступности.
        </p>
    </div>

    <form class="filter-panel" method="get" action="{{ route('catalog') }}">
        <div class="row g-2 align-items-center justify-content-center">
            <div class="col-12 col-md-4">
                <select class="form-select" name="filtr">
                    <option value="yearFiltr" {{ request('filtr') == 'yearFiltr' ? 'selected' : '' }}>Сортировка: по году</option>
                    <option value="nameFiltr" {{ request('filtr') == 'nameFiltr' ? 'selected' : '' }}>Сортировка: по названию</option>
                    <option value="costFiltr" {{ request('filtr') == 'costFiltr' ? 'selected' : '' }}>Сортировка: по цене аренды</option>
                </select>
            </div>

            <div class="col-12 col-md-5">
                <select class="form-select" name="id_category">
                    <option value="all">Все категории</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('id_category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-3 d-grid">
                <button type="submit" class="btn btn-dark">Фильтровать</button>
            </div>
        </div>
    </form>

    <div class="row g-3">
        @forelse ($array as $a)
            @php
                $segment = $a->segment ?? 'Комфорт';
                $color = $a->color ?? 'Не указан';
                $transmission = $a->transmission ?? 'Автомат';
                $condition = (int)($a->condition_percent ?? 90);
                $seats = $a->seats ?? 5;
                $status = $a->availability_status ?? 'Свободен';
                $statusClass = $status === 'Свободен' ? 'status-chip' : 'busy-chip';
            @endphp
            <div class="col-12">
                <form action="{{ route('card',['id'=>$a->id])}}">
                    <div class="car-card p-3">
                        <div class="row g-3 align-items-center">

                            <div class="col-12 col-md-3">
                                <img src="{{ asset(ltrim($a->image, '/')) }}" class="car-img" alt="Автомобиль {{$a->name}}">
                            </div>

                            <div class="col-12 col-md-2">
                                <div class="d-flex flex-column gap-1">
                                    <h5 class="car-name">{{$a->name}} {{$a->model}}</h5>
                                    <span class="meta-chip {{$statusClass}}">{{$status}}</span>
                                </div>
                            </div>

                            <div class="col-12 col-md-5">
                                <div class="car-meta">
                                    <span class="meta-chip">{{$segment}}</span>
                                    <span class="meta-chip">Цвет: {{$color}}</span>
                                    <span class="meta-chip">Год: {{$a->year}}</span>
                                    <span class="meta-chip">Пробег: {{$a->mileage}} км</span>
                                    <span class="meta-chip">{{$transmission}}</span>
                                    <span class="meta-chip">{{$seats}} мест</span>
                                </div>
                                <div class="condition-mini">
                                    <div class="condition-top">
                                        <span>Состояние</span>
                                        <span>{{$condition}}%</span>
                                    </div>
                                    <div class="condition-track">
                                        <div class="condition-fill" style="width: {{$condition}}%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-2 car-actions-col">
                                <div class="d-flex flex-column gap-2 actions">
                                    <div class="price-pill">от {{$a->cost}} ₽/сутки</div>
                                    <button type="submit" class="btn btn-dark w-100">Подробнее</button>

                                    @if(isset(Auth::user()->id) && Auth::user()->role_id == 2)
                                        <a class="btn btn-danger w-100" href="{{route('editProductsView',['id'=>$a->id])}}">Редактор</a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light border text-center">Автомобили не найдены.</div>
            </div>
        @endforelse
    </div>

</div>
@endsection
