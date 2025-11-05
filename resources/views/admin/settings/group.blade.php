@extends('layouts.admin')
@section('title', ucfirst($group) . ' Settings')
@section('content')
<div class="row"><div class="col-lg-8 mx-auto"><div class="card my-4">
<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
<h6 class="text-white ps-3">{{ ucfirst($group) }} Settings</h6></div></div>
<div class="card-body"><form action="{{ route('admin.settings.update') }}" method="POST">@csrf
@foreach($settings as $setting)
<div class="mb-3"><label class="form-label">{{ ucwords(str_replace('_', ' ', $setting->key)) }}</label>
@if($setting->type == 'textarea')
<textarea class="form-control" name="{{ $setting->key }}" rows="3">{{ $setting->value }}</textarea>
@else
<input type="{{ $setting->type }}" class="form-control" name="{{ $setting->key }}" value="{{ $setting->value }}">
@endif
</div>
@endforeach
<button type="submit" class="btn btn-primary">Save Changes</button>
<a href="{{ route('admin.settings.index') }}" class="btn btn-outline-secondary">Back</a>
</form></div></div></div></div>
@endsection
