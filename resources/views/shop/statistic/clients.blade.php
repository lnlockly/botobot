@extends('layouts.shop')
@section('content')
<div class="col-lg-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Клиенты</h4>
       @livewire('clients-table-view')
    </div>
  </div>
</div>
@endsection