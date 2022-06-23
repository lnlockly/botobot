@extends('layouts.shop')
@section('content')
<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Заказы</h4>
       @livewire('orders-table-view')
    </div>
  </div>
</div>
@endsection