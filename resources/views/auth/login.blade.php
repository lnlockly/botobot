@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <script async src="https://telegram.org/js/telegram-widget.js?19" data-telegram-login="chipboto_bot" data-size="large" data-onauth="onTelegramAuth(user)" data-request-access="write"></script>
                    <script type="text/javascript">
                    function onTelegramAuth(user) {
                        alert('Logged in as ' + user.first_name + ' ' + user.last_name + ' (' + user.id + (user.username ? ', @' + user.username : '') + ')');
                    }

                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
