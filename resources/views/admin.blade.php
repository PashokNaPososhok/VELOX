@extends('layouts.app')

@section('content')
<style>
    .admin-page{
        padding: 34px 0 70px;
    }

    .admin-hero{
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

    .admin-hero::after{
        content:"";
        position:absolute;
        inset:0;
        background: radial-gradient(900px 400px at 20% 40%, rgba(255,255,255,.10), rgba(255,255,255,0) 60%);
        pointer-events:none;
    }

    .admin-hero h1{
        margin: 0;
        font-weight: 900;
        letter-spacing: .2px;
        position: relative;
        z-index: 1;
    }

    .admin-section-title{
        margin: 50px 0 18px;
        border-radius: 16px;
        padding: 18px 20px;
        background: linear-gradient(135deg, rgba(10,12,16,.96) 0%, rgba(20,24,34,.96) 100%);
        color: #fff;
        box-shadow: 0 14px 36px rgba(0,0,0,.14);
        text-align: center;
    }

    .admin-section-title h1{
        margin: 0;
        font-size: 1.8rem;
        font-weight: 900;
    }

    .admin-panel{
        border-radius: 20px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 18px 50px rgba(0,0,0,.08);
        padding: 22px;
        margin-bottom: 28px;
    }

    .admin-toolbar{
        display: flex;
        justify-content: flex-end;
        margin-bottom: 16px;
    }

    .dropdown-toggle,
    .btn-primary,
    .btn-danger,
    .btn-secondary{
        border-radius: 999px;
        font-weight: 700;
        padding: 10px 16px;
    }

    .dropdown-menu{
        border: 1px solid rgba(0,0,0,.08);
        box-shadow: 0 12px 30px rgba(0,0,0,.10);
        border-radius: 14px;
        overflow: hidden;
    }

    .dropdown-item{
        padding: 10px 14px;
    }

    .table-wrap{
        overflow-x: auto;
    }

    .table{
        margin-bottom: 0;
        vertical-align: middle;
    }

    .table thead th{
        border-bottom: none;
        color: #6c757d;
        font-weight: 800;
        text-transform: uppercase;
        font-size: .84rem;
        letter-spacing: .04em;
        padding: 16px 14px;
        background: #f8f9fa;
    }

    .table tbody td,
    .table tbody th{
        padding: 16px 14px;
        border-color: rgba(0,0,0,.06);
    }

    .table tbody tr:hover{
        background: rgba(13,110,253,.03);
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

    .form-label{
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .product-card{
        max-width: 100%;
        margin: 0;
        border-radius: 20px;
        background: #fff;
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 18px 50px rgba(0,0,0,.10);
        overflow: hidden;
    }

    .product-card .card-body{
        padding: 28px 24px;
    }

    .product-card .card-title{
        font-weight: 900;
        font-size: 1.4rem;
        margin-bottom: 22px;
        text-align: center;
    }

    .product-grid{
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .product-grid .full-width{
        grid-column: 1 / -1;
    }

    .testdrive-card{
    border-radius: 18px;
    background: #fff;
    border: 1px solid rgba(0,0,0,.06);
    box-shadow: 0 12px 30px rgba(0,0,0,.06);
    padding: 20px;
    }

    .testdrive-main{
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .testdrive-name{
        font-size: 1.2rem;
        font-weight: 900;
        color: #111827;
    }

    .testdrive-phone,
    .testdrive-car{
        color: #4b5563;
        font-weight: 600;
    }

    .testdrive-info{
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .info-chip{
        display: inline-flex;
        align-items: center;
        padding: 8px 14px;
        border-radius: 999px;
        background: #f3f4f6;
        border: 1px solid rgba(0,0,0,.06);
        color: #374151;
        font-size: .95rem;
        font-weight: 700;
    }

    .testdrive-comment{
        background: #f8f9fa;
        border: 1px solid rgba(0,0,0,.06);
        border-radius: 14px;
        padding: 14px 16px;
        color: #1f2937;
        line-height: 1.7;
        word-break: break-word;
    }

    .testdrive-actions{
        height: 100%;
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .testdrive-actions .btn{
        border-radius: 999px;
        font-weight: 700;
        padding: 10px 18px;
    }

    @media (max-width: 991.98px){
        .testdrive-actions{
            justify-content: flex-start;
        }
    }

    @media (max-width: 768px){
        .product-grid{
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="container admin-page">

    <div class="admin-hero">
        <h1>Панель администратора</h1>
    </div>

    <div class="admin-section-title">
        <h1>Заявки на тест-драйв</h1>
    </div>

    <div class="admin-panel">
        <div class="row g-3">
            @foreach ($contact as $testdrive)
                <div class="col-12">
                    <div class="testdrive-card">
                        <div class="row g-3 align-items-start">

                            <div class="col-12 col-lg-3">
                                <div class="testdrive-main">
                                    <div class="testdrive-name">{{ $testdrive->name }}</div>
                                    <div class="testdrive-phone">{{ $testdrive->phone }}</div>
                                    <div class="testdrive-car">{{ $testdrive->car }}</div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-5">
                                <div class="testdrive-info">
                                    <div class="info-chip">Дата: {{ $testdrive->date }}</div>
                                    <div class="info-chip">Время: {{ $testdrive->time }}</div>
                                    <div class="info-chip">Связь: {{ $testdrive->contact_method }}</div>
                                </div>

                                <div class="testdrive-comment mt-3">
                                    @if($testdrive->comment)
                                        {{ $testdrive->comment }}
                                    @else
                                        <span class="text-muted">Комментарий не указан</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-lg-4">
                                <div class="testdrive-actions">
                                    <form method="POST" action="{{ route('delcontact', ['id' => $testdrive->id]) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Удалить</button>
</form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="admin-section-title">
        <h1>Публикация категории</h1>
    </div>

    <div class="admin-panel">
        <div class="table-wrap">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <form method="post" action="{{route('addCategory')}}">
                    @csrf
                    <tbody>
                    <tr>
                        <td>
                            <input type="text" class="form-control" id="nameCategory" name="nameCategory" aria-describedby="basic-addon3 basic-addon4" required>
                        </td>
                        <td>
                            <button class="btn btn-primary">Опубликовать</button>
                        </td>
                    </tr>
                    </tbody>
                </form>
            </table>
        </div>
    </div>

    <div class="admin-section-title">
        <h1>Редактор категории</h1>
    </div>

    <div class="admin-panel">
        <div class="table-wrap">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">Редактировать</th>
                </tr>
                </thead>
                @foreach ($red as $b)
                    <form method="post" action="{{route('delCategory')}}">
                        @csrf
                        @method('DELETE')
                        <tbody>
                        <tr>
                            <th scope="row">{{$b->name}}</th>
                            <td><button type="submit" class="btn btn-danger">Удалить</button></td>
                        </tr>
                        </tbody>
                    </form>
                @endforeach
            </table>
        </div>
    </div>

    <div class="admin-section-title">
        <h1>Добавление товара</h1>
    </div>

    <form class="mb-5" method="post" action="{{route('addProducts')}}" enctype="multipart/form-data">
    @csrf
    <div class="card product-card">
        <div class="card-body">
            <h5 class="card-title">Добавление товара</h5>

            <div class="product-grid">
                <div class="mb-3">
                    <label for="id_category" class="form-label">Выбор категории</label>
                    <select class="form-select" name="id_category" id="id_category">
                        @foreach($red as $a)
                            <option value="{{$a->id}}">{{$a->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nameProducts" class="form-label">Название</label>
                    <input type="text" class="form-control" id="nameProducts" name="nameProducts" required>
                </div>

                <div class="mb-3">
                    <label for="costProducts" class="form-label">Цена</label>
                    <input type="text" class="form-control" id="costProducts" name="costProducts" required>
                </div>

                <div class="mb-3">
                    <label for="countryProducts" class="form-label">Город</label>
                    <input type="text" class="form-control" id="countryProducts" name="countryProducts" required>
                </div>

                <div class="mb-3">
                    <label for="yearProducts" class="form-label">Год</label>
                    <input type="text" class="form-control" id="yearProducst" name="yearProducts" required>
                </div>

                <div class="mb-3">
                    <label for="modelProducts" class="form-label">Название модели</label>
                    <input type="text" class="form-control" id="modelProducts" name="modelProducts" required>
                </div>

                <div class="mb-3 full-width">
                    <label for="image" class="form-label">Фото</label>
                    <input type="file" class="form-control" id="image" name="image" required accept="image/*">
                </div>

                <div class="full-width">
                    <button type="submit" class="btn btn-primary w-100">Добавить</button>
                    <p class="session-message">{{session('messageAddProducts')}}</p>
                </div>
            </div>
        </div>
    </div>
</form>

</div>
@endsection