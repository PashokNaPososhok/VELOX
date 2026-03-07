@extends('layouts.app')

@section('content')
<style>
    .contact-wrap{
        padding: 26px 0 60px;
    }

    .contact-header{
        margin: 18px 0 22px;
        border-radius: 18px;
        padding: 28px 22px;
        background: linear-gradient(135deg, rgba(10,12,16,1) 0%, rgba(20,24,34,1) 60%, rgba(13,110,253,.22) 100%);
        color: #fff;
        box-shadow: 0 16px 45px rgba(0,0,0,.18);
        overflow: hidden;
        position: relative;
        text-align: center;
    }

    .contact-header::after{
        content:"";
        position:absolute;
        inset:0;
        background: radial-gradient(900px 400px at 20% 40%, rgba(255,255,255,.10), rgba(255,255,255,0) 60%);
        pointer-events:none;
    }

    .contact-title{
        font-weight: 900;
        margin: 0;
        letter-spacing: .2px;
    }

    .contact-subtitle{
        margin: 8px 0 0;
        opacity: .88;
        max-width: 70ch;
    }

    .panel{
        border-radius: 18px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 14px 40px rgba(0,0,0,.08);
        overflow: hidden;
        height: 100%;
    }

    .map-frame{
        width: 100%;
        height: 520px;
        border: 0;
        display: block;
    }

    .panel-body{
        padding: 22px;
    }

    .contact-line{
        display:flex;
        gap: 12px;
        align-items:flex-start;
        padding: 12px 12px;
        border-radius: 14px;
        background: #f8f9fa;
        border: 1px solid rgba(0,0,0,.06);
        margin-bottom: 12px;
        text-align: left;
    }

    .contact-ico{
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display:flex;
        align-items:center;
        justify-content:center;
        background: rgba(13,110,253,.10);
        border: 1px solid rgba(13,110,253,.18);
        font-size: 18px;
        flex: 0 0 auto;
    }

    .contact-label{
        font-size: .88rem;
        color: #6c757d;
        margin: 0;
        line-height: 1.2;
    }

    .contact-value{
        margin: 2px 0 0;
        font-weight: 800;
        color: #111;
        line-height: 1.25;
        word-break: break-word;
    }

    .contact-actions .btn{
        border-radius: 999px;
        font-weight: 700;
        padding: 10px 16px;
    }

    .contact-actions .btn-outline-primary{
        border-width: 2px;
    }

    @media (max-width: 992px){
        .map-frame{ height: 420px; }
    }
</style>

<div class="container contact-wrap">

    <div class="contact-header">
        <h1 class="contact-title">Контакты</h1>
        <p class="contact-subtitle mx-auto">
            Приезжайте в салон, звоните или пишите. Подскажем по наличию, кредиту и тест-драйву.
        </p>
    </div>

    <div class="row g-3 align-items-stretch">
        <div class="col-12 col-lg-7">
            <div class="panel">
                <iframe
                    id="map_559666120"
                    class="map-frame"
                    frameborder="0"
                    src="https://makemap.2gis.ru/widget?data=eJw1j8FqxCAQht9lepUlarRJHmBLb3srtOwhrNNWMBkxs9BtyLt3Yqgn-b_xm98VqAQsGF6QJuQScYHhYwV-ZIQBzjjyvSAoyIUyFq5ccOS0cwEBl1uJmSPNR3CjREWuT43p9KeR5Pd1DvgDg27-z6bg61j4qLpj24XizNUgpeI8ci3j7Mlo7Y1Xzp86r61zV3kfwy7s3XZVMI35Qks8OqyQRoahDltr9bPtu97b1itIO999jXOtcb61vWl6KUg0ia0VrXyGUnr7RkzvNeVyx-0PgEVZgQ"
                    sandbox="allow-modals allow-forms allow-scripts allow-same-origin allow-popups allow-top-navigation-by-user-activation">
                </iframe>
            </div>
        </div>

        <div class="col-12 col-lg-5">
            <div class="panel">
                <div class="panel-body text-center">

                    <div class="contact-line">
                        <div class="contact-ico">📍</div>
                        <div>
                            <p class="contact-label">Адрес</p>
                            <p class="contact-value">Ижевск, Пушкинсая 268А</p>
                        </div>
                    </div>
                    <div class="contact-line">
                        <div class="contact-ico">📞</div>
                        <div>
                            <p class="contact-label">Телефон</p>
                            <p class="contact-value">+7(912) 74-85-378</p>
                        </div>
                    </div>

                    <div class="contact-line">
                        <div class="contact-ico">✉️</div>
                        <div>
                            <p class="contact-label">Почта</p>
                            <p class="contact-value">maa2018mlp@gmail.com</p>
                        </div>
                    </div>

                    <div class="contact-actions d-grid gap-2 mt-3">
                        <a class="btn btn-dark" href="tel:+79127485378">Позвонить</a>
                        <a class="btn btn-outline-dark" href="mailto:maa2018mlp@gmail.com">Написать на почту</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection