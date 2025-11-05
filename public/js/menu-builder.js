/**
 * Menu Builder JavaScript
 * WordPress-style menu builder with drag-drop functionality
 */

(function($) {
    'use strict';

    const MenuBuilder = {
        menuId: null,
        nestable: null,

        /**
         * Initialize the menu builder
         */
        init: function(menuId) {
            this.menuId = menuId;
            this.initNestable();
            this.bindEvents();
        },

        /**
         * Initialize Nestable drag-drop
         */
        initNestable: function() {
            const $nestable = $('.dd');

            if ($nestable.length === 0) {
                return;
            }

            this.nestable = $nestable.nestable({
                maxDepth: 3,
                handleClass: 'menu-item-drag-handle',
                callback: (l, e) => {
                    // Auto-save structure after drag
                    this.autoSaveStructure();
                }
            });

            // Expand all items by default
            $nestable.nestable('expandAll');
        },

        /**
         * Bind event handlers
         */
        bindEvents: function() {
            // Add pages to menu
            $('#addPagesToMenu').on('click', (e) => {
                e.preventDefault();
                this.addPagesToMenu();
            });

            // Add custom link
            $('#addCustomLink').on('click', (e) => {
                e.preventDefault();
                this.addCustomLink();
            });

            // Edit menu item
            $(document).on('click', '.btn-edit-item', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const $item = $(e.currentTarget).closest('.dd-item');
                this.toggleEditForm($item);
            });

            // Save menu item edit
            $(document).on('click', '.btn-save-item', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const $item = $(e.currentTarget).closest('.dd-item');
                this.saveMenuItem($item);
            });

            // Cancel menu item edit
            $(document).on('click', '.btn-cancel-edit', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const $item = $(e.currentTarget).closest('.dd-item');
                this.toggleEditForm($item);
            });

            // Delete menu item
            $(document).on('click', '.btn-delete-item', (e) => {
                e.preventDefault();
                e.stopPropagation();
                const $item = $(e.currentTarget).closest('.dd-item');
                this.deleteMenuItem($item);
            });

            // Manual save structure button
            $('#saveMenuStructure').on('click', (e) => {
                e.preventDefault();
                this.saveMenuStructure();
            });

            // Select all pages
            $('#selectAllPages').on('change', function() {
                $('.page-checkbox').prop('checked', $(this).is(':checked'));
            });
        },

        /**
         * Add selected pages to menu
         */
        addPagesToMenu: function() {
            const $checkedBoxes = $('.page-checkbox:checked');

            if ($checkedBoxes.length === 0) {
                this.showToast('Please select at least one page', 'warning');
                return;
            }

            const pageIds = [];
            $checkedBoxes.each(function() {
                pageIds.push($(this).val());
            });

            this.showLoading();

            $.ajax({
                url: `/admin/menus/${this.menuId}/add-pages`,
                method: 'POST',
                data: {
                    page_ids: pageIds,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    this.hideLoading();

                    if (response.success) {
                        // Add new items to the menu structure
                        response.items.forEach(item => {
                            this.appendMenuItem(item);
                        });

                        // Uncheck all checkboxes
                        $checkedBoxes.prop('checked', false);
                        $('#selectAllPages').prop('checked', false);

                        this.showToast(response.message || 'Pages added to menu successfully', 'success');

                        // Reinitialize nestable
                        this.nestable.nestable('destroy');
                        this.initNestable();
                    }
                },
                error: (xhr) => {
                    this.hideLoading();
                    const message = xhr.responseJSON?.message || 'Failed to add pages to menu';
                    this.showToast(message, 'error');
                }
            });
        },

        /**
         * Add custom link to menu
         */
        addCustomLink: function() {
            const url = $('#customLinkUrl').val().trim();
            const linkText = $('#customLinkText').val().trim();
            const target = $('#customLinkTarget').val();

            if (!url || !linkText) {
                this.showToast('Please fill in all required fields', 'warning');
                return;
            }

            this.showLoading();

            $.ajax({
                url: `/admin/menus/${this.menuId}/items`,
                method: 'POST',
                data: {
                    title: linkText,
                    url: url,
                    target: target,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    this.hideLoading();

                    if (response.success) {
                        this.appendMenuItem(response.item);

                        // Clear form
                        $('#customLinkUrl').val('');
                        $('#customLinkText').val('');
                        $('#customLinkTarget').val('_self');

                        this.showToast(response.message || 'Custom link added successfully', 'success');

                        // Reinitialize nestable
                        this.nestable.nestable('destroy');
                        this.initNestable();
                    }
                },
                error: (xhr) => {
                    this.hideLoading();
                    const message = xhr.responseJSON?.message || 'Failed to add custom link';
                    this.showToast(message, 'error');
                }
            });
        },

        /**
         * Append menu item to the structure
         */
        appendMenuItem: function(item) {
            const $list = $('.dd-list').first();
            const itemHtml = this.createMenuItemHtml(item);

            // Remove empty state if exists
            $('.menu-structure-empty').remove();

            $list.append(itemHtml);
        },

        /**
         * Create HTML for menu item
         */
        createMenuItemHtml: function(item) {
            const itemType = item.page_id ? 'Page' : 'Custom Link';

            return `
                <li class="dd-item" data-id="${item.id}">
                    <div class="menu-item-card">
                        <div class="menu-item-header">
                            <div class="menu-item-drag-handle">
                                <i class="material-symbols-rounded">drag_indicator</i>
                                <span class="menu-item-title">${this.escapeHtml(item.title)}</span>
                                <span class="menu-item-type">${itemType}</span>
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
                                <input type="text" class="form-control item-title" value="${this.escapeHtml(item.title)}">
                            </div>
                            ${!item.page_id ? `
                            <div class="form-group">
                                <label>URL</label>
                                <input type="text" class="form-control item-url" value="${this.escapeHtml(item.url || '')}">
                            </div>
                            ` : ''}
                            <div class="form-group">
                                <label>Link Target</label>
                                <select class="form-control item-target">
                                    <option value="_self" ${item.target === '_self' ? 'selected' : ''}>Same window</option>
                                    <option value="_blank" ${item.target === '_blank' ? 'selected' : ''}>New window</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>CSS Classes (optional)</label>
                                <input type="text" class="form-control item-css-class" value="${this.escapeHtml(item.css_class || '')}">
                            </div>
                            <div class="form-actions">
                                <button type="button" class="btn btn-secondary btn-sm btn-cancel-edit">Cancel</button>
                                <button type="button" class="btn btn-primary btn-sm btn-save-item">Save</button>
                            </div>
                        </div>
                    </div>
                </li>
            `;
        },

        /**
         * Toggle edit form for menu item
         */
        toggleEditForm: function($item) {
            const $form = $item.find('.menu-item-edit-form').first();
            $form.toggleClass('active');
        },

        /**
         * Save menu item changes
         */
        saveMenuItem: function($item) {
            const itemId = $item.data('id');
            const title = $item.find('.item-title').val();
            const url = $item.find('.item-url').val();
            const target = $item.find('.item-target').val();
            const cssClass = $item.find('.item-css-class').val();

            if (!title) {
                this.showToast('Title is required', 'warning');
                return;
            }

            this.showLoading();

            $.ajax({
                url: `/admin/menus/items/${itemId}`,
                method: 'PUT',
                data: {
                    title: title,
                    url: url,
                    target: target,
                    css_class: cssClass,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    this.hideLoading();

                    if (response.success) {
                        // Update item title in header
                        $item.find('.menu-item-title').first().text(title);

                        // Close edit form
                        this.toggleEditForm($item);

                        this.showToast(response.message || 'Menu item updated successfully', 'success');
                    }
                },
                error: (xhr) => {
                    this.hideLoading();
                    const message = xhr.responseJSON?.message || 'Failed to update menu item';
                    this.showToast(message, 'error');
                }
            });
        },

        /**
         * Delete menu item
         */
        deleteMenuItem: function($item) {
            const itemId = $item.data('id');
            const itemTitle = $item.find('.menu-item-title').first().text();

            if (!confirm(`Are you sure you want to delete "${itemTitle}"?`)) {
                return;
            }

            this.showLoading();

            $.ajax({
                url: `/admin/menus/items/${itemId}`,
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    this.hideLoading();

                    if (response.success) {
                        $item.fadeOut(300, function() {
                            $(this).remove();

                            // Show empty state if no items left
                            if ($('.dd-item').length === 0) {
                                $('.dd-list').first().html(`
                                    <div class="menu-structure-empty">
                                        <i class="material-symbols-rounded">menu</i>
                                        <p>No menu items yet. Add pages or custom links from the sidebar.</p>
                                    </div>
                                `);
                            }
                        });

                        this.showToast(response.message || 'Menu item deleted successfully', 'success');
                    }
                },
                error: (xhr) => {
                    this.hideLoading();
                    const message = xhr.responseJSON?.message || 'Failed to delete menu item';
                    this.showToast(message, 'error');
                }
            });
        },

        /**
         * Auto-save menu structure after drag
         */
        autoSaveStructure: function() {
            // Debounce to avoid too many requests
            clearTimeout(this.saveTimeout);
            this.saveTimeout = setTimeout(() => {
                this.saveMenuStructure(true);
            }, 1000);
        },

        /**
         * Save menu structure (order and nesting)
         */
        saveMenuStructure: function(silent = false) {
            const structure = this.nestable.nestable('serialize');
            const items = this.flattenStructure(structure);

            if (!silent) {
                this.showLoading();
            }

            $.ajax({
                url: `/admin/menus/${this.menuId}/structure`,
                method: 'POST',
                data: {
                    items: JSON.stringify(items),
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: (response) => {
                    if (!silent) {
                        this.hideLoading();
                        this.showToast(response.message || 'Menu structure saved successfully', 'success');
                    }
                },
                error: (xhr) => {
                    if (!silent) {
                        this.hideLoading();
                        const message = xhr.responseJSON?.message || 'Failed to save menu structure';
                        this.showToast(message, 'error');
                    }
                }
            });
        },

        /**
         * Flatten nested structure for saving
         */
        flattenStructure: function(items, parentId = null) {
            let result = [];
            let order = 0;

            items.forEach(item => {
                result.push({
                    id: item.id,
                    parent_id: parentId,
                    order: order++
                });

                if (item.children && item.children.length > 0) {
                    result = result.concat(this.flattenStructure(item.children, item.id));
                }
            });

            return result;
        },

        /**
         * Show loading overlay
         */
        showLoading: function() {
            $('.menu-structure-container').addClass('menu-builder-loading');
        },

        /**
         * Hide loading overlay
         */
        hideLoading: function() {
            $('.menu-structure-container').removeClass('menu-builder-loading');
        },

        /**
         * Show toast notification
         */
        showToast: function(message, type = 'info') {
            // Using the existing toast system from the theme
            if (typeof showNotification === 'function') {
                showNotification(message, type);
            } else {
                // Fallback to alert if toast not available
                alert(message);
            }
        },

        /**
         * Escape HTML to prevent XSS
         */
        escapeHtml: function(text) {
            if (!text) return '';
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.toString().replace(/[&<>"']/g, m => map[m]);
        }
    };

    // Expose to global scope
    window.MenuBuilder = MenuBuilder;

})(jQuery);
