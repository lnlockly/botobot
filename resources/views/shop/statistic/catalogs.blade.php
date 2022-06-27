@extends('layouts.shop')
@section('content')

<div class="col-lg-12">
  <div class="card">
    
    <div class="card-body">
      <h4 class="card-title">Товары </h4>
       @livewire('catalogs-table-view')
       <div class="text-right"> <a class="btn btn-primary" href="{{ route('catalog.create') }}">Добавить товар</a></div>
    </div>
  </div>
</div>
@endsection