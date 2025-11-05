@extends('layouts.admin')
@section('title', 'Edit Hero Section')
@section('content')
<div class="row"><div class="col-lg-8 mx-auto"><div class="card my-4"><div class="card-body">
<form action="{{ route('admin.hero-sections.update', $heroSection) }}" method="POST">@csrf @method('PUT')
<div class="input-group input-group-outline mb-3 is-filled"><label class="form-label">Title *</label>
<input type="text" class="form-control" name="title" value="{{ $heroSection->title }}" required></div>
<div class="input-group input-group-outline mb-3 {{ $heroSection->subtitle ? 'is-filled' : '' }}"><label class="form-label">Subtitle</label>
<textarea class="form-control" name="subtitle" rows="2">{{ $heroSection->subtitle }}</textarea></div>
<div class="input-group input-group-outline mb-3 {{ $heroSection->button_text ? 'is-filled' : '' }}"><label class="form-label">Button Text</label>
<input type="text" class="form-control" name="button_text" value="{{ $heroSection->button_text }}"></div>
<div class="input-group input-group-outline mb-3 {{ $heroSection->button_url ? 'is-filled' : '' }}"><label class="form-label">Button URL</label>
<input type="text" class="form-control" name="button_url" value="{{ $heroSection->button_url }}"></div>
<div class="input-group input-group-outline mb-3 is-filled"><label class="form-label">Order</label>
<input type="number" class="form-control" name="order" value="{{ $heroSection->order }}"></div>
<div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $heroSection->is_active ? 'checked' : '' }}>
<label class="form-check-label">Active</label></div>
<button type="submit" class="btn btn-primary">Update</button>
<a href="{{ route('admin.hero-sections.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form></div></div></div></div>
@endsection
