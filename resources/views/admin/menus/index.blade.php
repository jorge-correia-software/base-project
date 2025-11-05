@extends('layouts.admin')

@section('title', 'Menus')

@section('content')
<x-page-header
    icon="menu"
    title="Menus"
    subtitle="Manage navigation menus and menu items"
/>

<div class="row mb-3">
    <div class="col-12 text-end">
        @if($trashedCount > 0)
            <x-action-button
                :href="route('admin.menus.bin')"
                label="Bin"
                variant="danger"
                icon="delete"
                :badge="$trashedCount"
                class="me-2"
            />
        @endif
        <x-action-button
            :href="route('admin.menus.create')"
            label="Add New Menu"
            variant="primary"
            iconText="+"
        />
    </div>
</div>

<x-datatable
    title="All Menus"
    :isEmpty="$menus->isEmpty()"
    emptyMessage="No menus found yet"
    emptySubtitle="Create your first navigation menu to get started"
    emptyIcon="menu"
    :paginator="$menus"
    resourceType="menu"
    resourceTypePlural="menus"
    :bulkActions="[
        ['label' => 'Bulk edit', 'onclick' => 'enableBulkEdit()'],
        ['label' => 'Delete Selected', 'onclick' => 'deleteBulkSelected(event)', 'icon' => 'delete'],
    ]"
>
    <x-slot name="header">
        <x-sortable-th column="name" label="Name" />
        <x-sortable-th column="location" label="Location" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" />
        <x-sortable-th column="items_count" label="Items" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="is_active" label="Status" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="created_at" label="Created" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="updated_at" label="Updated" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
    </x-slot>

    @foreach($menus as $menu)
    <tr class="clickable-row"
        data-menu-id="{{ $menu->id }}"
        data-menu-name="{{ $menu->name }}"
        data-menu-location="{{ $menu->location }}">
        <td class="text-center">
            <div class="form-check">
                <input class="form-check-input project-checkbox" type="checkbox" value="{{ $menu->id }}">
            </div>
        </td>
        <td class="menu-name-cell">
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ $menu->name }}</h6>
                    <p class="text-xs text-secondary mb-0">{{ $menu->slug }}</p>
                </div>
            </div>
        </td>
        <td class="menu-location-cell">
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
            <span class="text-secondary text-xs font-weight-bold">{{ $menu->updated_at->format('d/m/Y') }}</span>
        </td>
    </tr>
    @endforeach

</x-datatable>

<script>
// Bulk edit for menus
function enableBulkEdit() {
    if (bulkEditMode) return;

    if ($('.project-checkbox:checked').length === 0) {
        showToast('Please select at least one menu to edit', 'error');
        return;
    }

    bulkEditMode = true;

    $('.project-checkbox:checked').each(function() {
        const $row = $(this).closest('tr');
        const menuId = $row.data('menu-id');

        originalRowData[menuId] = {
            name: $row.data('menu-name'),
            location: $row.data('menu-location')
        };

        convertRowToEditMode($row);
    });

    showBulkEditControls();
}

function convertRowToEditMode($row) {
    const menuId = $row.data('menu-id');
    const data = originalRowData[menuId];

    // Convert name cell to input
    const $nameCell = $row.find('.menu-name-cell');
    $nameCell.html(`
        <input type="text"
               class="form-control bulk-edit-name"
               style="height: 24px; font-size: 0.75rem; padding: 2px 6px;"
               value="${data.name}"
               data-menu-id="${menuId}">
    `);

    // Convert location cell to dropdown
    const $locationCell = $row.find('.menu-location-cell');
    $locationCell.html(`
        <select class="form-control bulk-edit-location"
                style="height: 24px; font-size: 0.75rem; padding: 2px 6px;"
                data-menu-id="${menuId}">
            <option value="header" ${data.location === 'header' ? 'selected' : ''}>Header</option>
            <option value="footer" ${data.location === 'footer' ? 'selected' : ''}>Footer</option>
            <option value="sidebar" ${data.location === 'sidebar' ? 'selected' : ''}>Sidebar</option>
        </select>
    `);
}

function saveBulkEdits() {
    const updates = [];

    $('.project-checkbox:checked').each(function() {
        const $row = $(this).closest('tr');
        const menuId = $row.data('menu-id');

        updates.push({
            id: menuId,
            name: $row.find('.bulk-edit-name').val(),
            location: $row.find('.bulk-edit-location').val()
        });
    });

    $.ajax({
        url: '{{ route("admin.menus.bulk-update") }}',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            menus: updates
        },
        success: function(response) {
            sessionStorage.setItem('pendingToast', JSON.stringify({
                message: updates.length + ' menu(s) updated successfully!',
                type: 'success'
            }));
            window.location.reload();
        },
        error: function(xhr) {
            showToast('Error updating menus. Please try again.', 'error');
            console.error(xhr.responseText);
        }
    });
}
</script>
@endsection
