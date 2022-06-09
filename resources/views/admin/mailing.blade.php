@extends('layouts.admin')
@section('content')
<div class="grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Разослать сообщение</h4>
            <form class="form-inline" method="post" action="{{ route('admin.mailing.save'
            ) }}">
                @csrf
                <div class="form-group row">
                    <label for="text" class="col-sm-3 col-form-label">Текст сообщения</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" name="text">
                            <a href="vk.com">Ссылка на сайт</a><br>
                            <p>Строка</p>
                        </textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
