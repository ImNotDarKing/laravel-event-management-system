@extends('layouts.app')

@section('content')
<div class="container">
  <h1>{{ $event->title }}</h1>
  <p>{{ $event->description }}</p>
  <p><strong>Место:</strong> {{ $event->location }}</p>
  <p><strong>Дата:</strong> {{ $event->starts_at->format('d.m.Y H:i') }}</p>
  @auth
    @if(auth()->user()->role === 'visitor')
      <form method="POST" action="{{ route('events.attend', $event->id) }}">
        @csrf
        <button class="btn btn-success">Я пойду!</button>
      </form>
    @endif
  @endauth
</div>
@endsection
