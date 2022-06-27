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
                <button type="submit" class="btn btn-primary me-2">Добавить</button>
            </form>
        </div>
    </div>
</div>
@endsection
