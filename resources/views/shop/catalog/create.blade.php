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
                    <label for="name" >Категория товара, услуги</label>
                    <div class="col-sm-5 ">
                        <input type="text" class="form-control" name="name" id="section1">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="section1">Название товара,услуги</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="section1" id="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description">Описание</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url">Ссылка на товар, услугу</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="url" name="url">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="img">Ссылка на изображение товара, услуги</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="img" name="img">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price">Цена товара</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                </div>
                <div class="button-css"><button type="submit" class="btn btn-primary me-2">Добавить товар</button>
                    <button type="button" class="btn btn-outline-dark">Загрузить товары
                        <div class="load-img"><img src="{{ asset('/images/load.svg') }}" class="me-2" alt="load" /></div>
                </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
