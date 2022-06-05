@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <script
                    async src="https://telegram.org/js/telegram-widget.js?19"
                    data-telegram-login="chipboto_bot"
                    data-size="large"
                    data-auth-url="http://151.248.121.198/telegram/callback" 
                    data-request-access="write">
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
