@extends('layouts.app')

@section('content')
<style>
    .catalog-wrap{
        padding: 26px 0 50px;
    }

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

    .catalog-title{
        font-weight: 900;
        margin: 0;
        letter-spacing: .2px;
    }

    .catalog-subtitle{
        margin: 8px 0 0;
        opacity: .88;
        max-width: 70ch;
    }

    .filter-panel{
        margin: 18px 0 22px;
        border-radius: 18px;
        background: rgba(255,255,255,.9);
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 14px 40px rgba(0,0,0,.08);
        padding: 16px;
    }

    .filter-panel .form-select{
        border-radius: 14px;
        border: 1px solid rgba(0,0,0,.12);
        padding: 10px 12px;
    }

    .filter-panel .btn{
        border-radius: 999px;
        padding: 10px 18px;
        font-weight: 700;
    }

    .car-card{
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 12px 30px rgba(0,0,0,.08);
        transition: transform .15s ease, box-shadow .15s ease;
        background: #fff;
    }

    .car-card:hover{
        transform: translateY(-3px);
        box-shadow: 0 18px 45px rgba(0,0,0,.12);
    }

    .car-img{
        width: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        border-radius: 14px;
        border: 1px solid rgba(0,0,0,.06);
    }

    .car-name{
        font-weight: 900;
        margin: 0;
    }

    .car-desc{
        margin: 0;
        color: #555;
        line-height: 1.7;
        font-size: .98rem;
    }

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

    .actions .btn{
        border-radius: 999px;
        padding: 10px 16px;
        font-weight: 700;
    }

    .actions .btn-danger{
        padding: 10px 14px;
    }

    .car-specs{
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    }

    .spec-item{
        background: #f8f9fa;
        border: 1px solid rgba(0,0,0,.06);
        border-radius: 12px;
        padding: 8px 12px;
        display: flex;
        flex-direction: column;
        min-width: 90px;
    }

    .spec-label{
        font-size: 12px;
        color: #6c757d;
    }

    .spec-value{
        font-weight: 700;
        font-size: 14px;
    }

    .car-meta{
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
    }

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

    .car-actions-col{
    min-width: 0;
    }

    @media (min-width: 768px) and (max-width: 991.98px){
        .car-card .row{
            align-items: flex-start !important;
        }

        .car-actions-col{
            margin-top: 10px;
        }

        .actions{
            align-items: stretch;
        }

        .price-pill{
            width: 100%;
            justify-content: center;
            text-align: center;
            white-space: normal;
        }

        .actions .btn{
            width: 100%;
        }
    }
</style>

<div class="container catalog-wrap">

    <div class="catalog-header text-center">
        <h1 class="catalog-title">Каталог машин</h1>
        <p class="catalog-subtitle mx-auto">
            Выбирай авто по категории и сортировке. Нажми «Перейти», чтобы открыть карточку автомобиля.
        </p>
    </div>

    <form class="filter-panel" method="get" action="{{ route('catalog') }}">
        @csrf
        <div class="row g-2 align-items-center justify-content-center">
            <div class="col-12 col-md-4">
                <select class="form-select" name="filtr">
                    <option value="yearFiltr">Сортировка: по году</option>
                    <option value="nameFiltr">Сортировка: по имени</option>
                    <option value="costFiltr">Сортировка: по цене</option>
                </select>
            </div>

            <div class="col-12 col-md-5">
                <select class="form-select" name="id_category">
                    @foreach ($categories as $a)
                        <option value="{{ $a->id }}">{{ $a->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-3 d-grid">
                <button type="submit" class="btn btn-dark">Фильтровать</button>
            </div>
        </div>
    </form>
    <div class="row g-3">
        @foreach ($array as $a)
            <div class="col-12">
                <form action="{{ route('card',['id'=>$a->id])}}">
                    @csrf
                    <div class="car-card p-3">
                        <div class="row g-3 align-items-center">

                            <div class="col-12 col-md-3">
                                <img src="../public/{{$a->image}}" class="car-img" alt="car">
                            </div>

                            <div class="col-12 col-md-2">
                                <div class="d-flex flex-column gap-1">
                                    <h5 class="car-name">{{$a->name}} {{$a->model}}</h5>
                                </div>
                            </div>

                            <div class="col-12 col-md-5">
                                <div class="car-meta">
                                    <span class="meta-chip">Год: {{$a->year}}</span>
                                    <span class="meta-chip">Пробег: {{$a->mileage}} км</span>
                                    <span class="meta-chip">Страна: {{$a->country}}</span>
                                </div>
                            </div>

                            <div class="col-12 col-md-2">
                                <div class="d-flex flex-column gap-2 actions">
                                    <div class="price-pill">Цена: {{$a->cost}}</div>
                                    <button type="submit" class="btn btn-dark w-100">Перейти</button>

                                    @if(isset(Auth::user()->id))
                                        @if(Auth::user()->role_id==2)
                                            <a class="btn btn-danger w-100" href="{{route('editProductsView',['id'=>$a->id])}}">Редактор</a>
                                        @endif
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        @endforeach
    </div>

</div>
@endsection