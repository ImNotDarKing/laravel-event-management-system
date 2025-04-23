@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Мои события</h1>

  <h3 class="mt-4">Будущие</h3>
  @forelse($upcoming as $e)
    <div class="d-flex align-items-center mb-2">
      <a href="{{ route('events.show', $e) }}">
        {{ $e->title }} ({{ $e->starts_at->format('d.m.Y H:i') }})
      </a>

      @php
        $going = auth()->user()
            ->attendances()
            ->where('event_id', $e->id)
            ->where('going', true)
            ->exists();
      @endphp

      @if(!$going)
        <form method="POST" action="{{ route('events.attend', $e->id) }}" class="ms-3">
          @csrf
          <button class="btn btn-sm btn-success">Я поеду</button>
        </form>
      @else
        <form method="POST" action="{{ route('events.unattend', $e->id) }}" class="ms-3 d-inline">
          @csrf
          @method('DELETE')
          <button class="btn btn-sm btn-outline-danger">Отменить</button>
        </form>
      @endif
    </div>
  @empty
    <p>Нет будущих мероприятий.</p>
  @endforelse

  <h3 class="mt-4">Прошедшие</h3>
  @forelse($past as $e)
    <div class="mb-2">
      <a href="{{ route('events.show', $e) }}">
        {{ $e->title }} ({{ $e->starts_at->format('d.m.Y') }})
      </a>
    </div>
  @empty
    <p>Нет прошедших мероприятий.</p>
  @endforelse

</div>
@endsection
