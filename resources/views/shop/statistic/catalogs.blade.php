@extends('layouts.shop')
@section('content')

<div class="col-lg-12">
  <div class="card">

    <div class="card-body">
      <h4 class="card-title">Товары </h4>
       @livewire('catalogs-table-view')
        <div class="button-css"><a class="btn btn-primary me-2" href="{{ route('catalog.create') }}">Добавить товар</a>
            <a type="button" class="btn btn-outline-primary" href="{{ route('shop.import.create') }}">Загрузить товары
                <div class="load-img"><img src="{{ asset('/images/load.svg') }}" class="me-2" alt="load" /></div></a>
            <a class="link-catalog" href="/download/chipbot.xlsx">Скачать структуру таблицы
                <div class="img-catalog"><img src="{{ asset('/images/combo.svg') }}" alt="shoping-icon"/></div>
            </a>
            <div class="catalog-img"><img src="{{ asset('/images/indo.svg') }}" alt="shoping-icon" data-toggle="popover" title="Информация" data-content="ИНФОРМАЦИЯ"/></div>
        </div>
  </div>
</div>
@endsection
