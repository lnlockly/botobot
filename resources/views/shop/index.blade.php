@extends('layouts.shop')
@section('content')
<div class="row">
    
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Создание магазина</h4>
                <form class="forms-sample" method="post" action="{{ route('shop.save'
            ) }}">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="col-sm-2 col-form-label">Имя</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" id="ename" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bot_token" class="col-sm-2 col-form-label">Токен бота</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="bot_token" name="bot_token"
                                placeholder="Bot's token">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bot_token" class="col-sm-4 col-form-label">Валюта магазина</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="currency">
                                <option value="RUB">Российский рубль</option>
                                <option value="USD">Доллар США</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Создать</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin ">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Инструкция</h4>
                <p class="card-description">
                    1. Обратитесь к боту @BotFather в Telegram
                </p>
                <p class="card-description">
                    2. Командой /newbot создайте бота
                </p>
                <p class="card-description">
                    3. Укажите имя бота и username
                </p>
                <p class="card-description">
                    4. В ответном сообщении бот пришлет токен
                </p>
                <p class="card-description">
                    5. Укажите его в поле Токен бота
                </p>

            </div>
        </div>
    </div>
    <style>
        .col-form-label {
            padding-top: 0;
        }
    </style>
    @endsection