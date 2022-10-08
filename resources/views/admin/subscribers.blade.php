@extends('layouts.admin')
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Реклама</h4>
                @livewire('subscribers-table-view')
            </div>
        </div>
    </div>
@endsection
