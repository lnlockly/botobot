@extends('layouts.admin')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Пользователи</h4>
      <div class="table-responsive pt-3">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>
                Id
              </th>
              <th>
                Имя
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr>
              <td>
                {{ $user->telegram_id }}
              </td>
              <td>
                {{ $user->name }} 
              </td>
            </tr>
            @endforeach  
          </tbody>    
        </table>
      </div>
    </div>
  </div>
</div>
@endsection