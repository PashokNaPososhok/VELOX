@extends('layouts.app')

@section('content')
<style>
    .home-hero{
        position: relative;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 16px 45px rgba(0,0,0,.18);
        margin-top: 18px;
    }

    .home-hero .carousel-item img{
        height: 540px;
        object-fit: cover;
        filter: brightness(65%) contrast(1.05);
        transform: scale(1.02);
    }

    .home-hero::after{
        content:"";
        position:absolute;
        inset:0;
        background:
            radial-gradient(1200px 600px at 15% 50%, rgba(0,0,0,.55), rgba(0,0,0,.12) 55%, rgba(0,0,0,.0) 75%),
            linear-gradient(180deg, rgba(0,0,0,.35), rgba(0,0,0,.05) 45%, rgba(0,0,0,.45));
        pointer-events:none;
        z-index: 2;
    }

    .hero-content{
        position:absolute;
        inset:0;
        z-index: 3;
        display:flex;
        align-items:center;
        padding: 24px;
    }

    .hero-card{
        max-width: 720px;
        padding: 28px 28px;
        border-radius: 18px;
        backdrop-filter: blur(10px);
        background: rgba(10,12,16,.55);
        border: 1px solid rgba(255,255,255,.12);
        color: #fff;
        text-align: left;
        box-shadow: 0 14px 40px rgba(0,0,0,.28);
    }

    .hero-top{
        display:flex;
        gap:10px;
        align-items:center;
        flex-wrap: wrap;
        margin-bottom: 10px;
    }

    .hero-pill{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding: 7px 12px;
        border-radius: 999px;
        background: rgba(255,255,255,.10);
        border: 1px solid rgba(255,255,255,.14);
        font-weight: 600;
        font-size: .95rem;
    }

    .hero-card h1{
        font-size: 2.7rem;
        font-weight: 900;
        letter-spacing: .2px;
        margin: 10px 0 10px;
        line-height: 1.1;
    }

    .hero-card p{
        font-size: 1.12rem;
        opacity: .92;
        line-height: 1.7;
        margin-bottom: 18px;
        max-width: 56ch;
    }

    .hero-actions .btn{
        border-radius: 999px;
        padding: 10px 18px;
        font-weight: 700;
    }

    .hero-actions .btn-outline-light{
        border-width: 2px;
    }

    .hero-stats{
        display:flex;
        gap:14px;
        flex-wrap: wrap;
        margin-top: 16px;
    }

    .stat{
        padding: 12px 14px;
        border-radius: 14px;
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.12);
        min-width: 150px;
    }

    .stat .num{
        font-size: 1.25rem;
        font-weight: 900;
        line-height: 1.2;
    }

    .stat .txt{
        font-size: .92rem;
        opacity: .85;
    }

    .carousel-indicators [data-bs-target]{
        width: 10px;
        height: 10px;
        border-radius: 50%;
        margin: 0 6px;
        opacity: .65;
    }

    .carousel-indicators .active{
        opacity: 1;
        transform: scale(1.1);
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon{
        filter: drop-shadow(0 8px 16px rgba(0,0,0,.45));
    }

    .section-card{
        margin: 60px 0 28px;
        border-radius: 18px;
        background: #ffffff;
        box-shadow: 0 14px 40px rgba(0,0,0,.08);
        padding: 44px 34px;
        position: relative;
        overflow: hidden;
    }

    .section-card::before{
        content:"";
        position:absolute;
        top:-160px;
        right:-160px;
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, rgba(13,110,253,.22), rgba(13,110,253,0));
        border-radius: 50%;
    }

    .section-card h2{
        font-weight: 900;
        margin-bottom: 14px;
    }

    .section-card .lead{
        color:#444;
        line-height: 1.85;
        font-size: 1.08rem;
        max-width: 900px;
        margin: 0 auto;
    }

    .feature-card{
        border-radius: 16px;
        border: 1px solid rgba(0,0,0,.06);
        padding: 18px 16px;
        background: #f8f9fa;
        height: 100%;
        transition: transform .15s ease, box-shadow .15s ease;
    }
.feature-card:hover{
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(0,0,0,.08);
    }

    .feature-card h5{
        margin-bottom: 8px;
        font-weight: 800;
    }

    .feature-card .text-muted{
        line-height: 1.6;
    }

    @media (max-width: 992px){
        .home-hero .carousel-item img{ height: 460px; }
        .hero-card h1{ font-size: 2.1rem; }
        .stat{ min-width: 140px; }
    }
</style>

<div class="container text-center">

    <div class="home-hero">
        <div id="carouselExampleDark" class="carousel carousel-dark slide">

            <div class="carousel-inner">
                @foreach($array as $a)
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img src="../public/{{$a->image}}" class="d-block w-100" alt="...">
                        </div>
                @endforeach
            </div>
        </div>

        <div class="hero-content">
            <div class="hero-card">
                <div class="hero-top">
                    <span class="hero-pill">🚗 Автосалон</span>
                    <span class="hero-pill">✅ Проверенные авто</span>
                    <span class="hero-pill">💳 Кредит/лизинг</span>
                </div>

                <h1>Автомобили, которые приятно выбирать</h1>
                <p>
                    Подбор авто под бюджет, прозрачная история, помощь с оформлением.
                    Приезжайте на тест-драйв или смотрите каталог прямо сейчас.
                </p>

                <div class="hero-actions d-flex gap-2 flex-wrap">
                    <a href="{{ url('/catalog') }}" class="btn btn-light">Каталог</a>
                    <a href="{{ url('/contact') }}" class="btn btn-outline-light">Записаться на тест-драйв</a>
                </div>

                <div class="hero-stats">
                    <div class="stat">
                        <div class="num">100+</div>
                        <div class="txt">авто в наличии</div>
                    </div>
                    <div class="stat">
                        <div class="num">24/7</div>
                        <div class="txt">поддержка</div>
                    </div>
                    <div class="stat">
                        <div class="num">0 ₽</div>
                        <div class="txt">проверка авто</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div id="onas" class="section-card">
        <h2>О нас</h2>
        <p class="lead">
            Мы специализируемся на продаже и подборе автомобилей.
            У нас честные условия, понятные документы и аккуратная предпродажная подготовка.
            Поможем с трейд-ин, кредитом и постановкой на учёт.
        </p>

        <div class="row g-3 mt-3">
            <div class="col-md-4">
                <div class="feature-card">
                    <h5>🧾 Прозрачная история</h5>
                    <div class="text-muted">Проверяем авто по базам и показываем результаты.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <h5>🔧 Диагностика перед покупкой</h5>
                    <div class="text-muted">Осмотр, тест-драйв и рекомендации по состоянию.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <h5>💳 Удобное оформление</h5>
                    <div class="text-muted">Кредит/лизинг, трейд-ин, помощь с документами.</div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
