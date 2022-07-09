@extends('layouts.shop')
@section('content')
@if(isset($message))
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endif
 
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Добавить товар</h4>
            <form class="form-inline" method="post" action="{{ route('catalog.save'
            ) }}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="inputFirstname">Категория товара, услуги</label>
                        <input type="text" class="form-control" name="name" id="inputFirstname">
                    </div>
                    <div class="col-sm-1">
                      <label for=""></label>
                      <img src="{{ asset('/images/indo.svg') }}" class="me-info" alt="load" />
                    </div>
                    <div class="col-sm-5">
                        <label for="inputLastname">Описание товара, услуги</label>
                        <input type="text" class="form-control" id="description" name="discription">
                    </div>
                    <div class="col-sm-1">
                      <label for=""></label>
                      <img src="{{ asset('/images/indo.svg') }}" class="me-info" alt="load" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="inputAddressLine1">Название товара, услуги</label>
                        <input type="text" class="form-control" id="inputAddressLine1" name="section1">
                    </div>
                    <div class="col-sm-1">
                      <label for=""></label>
                      <img src="{{ asset('/images/indo.svg') }}" class="me-info" alt="load" />
                    </div>
                    
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="price">Цена товара</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="col-sm-1">
                      <label for=""></label>
                      <img src="{{ asset('/images/indo.svg') }}" class="me-info" alt="load" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="img">Ссылка на изображение товара, услуги</label>
                        <input type="text" class="form-control" id="img" name="img">
                    </div>
                    <div class="col-sm-1">
                      <label for=""></label>
                      <img src="{{ asset('/images/indo.svg') }}" class="me-info" alt="load" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5">
                        <label for="inputContactNumber">Ссылка на товар, услугу</label>
                        <input type="text" class="form-control" id="inputContactNumber" name="url">
                    </div>
                    <div class="col-sm-1">
                      <label for=""></label>
                      <img src="{{ asset('/images/indo.svg') }}" class="me-info" alt="load" />
                    </div>
                </div>
                <div class="button-css"><button type="submit" class="btn btn-primary me-2">Добавить товар</button> <button type="button" class="btn btn-outline-primary">Загрузить товары
                  <div class="load-img"><img src="{{ asset('/images/load.svg') }}" class="me-2" alt="load" /></div></button> 
                  <a class="link-catalog" href="">Скачать структуру сайта<div class="img-catalog"><img src="{{ asset('/images/combo.svg') }}" alt="shoping-icon"/></a><a class="link-catalog" href="#"><div class="catalog-img"><img src="{{ asset('/images/indo.svg') }}" alt="shoping-icon"/></div></a></div></div>
                   
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
