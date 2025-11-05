@extends('layouts.admin')
@section('title', 'Create Hero Section')
@section('content')
<div class="row"><div class="col-lg-8 mx-auto"><div class="card my-4"><div class="card-body">
<form action="{{ route('admin.hero-sections.store') }}" method="POST">@csrf
<div class="input-group input-group-outline mb-3"><label class="form-label">Title *</label>
<input type="text" class="form-control" name="title" required></div>
<div class="input-group input-group-outline mb-3"><label class="form-label">Subtitle</label>
<textarea class="form-control" name="subtitle" rows="2"></textarea></div>
<div class="input-group input-group-outline mb-3"><label class="form-label">Button Text</label>
<input type="text" class="form-control" name="button_text"></div>
<div class="input-group input-group-outline mb-3"><label class="form-label">Button URL</label>
<input type="text" class="form-control" name="button_url"></div>
<div class="input-group input-group-outline mb-3"><label class="form-label">Order</label>
<input type="number" class="form-control" name="order" value="0"></div>
<div class="form-check mb-3"><input class="form-check-input" type="checkbox" name="is_active" value="1" checked>
<label class="form-check-label">Active</label></div>
<button type="submit" class="btn btn-primary">Create</button>
<a href="{{ route('admin.hero-sections.index') }}" class="btn btn-outline-secondary">Cancel</a>
</form></div></div></div></div>
@endsection
