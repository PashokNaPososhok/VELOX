@extends('layouts.app')

@section('content')
<style>
    .podbor-wrap{ padding: 26px 0 60px; }

    .podbor-header{
        margin: 10px 0 18px;
        border-radius: 18px;
        padding: 28px 22px;
        background: linear-gradient(135deg, rgba(10,12,16,1) 0%, rgba(20,24,34,1) 60%, rgba(13,110,253,.22) 100%);
        color: #fff;
        box-shadow: 0 16px 45px rgba(0,0,0,.18);
        overflow: hidden;
        position: relative;
        text-align: center;
    }

    .podbor-header::after{
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(900px 400px at 20% 40%, rgba(255,255,255,.10), rgba(255,255,255,0) 60%);
        pointer-events: none;
    }

    .podbor-title{ font-weight: 900; margin: 0; letter-spacing: .2px; position: relative; z-index: 1; }
    .podbor-subtitle{ margin: 8px auto 0; opacity: .88; max-width: 78ch; position: relative; z-index: 1; }

    .podbor-panel{
        border-radius: 18px;
        background: rgba(255,255,255,.92);
        border: 1px solid rgba(0,0,0,.06);
        box-shadow: 0 14px 40px rgba(0,0,0,.08);
        padding: 20px;
    }

    .podbor-panel-title{ font-weight: 900; margin: 0 0 14px; color: #111827; }
    .podbor-field{ margin-bottom: 14px; }
    .podbor-field label{ font-weight: 700; color: #374151; margin-bottom: 7px; }

    .podbor-panel .form-control,
    .podbor-panel .form-select{
        border-radius: 14px;
        border: 1px solid rgba(0,0,0,.12);
        padding: 10px 12px;
        background-color: #fff;
    }

    .range-line{ display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }

    .condition-preview{
        border-radius: 16px;
        background: #f8f9fa;
        border: 1px solid rgba(0,0,0,.06);
        padding: 16px;
    }

    .condition-preview-top{ display:flex; justify-content:space-between; align-items:center; gap:12px; margin-bottom:10px; }
    .condition-preview-title{ font-weight:900; color:#111827; }
    .condition-preview-value{ font-weight:900; font-size:1.35rem; color:#0d6efd; }
    .condition-track{ height: 12px; border-radius:999px; background:#e9ecef; overflow:hidden; }
    .condition-fill{ height:100%; border-radius:999px; background: linear-gradient(90deg, #198754, #0d6efd); width: 90%; transition: width .2s ease; }
    .condition-hint{ color:#6c757d; font-size:.95rem; margin-top:10px; line-height:1.6; }
    .podbor-actions .btn{ border-radius: 999px; padding: 11px 18px; font-weight: 800; }

    .result-section{ margin-top: 24px; }
    .result-title{ font-weight: 900; margin: 0 0 14px; }
    .result-card{
        border-radius: 18px;
        background:#fff;
        border:1px solid rgba(0,0,0,.06);
        box-shadow:0 12px 30px rgba(0,0,0,.08);
        padding:14px;
        height:100%;
    }
    .result-img{ width:100%; aspect-ratio:16 / 9; object-fit:cover; border-radius:14px; border:1px solid rgba(0,0,0,.06); margin-bottom:12px; }
    .result-name{ font-weight:900; margin-bottom:8px; color:#111827; }
    .result-chips{ display:flex; flex-wrap:wrap; gap:8px; margin-bottom:12px; }
    .result-chip{ display:inline-flex; padding:7px 11px; border-radius:999px; background:#f3f4f6; border:1px solid rgba(0,0,0,.06); font-size:.9rem; font-weight:700; color:#374151; }
    .result-price{ font-weight:900; color:#111827; margin-bottom:12px; }
    .result-actions .btn{ border-radius:999px; font-weight:800; }
    .empty-result{ border-radius:18px; background:#fff; border:1px solid rgba(0,0,0,.06); padding:20px; color:#6c757d; }

    @media (max-width: 576px){
        .podbor-panel{ padding: 16px; }
        .range-line{ grid-template-columns: 1fr; }
    }
</style>

<div class="container podbor-wrap">
    <div class="podbor-header">
        <h1 class="podbor-title">Индивидуальный подбор аренды</h1>
        <p class="podbor-subtitle">
            Подбор показывает свободные автомобили по сегменту, цвету, цене, местам и состоянию.
        </p>
    </div>

    <form class="podbor-panel" action="{{ route('podbor') }}" method="get">
        <h4 class="podbor-panel-title">Параметры подбора</h4>

        <div class="row g-3">
            <div class="col-12 col-md-6">
                <div class="podbor-field">
                    <label for="segment" class="form-label">Ценовой сегмент</label>
                    <select class="form-select" id="segment" name="segment">
                        <option {{ request('segment') == 'Не важно' ? 'selected' : '' }}>Не важно</option>
                        @foreach($segments as $segment)
                            <option {{ request('segment') == $segment ? 'selected' : '' }}>{{ $segment }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="col-12 col-md-6">
                <div class="podbor-field">
                    <label for="color" class="form-label">Цвет</label>
                    <select class="form-select" id="color" name="color">
                        <option {{ request('color') == 'Не важно' ? 'selected' : '' }}>Не важно</option>
                        @foreach($colors as $color)
                            <option {{ request('color') == $color ? 'selected' : '' }}>{{ $color }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="podbor-field">
                    <label for="seats" class="form-label">Количество мест</label>
                    <select class="form-select" id="seats" name="seats">
                        @foreach(['Не важно','2 места','5 мест','7 мест','8+ мест'] as $item)
                            <option {{ request('seats') == $item ? 'selected' : '' }}>{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12">
                <div class="podbor-field">
                    <label class="form-label">Бюджет аренды, руб./сутки</label>
                    <div class="range-line">
                        <input type="number" class="form-control" name="price_from" value="{{ request('price_from') }}" placeholder="От 2000">
                        <input type="number" class="form-control" name="price_to" value="{{ request('price_to') }}" placeholder="До 12000">
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="podbor-field">
                    <label for="conditionRange" class="form-label">Минимальное состояние автомобиля</label>
                    <input type="range" class="form-range" id="conditionRange" name="condition_percent" min="70" max="100" value="{{ request('condition_percent', 90) }}">
                    <div class="condition-preview">
                        <div class="condition-preview-top">
                            <div class="condition-preview-title">Игровой рейтинг состояния</div>
                            <div class="condition-preview-value"><span id="conditionValue">{{ request('condition_percent', 90) }}</span>%</div>
                        </div>
                        <div class="condition-track">
                            <div class="condition-fill" id="conditionFill"></div>
                        </div>
                        <div class="condition-hint">
                            Процент объединяет внешний вид, пробег, возраст, салон и техническую готовность.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="podbor-actions d-grid d-md-flex gap-2 mt-2">
            <button type="submit" name="find" value="1" class="btn btn-dark">Подобрать из базы</button>
            <a href="{{ route('podbor') }}" class="btn btn-outline-dark">Очистить форму</a>
        </div>
    </form>

    @if($hasSelection)
        <div class="result-section">
            <h3 class="result-title">Подходящие автомобили</h3>
            <div class="row g-3">
                @forelse($matchedCars as $car)
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="result-card">
                            <img src="{{ asset(ltrim($car->image, '/')) }}" class="result-img" alt="{{$car->name}} {{$car->model}}">
                            <div class="result-name">{{$car->name}} {{$car->model}}</div>
                            <div class="result-chips">
                                <span class="result-chip">{{$car->segment}}</span>
                                <span class="result-chip">{{$car->color}}</span>
                                <span class="result-chip">{{$car->condition_percent}}%</span>
                                <span class="result-chip">{{$car->seats}} мест</span>
                                <span class="result-chip">{{$car->availability_status}}</span>
                            </div>
                            <div class="result-price">от {{$car->cost}} ₽/сутки</div>
                            <div class="result-actions d-grid gap-2">
                                <a href="{{ route('card', ['id' => $car->id]) }}" class="btn btn-outline-dark">Открыть карточку</a>
                                <a href="{{ route('contact', ['car_id' => $car->id, 'car' => $car->name . ' ' . $car->model, 'segment' => $car->segment, 'color' => $car->color, 'condition_percent' => $car->condition_percent]) }}" class="btn btn-dark">Оставить заявку</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-result">
                            Подходящих свободных автомобилей не найдено. Можно снизить минимальное состояние, расширить бюджет или выбрать цвет “Не важно”.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    @endif
</div>

<script>
    const conditionRange = document.getElementById('conditionRange');
    const conditionValue = document.getElementById('conditionValue');
    const conditionFill = document.getElementById('conditionFill');

    function updateCondition(){
        conditionValue.textContent = conditionRange.value;
        conditionFill.style.width = conditionRange.value + '%';
    }

    conditionRange.addEventListener('input', updateCondition);
    updateCondition();
</script>
@endsection
