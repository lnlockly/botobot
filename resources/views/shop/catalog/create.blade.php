@extends('layouts.shop')
@section('content')
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add product</h4>
            <form class="form-inline" method="post" action="{{ route('catalog.save'
            ) }}">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label">Название товара</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="section1" class="col-sm-3 col-form-label">Раздел товара</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="section1" id="section1">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label">Описание товара</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="description" name="description">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-3 col-form-label">Ссылка на товар</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="url" name="url">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="img" class="col-sm-3 col-form-label">Ссылка на изображение товара</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="img" name="img">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-3 col-form-label">Цена товара</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
