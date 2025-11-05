@extends('layouts.admin')
@section('title', 'Settings')
@section('content')
<div class="row"><div class="col-12"><div class="card my-4">
<div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
<div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
<h6 class="text-white ps-3">Site Settings</h6></div></div>
<div class="card-body"><div class="row">
<div class="col-md-6 mb-4"><div class="card h-100"><div class="card-body">
<h6 class="mb-3">General Settings</h6>
<p class="text-sm text-secondary mb-3">Site name, tagline, and basic information</p>
<a href="{{ route('admin.settings.group', 'general') }}" class="btn btn-primary btn-sm">Manage</a>
</div></div></div>
<div class="col-md-6 mb-4"><div class="card h-100"><div class="card-body">
<h6 class="mb-3">SEO Settings</h6>
<p class="text-sm text-secondary mb-3">Meta tags, descriptions, and search engine optimization</p>
<a href="{{ route('admin.settings.group', 'seo') }}" class="btn btn-primary btn-sm">Manage</a>
</div></div></div>
<div class="col-md-6 mb-4"><div class="card h-100"><div class="card-body">
<h6 class="mb-3">Social Media</h6>
<p class="text-sm text-secondary mb-3">Social media links and integration</p>
<a href="{{ route('admin.settings.group', 'social') }}" class="btn btn-primary btn-sm">Manage</a>
</div></div></div>
<div class="col-md-6 mb-4"><div class="card h-100"><div class="card-body">
<h6 class="mb-3">Contact Information</h6>
<p class="text-sm text-secondary mb-3">Contact details and address</p>
<a href="{{ route('admin.settings.group', 'contact') }}" class="btn btn-primary btn-sm">Manage</a>
</div></div></div>
</div></div></div></div></div>
@endsection
