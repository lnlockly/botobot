@extends('layouts.shop')
@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Загрузить товары</h4>
                <form action="{{ route('shop.import.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" style="padding:0 2px 30px 5px">
                    <div class="button-css"> <button class="btn btn-primary" type="submit">Добавить товар</button> </div>
                </form>
        </div>
    </div>
    </div>
@endsection
