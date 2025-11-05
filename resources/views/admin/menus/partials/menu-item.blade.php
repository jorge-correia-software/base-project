<li class="dd-item" data-id="{{ $item->id }}">
    <div class="menu-item-card">
        <div class="menu-item-header">
            <div class="menu-item-drag-handle">
                <i class="material-symbols-rounded">drag_indicator</i>
                <span class="menu-item-title">{{ $item->title }}</span>
                <span class="menu-item-type">
                    @if($item->page_id)
                        Page
                    @else
                        Custom Link
                    @endif
                </span>
            </div>
            <div class="menu-item-controls">
                <button type="button" class="btn-edit-item" title="Edit">
                    <i class="material-symbols-rounded">edit</i>
                </button>
                <button type="button" class="btn-delete-item" title="Delete">
                    <i class="material-symbols-rounded">delete</i>
                </button>
            </div>
        </div>
        <div class="menu-item-edit-form">
            <div class="form-group">
                <label>Navigation Label</label>
                <input type="text" class="form-control item-title" value="{{ $item->title }}">
            </div>
            @if(!$item->page_id)
            <div class="form-group">
                <label>URL</label>
                <input type="text" class="form-control item-url" value="{{ $item->url ?? '' }}">
            </div>
            @endif
            <div class="form-group">
                <label>Link Target</label>
                <select class="form-control item-target">
                    <option value="_self" {{ $item->target === '_self' ? 'selected' : '' }}>Same window</option>
                    <option value="_blank" {{ $item->target === '_blank' ? 'selected' : '' }}>New window</option>
                </select>
            </div>
            <div class="form-group">
                <label>CSS Classes (optional)</label>
                <input type="text" class="form-control item-css-class" value="{{ $item->css_class ?? '' }}">
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary btn-sm btn-cancel-edit">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm btn-save-item">Save</button>
            </div>
        </div>
    </div>

    @if($item->children && $item->children->count() > 0)
        <ol class="dd-list">
            @foreach($item->children as $child)
                @include('admin.menus.partials.menu-item', ['item' => $child])
            @endforeach
        </ol>
    @endif
</li>
