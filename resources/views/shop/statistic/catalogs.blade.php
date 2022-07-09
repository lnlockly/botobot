@extends('layouts.shop')
@section('content')

<div class="col-lg-12">
  <div class="card">
    
    <div class="card-body">
      <h4 class="card-title">Товары </h4>
       @livewire('catalogs-table-view')
       <div class="button-css"> <a class="btn btn-primary" href="{{ route('catalog.create') }}">Добавить товар</a> <button type="button" class="btn btn-outline-primary">Загрузить товары<div class="load-img"><img src="{{ asset('/images/load.svg') }}" class="me-2" alt="load" /></div></button>
          <a class="link-catalog" href="">Скачать структуру сайта<div class="img-catalog"><img src="{{ asset('/images/combo.svg') }}" alt="shoping-icon"/></a><a class="link-catalog" href="#"><div class="catalog-img"><img src="{{ asset('/images/indo.svg') }}" alt="shoping-icon"/></div></a></div></div>
      </div>
  </div>
</div>
@endsectionhttps://github.com/lnlockly/botobot