@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form method="post" action="{{ route('shop.save') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bot_token" class="col-md-4 col-form-label text-md-right">Bot's token</label>

                            <div class="col-md-6">
                                <input id="bot_token" type="text" class="form-control" name="bot_token" value="{{ old('bot_token') }}" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                    <form method="post" action="{{ route('catalog.save') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
