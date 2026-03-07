@extends('layouts.app')

@section('content')
<style>
    .register-page{
        padding: 40px 0 70px;
    }

    .register-header{
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

    .register-header::after{
        content:"";
        position:absolute;
        inset:0;
        background: radial-gradient(900px 400px at 20% 40%, rgba(255,255,255,.10), rgba(255,255,255,0) 60%);
        pointer-events:none;
    }

    .register-title{
        font-weight: 900;
        margin: 0;
        letter-spacing: .2px;
    }

    .register-subtitle{
        margin: 8px 0 0;
        opacity: .88;
    }

    .register-card{
        max-width: 760px;
        margin: 0 auto;
        border-radius: 20px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 18px 50px rgba(0,0,0,.10);
        overflow: hidden;
    }

    .register-card-body{
        padding: 32px 28px;
    }

    .form-label{
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .form-control{
        border-radius: 14px;
        border: 1px solid rgba(0,0,0,.12);
        padding: 12px 14px;
        box-shadow: none;
    }

    .form-control:focus{
        border-color: rgba(13,110,253,.45);
        box-shadow: 0 0 0 .2rem rgba(13,110,253,.12);
    }

    .form-text{
        color: #6c757d;
    }

    .rules-box{
        padding: 14px 16px;
        border-radius: 14px;
        background: #f8f9fa;
        border: 1px solid rgba(0,0,0,.06);
    }

    .form-rules-input{
        margin-right: 8px;
    }

    .register-btn{
        border-radius: 999px;
        padding: 12px 22px;
        font-weight: 700;
        min-width: 180px;
    }

    .register-footer-text{
        color: #6c757d;
        margin-top: 16px;
        font-size: .95rem;
    }

    @media (max-width: 768px){
        .register-card-body{
            padding: 24px 18px;
        }
    }
</style>

<div class="container register-page">

    <div class="register-header">
        <h1 class="register-title">Регистрация</h1>
        <p class="register-subtitle">Создайте аккаунт, чтобы быстрее оформлять заявки и следить за автомобилями</p>
    </div>

    <div class="register-card">
        <div class="register-card-body">
            <form>
                <div class="mb-3">
                    <label for="exampleInputName" class="form-label">Имя</label>
                    <input type="text" class="form-control" id="exampleInputName">
                </div>

                <div class="mb-3">
                    <label for="exampleInputSurname" class="form-label">Фамилия</label>
                    <input type="text" class="form-control" id="exampleInputSurname">
                </div>

                <div class="mb-3">
                    <label for="exampleInputPatronymic" class="form-label">Отчество</label>
                    <input type="text" class="form-control" id="exampleInputPatronymic">
                    <div id="PatronymicHelp" class="form-text">Не обязательно</div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputLogin" class="form-label">Логин</label>
                    <input type="login" class="form-control" id="exampleInputLogin">
                    <div id="LoginHelp" class="form-text">Не менее 6 символов</div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email адрес</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Мы никогда не передадим ваш адрес электронной почты кому-либо еще.</div>
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="exampleInputPassword1">
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword2" class="form-label">Повторите пароль</label>
                    <input type="password" class="form-control" id="exampleInputPassword2">
                </div>

                <div class="mb-4">
                    <div class="rules-box">
                        <input type="checkbox" class="form-rules-input" id="exampleRules">
                        <label class="form-check-label" for="exampleRules">
                            Согласние на обработку <a href="#">персональных данных</a>
                        </label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary register-btn">Войти</button>
                    <div class="register-footer-text">
                        Заполните данные внимательно, чтобы регистрация прошла без сюрпризов.
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection