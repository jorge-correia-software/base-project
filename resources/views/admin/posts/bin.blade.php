@extends('layouts.admin')

@section('title', 'Bin')

@section('content')
<x-page-header
    icon="delete"
    title="Deleted Posts"
    subtitle="View and manage deleted posts"
/>

<div class="row mb-3">
    <div class="col-12 text-end">
        <x-action-button
            :href="route('admin.posts.index')"
            label="Back to Posts"
            variant="secondary"
            icon="arrow_back"
        />
    </div>
</div>

<x-datatable
    title="Deleted Posts"
    :isEmpty="$posts->isEmpty()"
    emptyMessage="No deleted posts found"
    emptySubtitle="All deleted posts will appear here"
    emptyIcon="delete"
    :paginator="$posts"
    resourceType="post"
    resourceTypePlural="posts"
    :bulkActions="[
        ['label' => 'Restore Selected', 'onclick' => 'restoreBulkSelected()', 'icon' => 'restore'],
        ['label' => 'Permanently Delete', 'onclick' => 'permanentlyDeleteBulkSelected()', 'icon' => 'delete_forever'],
    ]"
>
    <x-slot name="header">
        <x-sortable-th column="title" label="Title" />
        <x-sortable-th column="category_id" label="Category" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" />
        <x-sortable-th column="author_id" label="Author" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" />
        <x-sortable-th column="status" label="Status" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="views" label="Views" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="created_at" label="Created" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
        <x-sortable-th column="deleted_at" label="Deleted" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" />
    </x-slot>

    @foreach($posts as $post)
    <tr data-post-id="{{ $post->id }}">
        <td class="text-center">
            <div class="form-check">
                <input class="form-check-input project-checkbox" type="checkbox" value="{{ $post->id }}">
            </div>
        </td>
        <td>
            <div class="d-flex px-2 py-1">
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">{{ Str::limit($post->title, 50) }}</h6>
                    <p class="text-xs text-secondary mb-0">{{ $post->slug }}</p>
                </div>
            </div>
        </td>
        <td>
            <p class="text-xs font-weight-bold mb-0">{{ $post->category?->name ?? 'Uncategorized' }}</p>
        </td>
        <td>
            <p class="text-xs font-weight-bold mb-0">{{ $post->author->name }}</p>
        </td>
        <td class="align-middle text-center text-sm">
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
            <span class="text-secondary text-xs font-weight-bold">{{ $post->deleted_at->format('d/m/Y') }}</span>
        </td>
    </tr>
    @endforeach

</x-datatable>

<script>
function restoreBulkSelected() {
    const selectedIds = Array.from(document.querySelectorAll('.project-checkbox:checked'))
        .map(cb => cb.value);

    if (selectedIds.length === 0) {
        showToast('Please select at least one post to restore.', 'warning');
        return;
    }

    const count = selectedIds.length;
    const message = count === 1
        ? 'Are you sure you want to restore this post?'
        : `Are you sure you want to restore ${count} posts?`;

    if (!confirm(message)) {
        return;
    }

    fetch('{{ route("admin.posts.bulk-restore") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            post_ids: selectedIds
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
            showToast(data.message || 'Failed to restore posts', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while restoring posts', 'error');
    });
}

function permanentlyDeleteBulkSelected() {
    const selectedIds = Array.from(document.querySelectorAll('.project-checkbox:checked'))
        .map(cb => cb.value);

    if (selectedIds.length === 0) {
        showToast('Please select at least one post to permanently delete.', 'warning');
        return;
    }

    const count = selectedIds.length;
    const message = count === 1
        ? 'Are you sure you want to PERMANENTLY delete this post? This action cannot be undone!'
        : `Are you sure you want to PERMANENTLY delete ${count} posts? This action cannot be undone!`;

    if (!confirm(message)) {
        return;
    }

    fetch('{{ route("admin.posts.bulk-permanent-delete") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            post_ids: selectedIds
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
            showToast(data.message || 'Failed to permanently delete posts', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('An error occurred while permanently deleting posts', 'error');
    });
}
</script>
@endsection
