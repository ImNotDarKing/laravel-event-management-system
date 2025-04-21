@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-4">Все мероприятия</h1>

  @foreach($events as $e)
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">{{ $e->title }}</h5>
        <p class="card-text">{{ $e->short_description }}</p>
        <p class="card-text"><small class="text-muted">{{ $e->starts_at->format('d.m.Y H:i') }}</small></p>
        <a href="{{ route('events.show', $e) }}" class="btn btn-primary">Подробнее</a>
      </div>
    </div>
  @endforeach
</div>
@endsection

