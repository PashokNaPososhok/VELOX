@extends('layouts.app')

@section('content')
<style>
    .editor-page{
        padding: 34px 0 70px;
    }

    .editor-header{
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

    .editor-header::after{
        content:"";
        position:absolute;
        inset:0;
        background: radial-gradient(900px 400px at 20% 40%, rgba(255,255,255,.10), rgba(255,255,255,0) 60%);
        pointer-events:none;
    }

    .editor-header h3{
        margin: 0;
        font-weight: 900;
        font-size: 2rem;
        position: relative;
        z-index: 1;
    }

    .editor-card{
        border-radius: 22px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 18px 50px rgba(0,0,0,.10);
        overflow: hidden;
    }

    .editor-image-wrap{
        height: 100%;
        min-height: 100%;
        background: #f8f9fa;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-right: 1px solid rgba(0,0,0,.06);
    }

    .editor-image{
        width: 100%;
        max-height: 420px;
        object-fit: cover;
        border-radius: 18px;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 10px 30px rgba(0,0,0,.08);
    }

    .editor-body{
        padding: 28px 24px;
    }

    .editor-title{
        font-size: 1.45rem;
        font-weight: 900;
        margin-bottom: 22px;
        color: #111827;
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

    .save-btn{
        border-radius: 999px;
        padding: 12px 20px;
        font-weight: 700;
        min-width: 180px;
    }

    .editor-message{
        margin-top: 14px;
        color: #198754;
        font-weight: 600;
    }

    @media (max-width: 768px){
        .editor-image-wrap{
            border-right: none;
            border-bottom: 1px solid rgba(0,0,0,.06);
        }

        .editor-body{
            padding: 22px 16px;
        }
    }
</style>

<div class="container editor-page">
    <div class="editor-header">
        <h3>Редактор товара</h3>
    </div>

    <div class="editor-card">
        <div class="row g-0 align-items-stretch">
            <div class="col-lg-5">
                <div class="editor-image-wrap">
                    <img src="/public/{{$products->image}}" class="editor-image" alt="">
                </div>
            </div>

            <div class="col-lg-7">
                <div class="editor-body">
                    <div class="editor-title">Изменение данных автомобиля</div>

                    <form method="post" action="{{route('editProducts',['id'=>$products->id])}}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$products->name}}">
                        </div>

                        <div class="mb-3">
                            <label for="cost" class="form-label">Цена</label>
                            <input type="text" class="form-control" id="cost" name="cost" value="{{$products->cost}}">
                        </div>

                        <div class="mb-4">
                            <label for="image" class="form-label">Фото</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-primary save-btn">Сохранить</button>
                        <p class="editor-message">{{session('message')}}</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection