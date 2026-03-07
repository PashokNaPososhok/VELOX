@extends('layouts.app')

@section('content')
<style>
    .car-page{
        padding: 30px 0 60px;
    }

    .car-title{
        font-weight: 900;
        margin: 40px 0 30px;
        letter-spacing: .3px;
    }

    .car-main{
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 18px 50px rgba(0,0,0,.10);
        padding: 24px;
    }

    .car-img{
        width: 100%;
        height: 380px;
        object-fit: cover;
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,.06);
    }

    .car-side{
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

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
        margin-bottom: 20px;
    }

    .order-btn{
        border-radius: 999px;
        padding: 12px 22px;
        font-weight: 700;
    }

    .section-title{
        font-weight: 900;
        margin: 60px 0 30px;
    }

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
    }

    .spec-card:hover{
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0,0,0,.08);
    }

    .spec-label{
        font-size: .9rem;
        color: #6c757d;
        margin-bottom: 6px;
    }

    .spec-value{
        font-weight: 800;
        font-size: 1.05rem;
        color: #111827;
    }

    @media (max-width: 992px){
        .car-img{
            height: 260px;
        }

        .car-side{
            align-items: flex-start;
        }
    }
</style>

<div class="container car-page">

    <div class="text-center">
        <h1 class="car-title">{{$array->name}}</h1>
    </div>

    <div class="car-main">
        <div class="row align-items-center g-4">

            <div class="col-md-5">
                <img src="../public/{{$array->image}}" class="car-img" alt="car">
            </div>

            <div class="col-md-7">
                <div class="car-side">
                    <div class="price-order">

                    <div class="price-box">
                        Цена: {{$array->cost}}
                    </div>

                    <form action="{{ route('contact') }}" method="GET">
                        <input type="hidden" name="car" value="{{ $array->name }}">
                        <button type="submit" class="btn btn-dark order-btn">Заказать</button>
                    </form>

                </div>
                </div>
            </div>

        </div>
    </div>

    <div class="text-center">
        <h2 class="section-title">Описание</h2>
    </div>

    <div class="car-description">
        {{$array->description}}
    </div>

    <div class="text-center">
        <h2 class="section-title">Характеристики</h2>
    </div>

    <div class="row g-3 justify-content-center">

        <div class="col-12 col-md-3">
            <div class="spec-card">
                <div class="spec-label">Модель</div>
                <div class="spec-value">{{$array->model}}</div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="spec-card">
                <div class="spec-label">Страна</div>
                <div class="spec-value">{{$array->country}}</div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="spec-card">
                <div class="spec-label">Год выпуска</div>
                <div class="spec-value">{{$array->year}}</div>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="spec-card">
                <div class="spec-label">Пробег</div>
                <div class="spec-value">{{$array->mileage}} км</div>
            </div>
        </div>

    </div>

</div>

@endsection