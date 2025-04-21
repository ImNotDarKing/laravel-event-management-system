@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Мои мероприятия</h1>
  <a href="{{ route('organizer.events.create') }}" class="btn btn-primary mb-3">Создать новое</a>
  <ul class="list-group">
    @foreach($events as $e)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        {{ $e->title }} <span class="badge bg-secondary">{{ $e->status }}</span>
        <div>
          <a href="{{ route('organizer.events.edit', $e) }}" class="btn btn-sm btn-outline-warning">Ред.</a>
          <form action="{{ route('organizer.events.destroy', $e) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-outline-danger">Удалить</button>
          </form>
        </div>
      </li>
    @endforeach
  </ul>
</div>
@endsection
