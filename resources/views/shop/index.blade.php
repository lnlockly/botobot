@extends('layouts.shop')
@section('content')
<div class="col-md-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Bot add</h4>
            <form class="forms-sample" method="post" action="{{ route('shop.save'
            ) }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Имя</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" id="ename" placeholder="Username">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="bot_token" class="col-sm-3 col-form-label">Токен бота</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="bot_token" name="bot_token" placeholder="Bot's token">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary me-2">Создать</button>
            </form>
            <form method="post" action="{{ route('catalog.save') }}">
                @csrf
                <button type="submit" class="btn btn-light">Import</button>
            </form>
        </div>
    </div>
</div>
@endsection
