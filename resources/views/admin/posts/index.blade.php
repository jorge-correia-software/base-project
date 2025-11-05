@extends('layouts.admin')

@section('title', 'Posts')

@section('content')
<x-page-header
    icon="article"
    title="Posts"
    subtitle="Manage blog posts, articles, and news"
/>

<div class="row mb-3">
    <div class="col-12 text-end">
        @if($trashedCount > 0)
            <x-action-button
                :href="route('admin.posts.bin')"
                label="Bin"
                variant="danger"
                icon="delete"
                :badge="$trashedCount"
                class="me-2"
            />
        @endif
        <x-action-button
            :href="route('admin.posts.create')"
            label="Add New Post"
            variant="primary"
            iconText="+"
        />
    </div>
</div>

<x-datatable
    title="All Posts"
    :isEmpty="$posts->isEmpty()"
    emptyMessage="No posts found yet"
    emptySubtitle="Create your first blog post to get started"
    emptyIcon="article"
    :paginator="$posts"
    resourceType="post"
    resourceTypePlural="posts"
    :bulkActions="[
        ['label' => 'Bulk edit', 'onclick' => 'enableBulkEdit()'],
        ['label' => 'Delete Selected', 'onclick' => 'deleteBulkSelected(event)', 'icon' => 'delete'],
    ]"
>
    <x-slot name="header">
        <x-sortable-th column="title" label="Title" />
        <x-sortable-th column="category_id" label="Category" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" />
        <x-sortable-th column="author_id" label="Author" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" />
        <x-sortable-th column="status" label="Status" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="views" label="Views" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="created_at" label="Created" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="updated_at" label="Updated" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
    </x-slot>

    @foreach($posts as $post)
    <tr class="clickable-row"
        data-post-id="{{ $post->id }}"
        data-post-title="{{ $post->title }}"
        data-post-category-id="{{ $post->category_id }}"
        data-post-status="{{ $post->status }}">
        <td class="text-center">
            <div class="form-check">
                <input class="form-check-input project-checkbox" type="checkbox" value="{{ $post->id }}">
            </div>
        </td>
        <td class="post-title-cell">
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ Str::limit($post->title, 50) }}</h6>
                    <p class="text-xs text-secondary mb-0">{{ $post->slug }}</p>
                </div>
            </div>
        </td>
        <td class="post-category-cell">
            <p class="text-xs font-weight-bold mb-0">{{ $post->category?->name ?? 'Uncategorized' }}</p>
        </td>
        <td class="post-author-cell">
            <p class="text-xs font-weight-bold mb-0">{{ $post->author->name }}</p>
        </td>
        <td class="post-status-cell align-middle text-center text-sm">
            @if($post->status === 'published')
                <span class="badge badge-sm bg-gradient-success">Published</span>
            @elseif($post->status === 'scheduled')
                <span class="badge badge-sm bg-gradient-warning">Scheduled</span>
            @else
                <span class="badge badge-sm bg-gradient-secondary">Draft</span>
            @endif
        </td>
        <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">{{ $post->views }}</span>
        </td>
        <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">{{ $post->created_at->format('d/m/Y') }}</span>
        </td>
        <td class="align-middle text-center">
            <span class="text-secondary text-xs font-weight-bold">{{ $post->updated_at->format('d/m/Y') }}</span>
        </td>
    </tr>
    @endforeach

</x-datatable>

<script>
// Bulk edit for posts
function enableBulkEdit() {
    if (bulkEditMode) return;

    if ($('.project-checkbox:checked').length === 0) {
        showToast('Please select at least one post to edit', 'error');
        return;
    }

    bulkEditMode = true;

    $('.project-checkbox:checked').each(function() {
        const $row = $(this).closest('tr');
        const postId = $row.data('post-id');

        originalRowData[postId] = {
            title: $row.data('post-title'),
            categoryId: $row.data('post-category-id'),
            status: $row.data('post-status')
        };

        convertRowToEditMode($row);
    });

    showBulkEditControls();
}

function convertRowToEditMode($row) {
    const postId = $row.data('post-id');
    const data = originalRowData[postId];

    // Convert title cell to input
    const $titleCell = $row.find('.post-title-cell');
    $titleCell.html(`
        <input type="text"
               class="form-control bulk-edit-title"
               style="height: 24px; font-size: 0.75rem; padding: 2px 6px;"
               value="${data.title}"
               data-post-id="${postId}">
    `);

    // Convert status cell to dropdown
    const $statusCell = $row.find('.post-status-cell');
    $statusCell.html(`
        <select class="form-control bulk-edit-status"
                style="height: 24px; font-size: 0.75rem; padding: 2px 6px;"
                data-post-id="${postId}">
            <option value="draft" ${data.status === 'draft' ? 'selected' : ''}>Draft</option>
            <option value="scheduled" ${data.status === 'scheduled' ? 'selected' : ''}>Scheduled</option>
            <option value="published" ${data.status === 'published' ? 'selected' : ''}>Published</option>
        </select>
    `);
}

function saveBulkEdits() {
    const updates = [];

    $('.project-checkbox:checked').each(function() {
        const $row = $(this).closest('tr');
        const postId = $row.data('post-id');

        updates.push({
            id: postId,
            title: $row.find('.bulk-edit-title').val(),
            status: $row.find('.bulk-edit-status').val()
        });
    });

    $.ajax({
        url: '{{ route("admin.posts.bulk-update") }}',
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            posts: updates
        },
        success: function(response) {
            sessionStorage.setItem('pendingToast', JSON.stringify({
                message: updates.length + ' post(s) updated successfully!',
                type: 'success'
            }));
            window.location.reload();
        },
        error: function(xhr) {
            showToast('Error updating posts. Please try again.', 'error');
            console.error(xhr.responseText);
        }
    });
}
</script>
@endsection
