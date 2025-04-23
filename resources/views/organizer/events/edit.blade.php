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

    <input type="hidden" name="paid" value="0">
    <div class="form-check mb-3">
      <input
        class="form-check-input"
        type="checkbox"
        name="paid"
        id="paid"
        value="1"
        {{ (isset($event) && $event->paid) ? 'checked' : '' }}
      >
      <label class="form-check-label" for="paid">Платное мероприятие</label>
    </div>

    <div class="mb-3">
      <label class="form-label">Картинка</label>
      @if(isset($event) && $event->image)
        <div class="mb-3">
          <label class="form-label">Текущая картинка:</label><br>
          <img src="{{ asset('storage/' . $event->image) }}"
              alt="Preview"
              style="max-width: 200px; height: auto; border: 1px solid #ddd; padding: 4px;">
        </div>
      @endif
      <input type="file" name="image" class="form-control">
    </div>

    <button class="btn btn-success">{{ isset($event) ? 'Сохранить' : 'Создать' }}</button>
  </form>
</div>
@endsection
