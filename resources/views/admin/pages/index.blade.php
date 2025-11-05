@extends('layouts.admin')

@section('title', 'Pages')
@section('breadcrumb', 'Pages')
@section('page-title', 'All Pages')

@section('content')
<x-page-header
    icon="description"
    title="Pages"
    subtitle="Manage website pages and content"
/>

<div class="row mb-3">
    <div class="col-12 text-end">
        @if($trashedCount > 0)
            <x-action-button
                :href="route('admin.pages.bin')"
                label="Bin"
                variant="danger"
                icon="delete"
                :badge="$trashedCount"
                class="me-2"
            />
        @endif
        <x-action-button
            :href="route('admin.pages.create')"
            label="Add New Page"
            variant="primary"
            iconText="+"
        />
    </div>
</div>

<x-datatable
    title="All Pages"
    :isEmpty="$pages->isEmpty()"
    emptyMessage="No pages found yet"
    emptySubtitle="Create your first page to get started"
    emptyIcon="description"
    :paginator="$pages"
    resourceType="page"
    resourceTypePlural="pages"
    :bulkActions="[
        ['label' => 'Bulk edit', 'onclick' => 'enableBulkEdit()'],
        ['label' => 'Delete Selected', 'onclick' => 'deleteBulkSelected(event)', 'icon' => 'delete'],
    ]"
>
    <x-slot name="header">
        <x-sortable-th column="title" label="Title" />
        <x-sortable-th column="author_id" label="Author" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" />
        <x-sortable-th column="status" label="Status" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="published_at" label="Published" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="created_at" label="Created" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="updated_at" label="Updated" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
    </x-slot>

    @foreach($pages as $page)
    <tr class="clickable-row"
        data-page-id="{{ $page->id }}"
        data-page-title="{{ $page->title }}"
        data-page-status="{{ $page->status }}">
        <td class="text-center">
            <div class="form-check">
                <input class="form-check-input project-checkbox" type="checkbox" value="{{ $page->id }}">
            </div>
        </td>
        <td class="page-title-cell">
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ Str::limit($page->title, 50) }}</h6>
                    <p class="text-xs text-secondary mb-0">{{ $page->slug }}</p>
                </div>
            </div>
        </td>
        <td class="page-author-cell">
            <p class="text-xs font-weight-bold mb-0">{{ $page->author->name }}</p>
        </td>
        <td class="page-status-cell align-middle text-center text-sm">
            @if($page->status === 'published')
                <span class="badge badge-sm bg-gradient-success">Published</span>
            @else
                <span class="badge badge-sm bg-gradient-secondary">Draft</span>
            @endif
        </td>
        <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">{{ $page->published_at ? $page->published_at->format('d/m/Y') : 'Not published' }}</span>
        </td>
        <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">{{ $page->created_at->format('d/m/Y') }}</span>
        </td>
        <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">{{ $page->updated_at->format('d/m/Y') }}</span>
        </td>
    </tr>
    @endforeach

</x-datatable>

<script>
// Bulk edit for pages
function enableBulkEdit() {
    if (bulkEditMode) return;

    if ($('.project-checkbox:checked').length === 0) {
        showToast('Please select at least one page to edit', 'error');
        return;
    }

    bulkEditMode = true;

    $('.project-checkbox:checked').each(function() {
        const $row = $(this).closest('tr');
        const pageId = $row.data('page-id');

        originalRowData[pageId] = {
            title: $row.data('page-title'),
            status: $row.data('page-status')
        };

        convertRowToEditMode($row);
    });

    showBulkEditControls();
}

function convertRowToEditMode($row) {
    const pageId = $row.data('page-id');
    const data = originalRowData[pageId];

    // Convert title cell to input
    const $titleCell = $row.find('.page-title-cell');
    $titleCell.html(`
        <input type="text"
               class="form-control bulk-edit-title"
               style="height: 24px; font-size: 0.75rem; padding: 2px 6px;"
               value="${data.title}"
               data-page-id="${pageId}">
    `);

    // Convert status cell to dropdown
    const $statusCell = $row.find('.page-status-cell');
    $statusCell.html(`
        <select class="form-control bulk-edit-status"
                style="height: 24px; font-size: 0.75rem; padding: 2px 6px;"
                data-page-id="${pageId}">
            <option value="draft" ${data.status === 'draft' ? 'selected' : ''}>Draft</option>
            <option value="published" ${data.status === 'published' ? 'selected' : ''}>Published</option>
        </select>
    `);
}

function saveBulkEdits() {
    const updates = [];

    $('.project-checkbox:checked').each(function() {
        const $row = $(this).closest('tr');
        const pageId = $row.data('page-id');

        updates.push({
            id: pageId,
            title: $row.find('.bulk-edit-title').val(),
            status: $row.find('.bulk-edit-status').val()
        });
    });

    $.ajax({
        url: '{{ route("admin.pages.bulk-update") }}',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            pages: updates
        },
        success: function(response) {
            sessionStorage.setItem('pendingToast', JSON.stringify({
                message: updates.length + ' page(s) updated successfully!',
                type: 'success'
            }));
            window.location.reload();
        },
        error: function(xhr) {
            showToast('Error updating pages. Please try again.', 'error');
            console.error(xhr.responseText);
        }
    });
}
</script>
@endsection
