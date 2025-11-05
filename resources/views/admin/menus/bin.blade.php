@extends('layouts.admin')

@section('title', 'Bin')

@section('content')
<x-page-header
    icon="delete"
    title="Deleted Menus"
    subtitle="View and manage deleted menus"
/>

<div class="row mb-3">
    <div class="col-12 text-end">
        <x-action-button
            :href="route('admin.menus.index')"
            label="Back to Menus"
            variant="secondary"
            icon="arrow_back"
        />
    </div>
</div>

<x-datatable
    title="Deleted Menus"
    :isEmpty="$menus->isEmpty()"
    emptyMessage="No deleted menus found"
    emptySubtitle="All deleted menus will appear here"
    emptyIcon="delete"
    :paginator="$menus"
    resourceType="menu"
    resourceTypePlural="menus"
    :bulkActions="[
        ['label' => 'Restore Selected', 'onclick' => 'restoreBulkSelected()', 'icon' => 'restore'],
        ['label' => 'Permanently Delete', 'onclick' => 'permanentlyDeleteBulkSelected()', 'icon' => 'delete_forever'],
    ]"
>
    <x-slot name="header">
        <x-sortable-th column="name" label="Name" />
        <x-sortable-th column="location" label="Location" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" />
        <x-sortable-th column="items_count" label="Items" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="is_active" label="Status" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="created_at" label="Created" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="deleted_at" label="Deleted" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
    </x-slot>

    @foreach($menus as $menu)
    <tr data-menu-id="{{ $menu->id }}">
        <td class="text-center">
            <div class="form-check">
                <input class="form-check-input project-checkbox" type="checkbox" value="{{ $menu->id }}">
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $menu->name }}</h6>
                    <p class="text-xs text-secondary mb-0">{{ $menu->slug }}</p>
                </div>
            </div>
        </td>
        <td>
            <p class="text-xs font-weight-bold mb-0">{{ ucfirst($menu->location) }}</p>
        </td>
        <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">{{ $menu->items_count }}</span>
        </td>
        <td class="align-middle text-center text-sm">
            @if($menu->is_active)
                <span class="badge badge-sm bg-gradient-success">Active</span>
            @else
                <span class="badge badge-sm bg-gradient-secondary">Inactive</span>
            @endif
        </td>
        <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">{{ $menu->created_at->format('d/m/Y') }}</span>
        </td>
        <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">{{ $menu->deleted_at->format('d/m/Y') }}</span>
        </td>
    </tr>
    @endforeach

</x-datatable>

<script>
function restoreBulkSelected() {
    const selectedIds = Array.from(document.querySelectorAll('.project-checkbox:checked'))
        .map(cb => cb.value);

    if (selectedIds.length === 0) {
        showToast('Please select at least one menu to restore.', 'warning');
        return;
    }

    const count = selectedIds.length;
    const message = count === 1
        ? 'Are you sure you want to restore this menu?'
        : `Are you sure you want to restore ${count} menus?`;

    if (!confirm(message)) {
        return;
    }

    fetch('{{ route("admin.menus.bulk-restore") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            menu_ids: selectedIds
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            sessionStorage.setItem('pendingToast', JSON.stringify({
                message: data.message,
                type: 'success'
            }));
            window.location.reload();
        } else {
            showToast(data.message || 'Failed to restore menus', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while restoring menus', 'error');
    });
}

function permanentlyDeleteBulkSelected() {
    const selectedIds = Array.from(document.querySelectorAll('.project-checkbox:checked'))
        .map(cb => cb.value);

    if (selectedIds.length === 0) {
        showToast('Please select at least one menu to permanently delete.', 'warning');
        return;
    }

    const count = selectedIds.length;
    const message = count === 1
        ? 'Are you sure you want to PERMANENTLY delete this menu? This action cannot be undone!'
        : `Are you sure you want to PERMANENTLY delete ${count} menus? This action cannot be undone!`;

    if (!confirm(message)) {
        return;
    }

    fetch('{{ route("admin.menus.bulk-permanent-delete") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            menu_ids: selectedIds
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            sessionStorage.setItem('pendingToast', JSON.stringify({
                message: data.message,
                type: 'success'
            }));
            window.location.reload();
        } else {
            showToast(data.message || 'Failed to permanently delete menus', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while permanently deleting menus', 'error');
    });
}
</script>
@endsection
