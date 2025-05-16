@extends('layouts.app')

@section('content')
<div class="container event-detail">
  <h1>{{ $event->title }}</h1>
  <p>{{ $event->description }}</p>

  @if(isset($event) && $event->image)
    <img src="{{ Storage::url($event->image) }}" alt="Preview">
  @endif

  <div class="meta">
    <div><strong>Место:</strong> {{ $event->location }}</div>
    <div><strong>Дата:</strong> {{ $event->starts_at->format('d.m.Y H:i') }}</div>
  </div>

  @auth
    @if(auth()->user()->role === 'visitor')
      <div class="actions">
        @php
          $going = auth()->user()
            ->attendances()
            ->where('event_id', $event->id)
            ->where('going', true)
            ->exists();
        @endphp

        @if($going)
          <form method="POST" action="{{ route('events.unattend', $event->id) }}" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-warning">Отменить участие</button>
          </form>
        @else
          <form method="POST" action="{{ route('events.attend', $event->id) }}" class="d-inline">
            @csrf
            <button class="btn btn-success">Я пойду!</button>
          </form>
        @endif
      </div>
    @endif
  @endauth
</div>
@endsection
