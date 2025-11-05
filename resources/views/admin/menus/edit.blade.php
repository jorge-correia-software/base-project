@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('content')
<x-page-header
    icon="menu"
    title="{{ $menu->name }}"
    subtitle="Update menu information and manage menu items"
    :backRoute="route('admin.menus.index')"
/>

<div class="row">
    <div class="col-12 col-xl-8 mx-auto">
        <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <!-- Left Column: Menu Details & Structure -->
                <div class="col-lg-8">
                    <x-admin.card title="Edit Menu" position="first">
                        <x-admin.form-fieldset legend="Menu Details">
                            <x-admin.text-input
                                name="name"
                                label="Menu Name"
                                :value="$menu->name"
                                required
                                :filled="true"
                            />

                            <x-admin.text-input
                                name="slug"
                                label="Slug"
                                :value="$menu->slug"
                                readonly
                                help="Auto-generated from name"
                                mb="mb-3"
                            />

                            <x-admin.form-fieldset legend="Menu Location" mb="mb-3">
                                <div class="mb-2">
                                    <select name="location" id="location" class="form-control @error('location') is-invalid @enderror" required>
                                        <option value="">Select Location</option>
                                        <option value="header" {{ old('location', $menu->location) === 'header' ? 'selected' : '' }}>Header</option>
                                        <option value="footer" {{ old('location', $menu->location) === 'footer' ? 'selected' : '' }}>Footer</option>
                                        <option value="sidebar" {{ old('location', $menu->location) === 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                                    </select>
                                    @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </x-admin.form-fieldset>

                            <x-admin.checkbox-input
                                name="is_active"
                                label="Active Menu"
                                :checked="$menu->is_active"
                                mb="mb-0"
                            />
                        </x-admin.form-fieldset>
                    </x-admin.card>

                    <x-admin.card title="Menu Structure">
                        <div class="alert alert-info mb-3">
                            <i class="material-symbols-rounded">info</i>
                            <strong>Instructions:</strong> Drag each item into the order you prefer. Click the edit icon to reveal additional configuration options.
                        </div>

                        <div class="menu-structure-container">
                            <div class="dd" id="menuStructure">
                                <ol class="dd-list">
                                    @forelse($menu->items as $item)
                                        @include('admin.menus.partials.menu-item', ['item' => $item])
                                    @empty
                                        <div class="text-center py-4 text-muted">
                                            <i class="material-symbols-rounded" style="font-size: 3rem; opacity: 0.3;">menu</i>
                                            <p>No menu items yet. Add pages or custom links from the sidebar.</p>
                                        </div>
                                    @endforelse
                                </ol>
                            </div>
                        </div>

                        @if($menu->items->count() > 0)
                            <x-admin.card-actions buttonText="Save" buttonId="saveMenuStructure" />
                        @endif
                    </x-admin.card>
                </div>

                <!-- Right Column: Sidebar Cards -->
                <div class="col-lg-4">
                    <!-- Publish Card -->
                    <x-admin.card title="Publish" position="first">
                        <x-admin.form-fieldset legend="Menu Status" mb="mb-4">
                            <div class="mb-2">
                                <select name="is_active" id="is_active" class="form-control @error('is_active') is-invalid @enderror" required>
                                    <option value="">Select Status</option>
                                    <option value="1" {{ old('is_active', $menu->is_active) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('is_active', $menu->is_active) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </x-admin.form-fieldset>

                        <x-admin.form-actions
                            :cancelRoute="route('admin.menus.index')"
                            submitText="Update Menu"
                        />
                    </x-admin.card>

                    <!-- Add Pages Card -->
                    <x-admin.card title="Add Pages">
                        <x-admin.form-fieldset legend="Available Pages" mb="mb-0">
                            <div class="menu-items-list" style="max-height: 300px; overflow-y: auto;">
                                @forelse($pages as $page)
                                    <div class="form-check mb-1">
                                        <input class="form-check-input page-checkbox" type="checkbox" value="{{ $page->id }}" id="page-{{ $page->id }}">
                                        <label class="form-check-label" for="page-{{ $page->id }}">
                                            <small>{{ $page->title }}</small>
                                        </label>
                                    </div>
                                @empty
                                    <p class="text-sm text-muted mb-0">No published pages available</p>
                                @endforelse
                            </div>

                            @if($pages->count() > 0)
                                <div class="mt-2 mb-0">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input page-checkbox" type="checkbox" id="selectAllPages">
                                        <label class="form-check-label" for="selectAllPages">
                                            <small>Select All</small>
                                        </label>
                                    </div>
                                </div>
                            @endif
                        </x-admin.form-fieldset>

                        @if($pages->count() > 0)
                            <x-admin.card-actions buttonText="Add to Menu" buttonId="addPagesToMenu" />
                        @endif
                    </x-admin.card>

                    <!-- Add Custom Links Card -->
                    <x-admin.card title="Add Custom Links">
                        <x-admin.form-fieldset legend="Custom Link Details" mb="mb-0">
                            <div class="mb-3">
                                <label class="form-label text-sm">URL *</label>
                                <input type="text" class="form-control form-control-sm" id="customLinkUrl" placeholder="https://example.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label text-sm">Link Text *</label>
                                <input type="text" class="form-control form-control-sm" id="customLinkText" placeholder="My Custom Link">
                            </div>
                            <div class="mb-0">
                                <label class="form-label text-sm">Open in</label>
                                <select class="form-select form-select-sm" id="customLinkTarget">
                                    <option value="_self">Same window</option>
                                    <option value="_blank">New window</option>
                                </select>
                            </div>
                        </x-admin.form-fieldset>

                        <x-admin.card-actions buttonText="Add to Menu" buttonId="addCustomLink" />
                    </x-admin.card>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Nestable2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/dist/jquery.nestable.min.css">

<!-- Menu Builder CSS -->
<link rel="stylesheet" href="{{ asset('css/menu-builder.css') }}">

<x-admin.select2-styles />

@endsection

@push('scripts')
<!-- Nestable2 JS -->
<script src="https://cdn.jsdelivr.net/npm/nestable2@1.6.0/dist/jquery.nestable.min.js"></script>

<!-- Menu Builder JS -->
<script src="{{ asset('js/menu-builder.js') }}"></script>

<script>
$(document).ready(function() {
    // Auto-generate slug from name
    $('input[name="name"]').on('keyup', function() {
        const name = $(this).val();
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        $('input[name="slug"]').val(slug);
    });

    // Initialize Select2 for Menu Status
    $('#is_active').select2({
        placeholder: 'Select Status',
        allowClear: true,
        width: '100%'
    });

    // Initialize Select2 for Location
    $('#location').select2({
        placeholder: 'Select Location',
        allowClear: true,
        width: '100%'
    });

    // Initialize Menu Builder
    MenuBuilder.init({{ $menu->id }});
});
</script>
@endpush
