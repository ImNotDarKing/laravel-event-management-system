@extends('layouts.app')
@vite(['resources/css/app.css'])
@section('content')
<div class="container">
  <h1>Заявки на мероприятия</h1>
  <table class="table">
    <thead>
      <tr><th>Название</th><th>Организатор</th><th>Статус</th><th>Действия</th></tr>
    </thead>
    <tbody>
      @foreach($pending as $e)
      <tr>
        <td>{{ $e->title }}</td>
        <td>{{ $e->organizer->name }}</td>
        <td>{{ $e->status }}</td>
        <td>
          <form method="POST" action="{{ route('admin.events.status', $e->id) }}" class="d-inline">
            @csrf
            <select name="status" class="form-select d-inline w-auto">
              <option value="approved">Одобрить</option>
              <option value="rejected">Отклонить</option>
            </select>
            <button class="btn btn-sm btn-primary">OK</button>
          </form>
          <form method="POST" action="{{ route('admin.events.destroy', $e->id) }}" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger">Удалить</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
