@extends('layouts.app')

@section('content')
<div class="container">
  <h1>{{ isset($event) ? 'Редактировать' : 'Создать' }} мероприятие</h1>
  <form method="POST"
        action="{{ isset($event)
            ? route('organizer.events.update', $event)
            : route('organizer.events.store') }}"
        enctype="multipart/form-data">
    @csrf
    @if(isset($event)) @method('PUT') @endif

    <div class="mb-3">
      <label class="form-label">Название</label>
      <input name="title" class="form-control"
             value="{{ $event->title ?? old('title') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Краткое описание</label>
      <textarea name="short_description" class="form-control" required>{{ $event->short_description ?? old('short_description') }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Полное описание</label>
      <textarea name="description" class="form-control">{{ $event->description ?? old('description') }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Место</label>
      <input name="location" class="form-control"
             value="{{ $event->location ?? old('location') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Дата и время</label>
      <input type="datetime-local" name="starts_at" class="form-control"
             value="{{ isset($event)
                 ? $event->starts_at->format('Y-m-d\TH:i')
                 : old('starts_at') }}"
             required>
    </div>

    <div class="form-check mb-3">
      <input type="checkbox" name="paid" class="form-check-input"
             {{ (isset($event) && $event->paid) ? 'checked' : '' }}>
      <label class="form-check-label">Платное мероприятие</label>
    </div>

    <div class="mb-3">
      <label class="form-label">Картинка</label>
      <input type="file" name="image" class="form-control">
    </div>

    <button class="btn btn-success">{{ isset($event) ? 'Сохранить' : 'Создать' }}</button>
  </form>
</div>
@endsection
