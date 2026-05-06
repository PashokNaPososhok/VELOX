@extends('layouts.app')

@section('content')
<style>
    .editor-page{ padding: 34px 0 70px; }

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

    .editor-header h3{ margin: 0; font-weight: 900; font-size: 2rem; position: relative; z-index: 1; }

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

    .editor-image{ width: 100%; max-height: 420px; object-fit: cover; border-radius: 18px; border: 1px solid rgba(0,0,0,.06); box-shadow: 0 10px 30px rgba(0,0,0,.08); }
    .editor-body{ padding: 28px 24px; }
    .editor-title{ font-size: 1.45rem; font-weight: 900; margin-bottom: 22px; color: #111827; }
    .form-label{ font-weight: 700; color: #1f2937; margin-bottom: 8px; }
    .form-control, .form-select{ border-radius: 14px; border: 1px solid rgba(0,0,0,.12); padding: 12px 14px; box-shadow: none; }
    .form-control:focus, .form-select:focus{ border-color: rgba(13,110,253,.45); box-shadow: 0 0 0 .2rem rgba(13,110,253,.12); }
    .save-btn{ border-radius: 999px; padding: 12px 20px; font-weight: 700; min-width: 180px; }
    .editor-message{ margin-top: 14px; color: #198754; font-weight: 600; }

    @media (max-width: 768px){
        .editor-image-wrap{ border-right: none; border-bottom: 1px solid rgba(0,0,0,.06); }
        .editor-body{ padding: 22px 16px; }
    }
</style>

<div class="container editor-page">
    <div class="editor-header">
        <h3>Редактор автомобиля</h3>
    </div>

    <div class="editor-card">
        <div class="row g-0 align-items-stretch">
            <div class="col-lg-5">
                <div class="editor-image-wrap">
                    <img src="{{ asset(ltrim($products->image, '/')) }}" class="editor-image" alt="">
                </div>
            </div>

            <div class="col-lg-7">
                <div class="editor-body">
                    <div class="editor-title">Изменение данных автомобиля для аренды</div>

                    <form method="post" action="{{route('editProducts',['id'=>$products->id])}}" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="name" class="form-label">Марка</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$products->name}}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="model" class="form-label">Модель</label>
                                <input type="text" class="form-control" id="model" name="model" value="{{$products->model}}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="cost" class="form-label">Цена за сутки</label>
                                <input type="text" class="form-control" id="cost" name="cost" value="{{$products->cost}}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="deposit" class="form-label">Залог</label>
                                <input type="number" class="form-control" id="deposit" name="deposit" value="{{$products->deposit ?? 10000}}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="country" class="form-label">Город выдачи</label>
                                <input type="text" class="form-control" id="country" name="country" value="{{$products->country}}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="year" class="form-label">Год</label>
                                <input type="text" class="form-control" id="year" name="year" value="{{$products->year}}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="mileage" class="form-label">Пробег, км</label>
                                <input type="text" class="form-control" id="mileage" name="mileage" value="{{$products->mileage}}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="condition_percent" class="form-label">Состояние, %</label>
                                <input type="number" class="form-control" id="condition_percent" name="condition_percent" min="1" max="100" value="{{$products->condition_percent ?? 90}}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="segment" class="form-label">Сегмент</label>
                                <select class="form-select" id="segment" name="segment">
                                    @foreach(['Бюджет','Комфорт','Бизнес-класс','Для компании','Для путешествия'] as $item)
                                        <option {{ ($products->segment ?? '') == $item ? 'selected' : '' }}>{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="color" class="form-label">Цвет</label>
                                <input type="text" class="form-control" id="color" name="color" value="{{$products->color ?? 'Не указан'}}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="body_type" class="form-label">Тип кузова</label>
                                <input type="text" class="form-control" id="body_type" name="body_type" value="{{$products->body_type ?? ''}}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="transmission" class="form-label">Коробка</label>
                                <select class="form-select" id="transmission" name="transmission">
                                    @foreach(['Автомат','Робот','Вариатор','Механика'] as $item)
                                        <option {{ ($products->transmission ?? '') == $item ? 'selected' : '' }}>{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="fuel_type" class="form-label">Топливо</label>
                                <select class="form-select" id="fuel_type" name="fuel_type">
                                    @foreach(['Бензин','Дизель','Гибрид','Электро'] as $item)
                                        <option {{ ($products->fuel_type ?? '') == $item ? 'selected' : '' }}>{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="drive_type" class="form-label">Привод</label>
                                <select class="form-select" id="drive_type" name="drive_type">
                                    @foreach(['Передний','Задний','Полный'] as $item)
                                        <option {{ ($products->drive_type ?? '') == $item ? 'selected' : '' }}>{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="seats" class="form-label">Количество мест</label>
                                <input type="number" class="form-control" id="seats" name="seats" value="{{$products->seats ?? 5}}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="availability_status" class="form-label">Статус</label>
                                <select class="form-select" id="availability_status" name="availability_status">
                                    @foreach(['Свободен','Занят'] as $item)
                                        <option {{ ($products->availability_status ?? '') == $item ? 'selected' : '' }}>{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="engine_power" class="form-label">Мощность</label>
                                <input type="text" class="form-control" id="engine_power" name="engine_power" value="{{$products->engine_power ?? ''}}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="engine_volume" class="form-label">Объем двигателя</label>
                                <input type="text" class="form-control" id="engine_volume" name="engine_volume" value="{{$products->engine_volume ?? ''}}">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="fuel_consumption" class="form-label">Расход</label>
                                <input type="text" class="form-control" id="fuel_consumption" name="fuel_consumption" value="{{$products->fuel_consumption ?? ''}}">
                            </div>


                            <div class="col-12">
                                <label for="description" class="form-label">Описание аренды</label>
                                <textarea class="form-control" id="description" name="description" rows="4">{{$products->description}}</textarea>
                            </div>

                            <div class="col-12">
                                <label for="image" class="form-label">Фото</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            </div>
                                                        <div class="col-12">
                                <button type="submit" class="btn btn-primary save-btn">
                                    Сохранить
                                </button>

                                <p class="editor-message">{{ session('message') }}</p>
                            </div>
                        </div>
                    </form>

                    <form action="{{ route('deleteProduct', $products->id) }}" method="POST" onsubmit="return confirm('Точно удалить этот автомобиль?')">
                        @csrf

                        <button type="submit" class="btn btn-danger mt-3">
                            Удалить автомобиль
                        </button>
                    </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
