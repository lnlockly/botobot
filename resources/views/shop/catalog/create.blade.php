@extends('layouts.shop')
@section('content')
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Добавить товар</h4>
            <form class="form-inline" method="post" action="{{ route('catalog.save'
            ) }}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="section1">Категория товара, услуги</label>
                        <input type="text" class="form-control" name="section1" id="section1">
                    </div>
                    <div class="col-sm-1">
                      <label for=""></label>
                      <img src="{{ asset('/images/indo.svg') }}" class="me-info" alt="load" data-toggle="popover" title="Информация" data-content="ИНФОРМАЦИЯ"/>
                    </div>
                    <div class="col-sm-5">
                        <label for="name">Название товара услуги</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="col-sm-1">
                      <label for=""></label>
                      <img src="{{ asset('/images/indo.svg') }}" class="me-info" alt="load" data-toggle="popover" title="Информация" data-content="ИНФОРМАЦИЯ" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="description">Описание</label>
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                    <div class="col-sm-1">
                      <label for=""></label>
                      <img src="{{ asset('/images/indo.svg') }}" class="me-info" alt="load" data-toggle="popover" title="Информация" data-content="ИНФОРМАЦИЯ"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="price">Цена товара</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="col-sm-1">
                      <label for=""></label>
                      <img src="{{ asset('/images/indo.svg') }}" class="me-info" alt="load" data-toggle="popover" title="Информация" data-content="ИНФОРМАЦИЯ" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="img">Ссылка на изображение товара, услуги</label>
                        <input type="text" class="form-control" id="img" name="img">
                    </div>
                    <div class="col-sm-1">
                      <label for=""></label>
                      <img src="{{ asset('/images/indo.svg') }}" class="me-info" alt="load" data-toggle="popover" title="Информация" data-content="ИНФОРМАЦИЯ"  />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="url">Ссылка на товар, услугу</label>
                        <input type="text" class="form-control" id="url" name="url">
                    </div>
                    <div class="col-sm-1">
                      <label for=""></label>
                      <img src="{{ asset('/images/indo.svg') }}" class="me-info" alt="load" data-toggle="popover" title="Информация" data-content="ИНФОРМАЦИЯ" />
                    </div>
                </div>
                <div class="button-css"><button type="submit" class="btn btn-primary me-2">Добавить товар</button>
                    <a type="button" class="btn btn-outline-primary" href="{{ route('shop.import.create') }}">Загрузить товары
                    <div class="load-img"><img src="{{ asset('/images/load.svg') }}" class="me-2" alt="load" /></div></a>
                    <a class="link-catalog" href="/download/chipbot.xlsx">Скачать структуру таблицы
                        <div class="img-catalog"><img src="{{ asset('/images/combo.svg') }}" alt="shoping-icon"/></div>
                    </a>
                        <div class="catalog-img"><img src="{{ asset('/images/indo.svg') }}" alt="shoping-icon" data-toggle="popover" title="Информация" data-content="ИНФОРМАЦИЯ"/></div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
