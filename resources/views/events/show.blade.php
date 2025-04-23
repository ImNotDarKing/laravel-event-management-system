@extends('layouts.app')

@section('content')
<div class="container">
  <h1>{{ $event->title }}</h1>
  <p>{{ $event->description }}</p>
  @if(isset($event) && $event->image)
    <img src="{{ Storage::url($event->image) }}" alt="Preview" style="max-width:700px;">
  @endif
  <p><strong>Место:</strong> {{ $event->location }}</p>
  <p><strong>Дата:</strong> {{ $event->starts_at->format('d.m.Y H:i') }}</p>
  @auth
    @if(auth()->user()->role === 'visitor')
      @php
        $going = auth()->user()
          ->attendances()
          ->where('event_id', $event->id)
          ->where('going', true)
          ->exists();
      @endphp

      @if($going)
        {{-- Кнопка Отменить участие --}}
        <form method="POST" action="{{ route('events.unattend', $event->id) }}">
          @csrf
          @method('DELETE')
          <button class="btn btn-warning">Отменить участие</button>
        </form>
      @else
        {{-- Кнопка Я пойду --}}
        <form method="POST" action="{{ route('events.attend', $event->id) }}">
          @csrf
          <button class="btn btn-success">Я пойду!</button>
        </form>
      @endif
    @endif
  @endauth
</div>
@endsection

