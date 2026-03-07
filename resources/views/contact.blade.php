@extends('layouts.app')

@section('content')
<style>
    .testdrive-page{
        padding: 34px 0 70px;
    }

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

    .testdrive-header h1{
        margin: 0;
        font-weight: 900;
        position: relative;
        z-index: 1;
    }

    .testdrive-header p{
        margin: 8px 0 0;
        opacity: .9;
        position: relative;
        z-index: 1;
    }

    .testdrive-card{
        border-radius: 22px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 18px 50px rgba(0,0,0,.10);
        overflow: hidden;
    }

    .testdrive-card-body{
        padding: 30px 24px;
    }

    .form-label{
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
    }

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

    .submit-btn{
        border-radius: 999px;
        padding: 12px 22px;
        font-weight: 700;
        min-width: 220px;
    }

    .success-message{
        margin-top: 14px;
        color: #198754;
        font-weight: 600;
        text-align: center;
    }

    @media (max-width: 768px){
        .testdrive-card-body{
            padding: 22px 16px;
        }
    }
</style>

<div class="container testdrive-page">

    <div class="testdrive-header">
        <h1>Запись на тест-драйв</h1>
        <p>Оставьте заявку, и мы свяжемся с вами для подтверждения удобного времени</p>
    </div>

    <div class="testdrive-card">
        <div class="testdrive-card-body">
            <form method="POST" action="{{ route('addcontact') }}">
                @csrf

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="name" class="form-label">Имя</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Введите имя" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="phone" class="form-label">Телефон</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="+7..." required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="car" class="form-label">Автомобиль</label>
                        <input type="text" class="form-control" id="car" name="car" placeholder="Например: BMW M5 F90" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="date" class="form-label">Желаемая дата</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="time" class="form-label">Желаемое время</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="contact_method" class="form-label">Способ связи</label>
                        <select class="form-select" id="contact_method" name="contact_method" required>
                            <option value="">Выберите способ связи</option>
                            <option value="phone">Телефон</option>
                            <option value="telegram">Telegram</option>
                            <option value="whatsapp">WhatsApp</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="comment" class="form-label">Комментарий</label>
                        <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Например: интересует конкретная комплектация или цвет"></textarea>
                    </div>

                    <div class="col-12">
                        <div class="info-box">
                            После отправки заявки менеджер VELOX свяжется с вами для подтверждения тест-драйва и уточнения деталей.
                        </div>
                    </div>

                    <div class="col-12 text-center mt-2">
                        <button type="submit" class="btn btn-dark submit-btn">Записаться на тест-драйв</button>
                    </div>

                    @if(session('success'))
                        <div class="col-12">
                            <div class="success-message">
                                {{ session('success') }}
                            </div>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>

</div>
@endsection