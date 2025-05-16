@extends('layouts.app')
@vite(['resources/css/app.css'])
@vite(['resources/js/app.js'])
@section('content')
<div class="container">
  <h1 class="mb-4">Все мероприятия</h1>

  @foreach($events as $e)
    <div class="card mb-3 slide-up">
      <div class="card-body d-flex align-items-star scroll-animate">
        <div class="card-content flex-grow-1">
          <h5 class="card-title">
            {{ $e->title }}
            @if($e->paid)
              <span class="badge bg-warning text-dark">Платно</span>
            @else
              <span class="badge bg-success">Бесплатно</span>
            @endif
          </h5>
          <p class="card-text">{{ $e->short_description }}</p>
          <p class="card-text"><small class="text-muted">{{ $e->starts_at->format('d.m.Y H:i') }}</small></p>
          <a href="{{ route('events.show', $e) }}" class="btn btn-primary btn-more">Подробнее</a>
        </div>
        @if($e->image)
          <img src="{{ Storage::url($e->image) }}"
              alt="{{ $e->title }}"
              class="card-img"
              />
        @endif
      </div>
    </div>
  @endforeach
</div>
@endsection

