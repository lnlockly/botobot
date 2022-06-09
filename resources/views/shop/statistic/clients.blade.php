@extends('layouts.shop')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Клиенты</h4>
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
              <th>
                Username
              </th>
              <th>
                Первое обращение
              </th>
              <th>
                Последнее обращение
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($clients as $client)
            <tr>
              <td>
                {{ $client->telegram_id }}
              </td>
              <td>
                {{ $client->first_name }}  {{ $client->last_name }}
              </td>
              <td>
                {{ $client->username }}
              </td>
              <td>
                {{ $client->created_at }}
              </td>
              <td>
                {{ $client->updated_at }}
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