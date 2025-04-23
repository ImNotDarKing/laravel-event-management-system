@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-4">Все мероприятия</h1>

  @foreach($events as $e)
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title">
          {{ $e->title }}
          @if($e->paid)
            <span class="badge bg-warning text-dark">Платно</span>
          @else
            <span class="badge bg-success">Бесплатно</span>
          @endif
        </h5>
        <p class="card-text">{{ $e->short_description }}</p>
        @if($e->image)
          <img src="{{ Storage::url($e->image) }}"
              alt="{{ $e->title }}"
              class="img-fluid mb-2"
              style="max-width:200px;">
        @endif
        <p class="card-text"><small class="text-muted">{{ $e->starts_at->format('d.m.Y H:i') }}</small></p>
        <a href="{{ route('events.show', $e) }}" class="btn btn-primary">Подробнее</a>
      </div>
    </div>
  @endforeach
</div>
@endsection

