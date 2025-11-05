/**
 * BASE CMS - Admin Global JavaScript
 *
 * This file contains all global JavaScript functionality for the admin interface:
 * - Datatable checkbox select-all logic with selection toolbar
 * - Bulk action functions (delete, restore, permanent delete)
 * - Toast notification system
 * - Clickable table rows
 * - Bulk edit UI helpers
 */

// ============================================
// DATATABLE CHECKBOX & SELECTION TOOLBAR
// ============================================

$(document).ready(function() {
    // Store the original header contents for each column
    let originalHeaders = [];

    // Initialize Select All checkbox behavior for all datatables
    if ($('#selectAll').length > 0) {
        // Capture the original headers on page load - INCLUDING the checkbox column
        $('#headerRow th').each(function(index) {
            // Store the original content with proper attributes
            const $th = $(this);
            originalHeaders.push({
                html: $th.html(),
                classes: $th.attr('class') || '',
                style: $th.attr('style') || '',
                width: $th.css('width') // Store computed width
            });
        });

        // Function to attach Select All event handler
        function attachSelectAllHandler() {
            $('#selectAll').off('change').on('change', function() {
                const isChecked = $(this).prop('checked');
                $('.project-checkbox').prop('checked', isChecked);
                // Remove indeterminate state when clicking select all
                $(this).prop('indeterminate', false);
                updateSelectionToolbar();
            });
        }

        // Attach the handler initially
        attachSelectAllHandler();

        // Update header checkbox state and selection toolbar
        function updateSelectAllState() {
            const totalCheckboxes = $('.project-checkbox').length;
            const checkedCheckboxes = $('.project-checkbox:checked').length;

            if (checkedCheckboxes === 0) {
                // None selected - uncheck and remove indeterminate
                $('#selectAll').prop('checked', false).prop('indeterminate', false);
            } else if (checkedCheckboxes === totalCheckboxes) {
                // All selected - check and remove indeterminate
                $('#selectAll').prop('checked', true).prop('indeterminate', false);
            } else {
                // Some selected - set indeterminate (show dash)
                $('#selectAll').prop('checked', false).prop('indeterminate', true);
            }

            updateSelectionToolbar();
        }

        // Update selection toolbar visibility and counter
        function updateSelectionToolbar() {
            const checkedCheckboxes = $('.project-checkbox:checked').length;
            const $allHeaders = $('#headerRow th');

            if (checkedCheckboxes > 0) {
                // Replace content but maintain structure AND widths
                $allHeaders.each(function(index) {
                    const $th = $(this);
                    const original = originalHeaders[index];

                    // Maintain the original width
                    if (original && original.width) {
                        $th.css('width', original.width);
                    }

                    // Keep the checkbox column unchanged (first column)
                    if (index === 0 && $th.find('#selectAll').length > 0) {
                        // This is the checkbox column - leave it as is
                        return;
                    }

                    // Determine which actual data column this is (accounting for checkbox column)
                    const hasCheckbox = $('#headerRow th:first').find('#selectAll').length > 0;
                    const dataColumnIndex = hasCheckbox ? index - 1 : index;
                    const totalDataColumns = hasCheckbox ? $allHeaders.length - 1 : $allHeaders.length;

                    if (dataColumnIndex === 0) {
                        // First data column gets the bulk actions
                        // Get bulk actions from data attribute
                        const bulkActions = JSON.parse($('#dataTable').attr('data-bulk-actions') || '[]');

                        // Separate "Bulk edit" from dropdown actions
                        const bulkEditAction = bulkActions.find(action => action.onclick === 'enableBulkEdit()');
                        const dropdownActions = bulkActions.filter(action => action.onclick !== 'enableBulkEdit()');

                        // Build bulk edit button if it exists
                        const bulkEditButton = bulkEditAction
                            ? `<button class="btn btn-sm btn-action-toolbar text-xxs m-0" type="button" onclick="${bulkEditAction.onclick}">
                                   ${bulkEditAction.label}
                               </button>`
                            : '';

                        // Build dropdown menu items
                        const dropdownItems = dropdownActions.map(action => {
                            const icon = action.icon ? `<i class="material-symbols-rounded" style="font-size: 1rem; vertical-align: middle; margin-right: 8px; transform: translateY(-1px);">${action.icon}</i>` : '';
                            return `<li class="mb-2"><a class="dropdown-item border-radius-md" href="#" onclick="event.preventDefault(); ${action.onclick.replace('()', '(event)')}">${icon}${action.label}</a></li>`;
                        }).join('');

                        $th.html(`
                            <div class="d-flex align-items-center gap-2">
                                <!-- Selection Counter Dropdown -->
                                <div class="dropdown">
                                    <a href="#" class="selection-counter-link d-flex align-items-center gap-1 text-decoration-none text-xxs" id="selectionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span id="selectionCount" class="text-dark">${checkedCheckboxes} selected</span>
                                        <span class="material-symbols-rounded" style="font-size: 16px;">expand_more</span>
                                    </a>
                                    <ul class="dropdown-menu px-2 py-3" aria-labelledby="selectionDropdown">
                                        <li class="mb-2"><a class="dropdown-item border-radius-md" href="#" id="selectAllOnPage">Select all on page</a></li>
                                        <li><a class="dropdown-item border-radius-md" href="#" id="unselectAll">Unselect all</a></li>
                                    </ul>
                                </div>

                                ${bulkEditButton}

                                <div class="dropdown">
                                    <button class="btn btn-sm btn-action-toolbar text-xxs m-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="material-symbols-rounded" style="font-size: 16px;">more_horiz</span>
                                    </button>
                                    <ul class="dropdown-menu px-2 py-3">
                                        ${dropdownItems}
                                    </ul>
                                </div>
                            </div>
                        `);
                        // Remove text alignment classes for bulk actions
                        $th.removeClass('text-uppercase text-secondary text-xxs font-weight-bolder opacity-7');
                    } else if (dataColumnIndex === totalDataColumns - 1) {
                        // Last data column gets the toggle
                        $th.html(`
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <input class="toggle-selection" type="checkbox" id="showSelectedToggle" style="cursor: pointer;">
                                <label class="mb-0 text-dark text-xxs" for="showSelectedToggle" style="cursor: pointer;">Show all selected</label>
                            </div>
                        `);
                        // Remove text alignment classes for toggle
                        $th.removeClass('text-uppercase text-secondary text-xxs font-weight-bolder opacity-7');
                    } else {
                        // Middle columns are empty but maintain the <th> structure
                        $th.html('');
                        // Remove text classes but keep the th element
                        $th.removeClass('text-uppercase text-secondary text-xxs font-weight-bolder opacity-7');
                    }
                });

                // Re-attach event handlers for dynamic content
                attachBulkActionsHandlers();
            } else {
                // Save the current state of the Select All checkbox before restoring
                const selectAllChecked = $('#selectAll').prop('checked');
                const selectAllIndeterminate = $('#selectAll').prop('indeterminate');

                // Restore original headers with their original attributes
                $allHeaders.each(function(index) {
                    const $th = $(this);
                    const original = originalHeaders[index];
                    if (original) {
                        $th.html(original.html);
                        $th.attr('class', original.classes);
                        $th.attr('style', original.style);
                        // Explicitly restore width
                        if (original.width) {
                            $th.css('width', original.width);
                        }
                    }
                });

                // Restore the Select All checkbox state after HTML restoration
                $('#selectAll').prop('checked', selectAllChecked);
                $('#selectAll').prop('indeterminate', selectAllIndeterminate);

                // Re-attach the Select All event handler since we replaced the HTML
                attachSelectAllHandler();

                // Reset filter toggle
                $('#showSelectedToggle').prop('checked', false);
                $('.table tbody tr').show();
            }
        }

        // Attach event handlers for bulk actions elements
        function attachBulkActionsHandlers() {
            // Select all on page
            $('#selectAllOnPage').off('click').on('click', function(e) {
                e.preventDefault();
                $('.project-checkbox').prop('checked', true);
                $('#selectAll').prop('checked', true).prop('indeterminate', false);
                updateSelectionToolbar();
            });

            // Unselect all
            $('#unselectAll').off('click').on('click', function(e) {
                e.preventDefault();
                $('.project-checkbox').prop('checked', false);
                $('#selectAll').prop('checked', false).prop('indeterminate', false);
                updateSelectionToolbar();
            });

            // Show only selected rows toggle
            $('#showSelectedToggle').off('change').on('change', function() {
                if ($(this).is(':checked')) {

                    // Add class to table for filtered view styling
                    $('.table').addClass('filtered-view');
                    // Hide unchecked rows
                    $('.table tbody tr').each(function() {
                        const checkbox = $(this).find('.project-checkbox');
                        if (!checkbox.is(':checked')) {
                            $(this).hide();
                        }
                    });
                    // Mark the last visible row to handle border styling
                    $('.table tbody tr').removeClass('last-visible-row');
                    $('.table tbody tr:visible:last').addClass('last-visible-row');

                    // TARGETED FIX: Apply overflow fix ONLY to table-responsive when 1 row is visible
                    var visibleRows = $('.table tbody tr:visible').length;

                    if (visibleRows === 1) {
                        // Apply class to table-responsive for CSS targeting
                        $('.table-responsive').addClass('single-row-mode');
                    } else {
                        // Multiple rows visible - remove single row mode
                        $('.table-responsive').removeClass('single-row-mode');
                    }

                    // Update PerfectScrollbar if needed
                    if (typeof PerfectScrollbar !== 'undefined') {
                        var mainContent = document.querySelector('.main-content');
                        if (mainContent && mainContent._ps) {
                            mainContent._ps.update();
                        }
                    }

                } else {
                    // Remove filtered view class and last-visible-row marking
                    $('.table').removeClass('filtered-view');
                    $('.table tbody tr').removeClass('last-visible-row');
                    // Show all rows
                    $('.table tbody tr').show();

                    // Remove single row mode class
                    $('.table-responsive').removeClass('single-row-mode');

                    // Update PerfectScrollbar after showing all rows
                    if (typeof PerfectScrollbar !== 'undefined') {
                        var mainContent = document.querySelector('.main-content');
                        if (mainContent && mainContent._ps) {
                            mainContent._ps.update();
                        }
                    }
                }
            });
        }

        // When any individual checkbox changes, update the header state
        $('.project-checkbox').on('change', function() {
            updateSelectAllState();
        });
    }
});

// ============================================
// TOAST NOTIFICATIONS
// ============================================

// Material Dashboard Toast notification function
window.showToast = function(message, type = 'success') {
    // Create or get toast container (Material Dashboard style)
    let container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'position-fixed end-1 z-index-2';
        container.style.top = '70px';
        container.style.zIndex = '9999';
        document.body.appendChild(container);
    }

    // Set icon and background color based on type
    const icon = type === 'success' ? 'check' : 'campaign';
    const bgClass = type === 'success' ? 'bg-gradient-success' : 'bg-gradient-danger';

    // Create unique ID for this toast
    const toastId = 'toast-' + Date.now();

    // Create compact toast HTML with colored background (same height as table header)
    const toastHTML = `
        <div class="toast fade hide ${bgClass} mt-2" role="alert" aria-live="assertive" id="${toastId}" aria-atomic="true">
            <div class="d-flex align-items-center py-2 px-3">
                <i class="material-symbols-rounded text-white me-2" style="font-size: 20px;">${icon}</i>
                <span class="me-auto text-white">${message}</span>
                <button type="button" class="btn-close btn-close-white ms-3" data-bs-dismiss="toast" aria-label="Close" style="width: 0.4em; height: 0.4em; opacity: 1; filter: brightness(0) invert(1);"></button>
            </div>
        </div>
    `;

    // Add toast to container
    container.insertAdjacentHTML('beforeend', toastHTML);

    // Get the toast element and initialize Bootstrap toast
    const toastElement = document.getElementById(toastId);
    const bsToast = new bootstrap.Toast(toastElement, {
        autohide: true,
        delay: 2000
    });

    // Show the toast
    bsToast.show();

    // Remove from DOM after it's hidden
    toastElement.addEventListener('hidden.bs.toast', function() {
        toastElement.remove();
    });
};

// Check for pending toast message on page load
$(document).ready(function() {
    const pendingToast = sessionStorage.getItem('pendingToast');
    if (pendingToast) {
        const toastData = JSON.parse(pendingToast);
        sessionStorage.removeItem('pendingToast');
        showToast(toastData.message, toastData.type);
    }
});

// ============================================
// BULK EDIT - Global Variables
// ============================================
// These variables are used by page-specific bulk edit implementations
var bulkEditMode = false;
var originalRowData = {};

// NOTE: Bulk edit functions (enableBulkEdit, convertRowToEditMode, saveBulkEdits)
// should be implemented in each page's <script> section.
// See /resources/views/admin/posts/index.blade.php for example implementation.

// ============================================
// BULK DELETE - Dynamic Functions
// ============================================

// Bulk delete selected items (dynamic for any resource)
function deleteBulkSelected(e) {
    e.preventDefault();

    // Get resource info from table data attributes
    const $table = $('#dataTable');
    const resourceType = $table.data('resource-type') || 'item';
    const resourceTypePlural = $table.data('resource-type-plural') || 'items';
    const resourceIdKey = resourceType + '_ids';

    // Get count of selected items
    const selectedCount = $('.project-checkbox:checked').length;

    if (selectedCount === 0) {
        showToast(`Please select at least one ${resourceType} to delete`, 'error');
        return;
    }

    // Collect resource IDs
    const resourceIds = [];
    $('.project-checkbox:checked').each(function() {
        resourceIds.push($(this).val());
    });

    // Build URLs dynamically based on current route
    const currentPath = window.location.pathname.replace('/bin', '');
    const checkUrl = `${currentPath}/check-deletable`;
    const deleteUrl = `${currentPath}/bulk-delete`;

    // First, check which items can be deleted
    $.ajax({
        url: checkUrl,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            [resourceIdKey]: resourceIds
        },
        success: function(checkResult) {
            const deletableCount = checkResult.deletable.length;
            const protectedCount = checkResult.protected.length;

            // Build confirmation message based on results
            let confirmMessage = '';

            if (protectedCount > 0 && deletableCount === 0) {
                // ALL selected items are protected - cannot delete any
                if (protectedCount === 1) {
                    const item = checkResult.protected[0];
                    const reasons = item.reasons.join(' and ');
                    confirmMessage = `The ${resourceType} "${item.name}" cannot be deleted because it has ${reasons}.`;
                } else {
                    confirmMessage = `None of the selected ${resourceTypePlural} can be deleted:\n\n`;
                    checkResult.protected.forEach(function(item) {
                        const reasons = item.reasons.join(', ');
                        confirmMessage += `• ${item.name} (${reasons})\n`;
                    });
                }
                // Show alert and stop (no action)
                alert(confirmMessage);
                return;
            } else if (protectedCount > 0 && deletableCount > 0) {
                // SOME are protected, SOME can be deleted
                confirmMessage = `The following ${resourceType}` + (protectedCount > 1 ? 's' : '') + ' cannot be deleted and will be ignored:\n\n';
                checkResult.protected.forEach(function(item) {
                    const reasons = item.reasons.join(', ');
                    confirmMessage += `• ${item.name} (${reasons})\n`;
                });
                confirmMessage += `\nDo you want to proceed deleting the remaining ${deletableCount} ${resourceType}` + (deletableCount > 1 ? 's' : '') + '?';
            } else {
                // ALL can be deleted - normal confirmation
                confirmMessage = selectedCount === 1
                    ? `Are you sure you want to delete this ${resourceType}?`
                    : `Are you sure you want to delete ${selectedCount} ${resourceTypePlural}?`;
            }

            // Show confirmation dialog
            if (!confirm(confirmMessage)) {
                return;
            }

            // Proceed with deletion of deletable items only
            $.ajax({
                url: deleteUrl,
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    [resourceIdKey]: checkResult.deletable
                },
                success: function(response) {
                    // Build success message
                    let message = '';
                    if (deletableCount > 0) {
                        message = deletableCount + ' ' + resourceType + (deletableCount > 1 ? 's' : '') + ' deleted successfully.';
                        if (protectedCount > 0) {
                            message += ' ' + protectedCount + ' ' + resourceType + (protectedCount > 1 ? 's were' : ' was') + ' skipped.';
                        }
                    }

                    sessionStorage.setItem('pendingToast', JSON.stringify({
                        message: message,
                        type: 'success'
                    }));
                    window.location.reload();
                },
                error: function(xhr) {
                    showToast(`Error deleting ${resourceTypePlural}. Please try again.`, 'error');
                    console.error(xhr.responseText);
                }
            });
        },
        error: function(xhr) {
            showToast(`Error checking ${resourceTypePlural}. Please try again.`, 'error');
            console.error(xhr.responseText);
        }
    });
}

function restoreBulkSelected(e) {
    e.preventDefault();

    // Get resource info from table data attributes
    const $table = $('#dataTable');
    const resourceType = $table.data('resource-type') || 'item';
    const resourceTypePlural = $table.data('resource-type-plural') || 'items';
    const resourceIdKey = resourceType + '_ids';

    // Get count of selected items
    const selectedCount = $('.project-checkbox:checked').length;

    if (selectedCount === 0) {
        showToast(`Please select at least one ${resourceType} to restore`, 'error');
        return;
    }

    // Confirm restoration
    const confirmMessage = selectedCount === 1
        ? `Are you sure you want to restore this ${resourceType}?`
        : `Are you sure you want to restore ${selectedCount} ${resourceTypePlural}?`;

    if (!confirm(confirmMessage)) {
        return;
    }

    // Collect resource IDs
    const resourceIds = [];
    $('.project-checkbox:checked').each(function() {
        resourceIds.push($(this).val());
    });

    // Build URL dynamically based on current route
    const currentPath = window.location.pathname.replace('/bin', '');
    const restoreUrl = `${currentPath}/bulk-restore`;

    // Send restore request
    $.ajax({
        url: restoreUrl,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            [resourceIdKey]: resourceIds
        },
        success: function(response) {
            const message = selectedCount === 1
                ? `${resourceType.charAt(0).toUpperCase() + resourceType.slice(1)} restored successfully!`
                : `${resourceTypePlural.charAt(0).toUpperCase() + resourceTypePlural.slice(1)} restored successfully!`;
            sessionStorage.setItem('pendingToast', JSON.stringify({
                message: message,
                type: 'success'
            }));
            window.location.reload();
        },
        error: function(xhr) {
            const errorMessage = selectedCount === 1
                ? `Error restoring ${resourceType}. Please try again.`
                : `Error restoring ${resourceTypePlural}. Please try again.`;
            showToast(errorMessage, 'error');
            console.error(xhr.responseText);
        }
    });
}

function permanentlyDeleteBulkSelected(e) {
    e.preventDefault();

    // Get resource info from table data attributes
    const $table = $('#dataTable');
    const resourceType = $table.data('resource-type') || 'item';
    const resourceTypePlural = $table.data('resource-type-plural') || 'items';
    const resourceIdKey = resourceType + '_ids';

    // Get count of selected items
    const selectedCount = $('.project-checkbox:checked').length;

    if (selectedCount === 0) {
        showToast(`Please select at least one ${resourceType} to delete permanently`, 'error');
        return;
    }

    // Strong confirmation for permanent deletion
    const confirmMessage = selectedCount === 1
        ? `WARNING: This will permanently delete this ${resourceType}. This action cannot be undone!\n\nAre you absolutely sure?`
        : `WARNING: This will permanently delete ${selectedCount} ${resourceTypePlural}. This action cannot be undone!\n\nAre you absolutely sure?`;

    if (!confirm(confirmMessage)) {
        return;
    }

    // Collect resource IDs
    const resourceIds = [];
    $('.project-checkbox:checked').each(function() {
        resourceIds.push($(this).val());
    });

    // Build URL dynamically based on current route
    const currentPath = window.location.pathname.replace('/bin', '');
    const permanentDeleteUrl = `${currentPath}/bulk-permanent-delete`;

    // Send permanent delete request
    $.ajax({
        url: permanentDeleteUrl,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            [resourceIdKey]: resourceIds
        },
        success: function(response) {
            const message = selectedCount === 1
                ? `${resourceType.charAt(0).toUpperCase() + resourceType.slice(1)} permanently deleted!`
                : `${resourceTypePlural.charAt(0).toUpperCase() + resourceTypePlural.slice(1)} permanently deleted!`;
            sessionStorage.setItem('pendingToast', JSON.stringify({
                message: message,
                type: 'success'
            }));
            window.location.reload();
        },
        error: function(xhr) {
            const errorMessage = selectedCount === 1
                ? `Error permanently deleting ${resourceType}. Please try again.`
                : `Error permanently deleting ${resourceTypePlural}. Please try again.`;
            showToast(errorMessage, 'error');
            console.error(xhr.responseText);
        }
    });
}

// ============================================
// CLICKABLE TABLE ROWS
// ============================================

// Make table rows clickable
$(document).ready(function() {
    $('.table tbody tr.clickable-row').on('click', function(e) {
        // Don't navigate if clicking on checkbox, button, link, or input
        if ($(e.target).is('input, button, a, select, .form-check-input') ||
            $(e.target).closest('input, button, a, select, .form-check').length > 0) {
            return;
        }

        // Get resource ID and type from row data attributes
        const $row = $(this);
        const postId = $row.data('post-id');
        const pageId = $row.data('page-id');
        const categoryId = $row.data('category-id');
        const tagId = $row.data('tag-id');
        const userId = $row.data('user-id');
        const roleId = $row.data('role-id');
        const menuId = $row.data('menu-id');

        // Navigate to appropriate edit page
        if (postId) window.location.href = `/admin/posts/${postId}/edit`;
        else if (pageId) window.location.href = `/admin/pages/${pageId}/edit`;
        else if (categoryId) window.location.href = `/admin/categories/${categoryId}/edit`;
        else if (tagId) window.location.href = `/admin/tags/${tagId}/edit`;
        else if (userId) window.location.href = `/admin/users/${userId}/edit`;
        else if (roleId) window.location.href = `/admin/roles/${roleId}/edit`;
        else if (menuId) window.location.href = `/admin/menus/${menuId}/edit`;
    });
});

// ============================================
// BULK EDIT - Shared UI Functions
// ============================================
// These functions are called by page-specific bulk edit implementations

/**
 * Show bulk edit controls (Save and Cancel buttons)
 * Replaces the "Bulk edit" button with Save/Cancel
 */
function showBulkEditControls() {
    // Find the bulk edit button and replace with Save/Cancel
    const $bulkEditButton = $('button:contains("Bulk edit")');
    const $buttonContainer = $bulkEditButton.parent();

    // Replace bulk edit button with Save and Cancel buttons
    $bulkEditButton.replaceWith(`
        <button class="btn btn-sm btn-success text-xxs m-0" type="button" onclick="saveBulkEdits()">
            <i class="material-symbols-rounded" style="font-size: 14px;">save</i>
            Save changes
        </button>
        <button class="btn btn-sm btn-secondary text-xxs m-0" type="button" onclick="cancelBulkEdit()">
            Cancel
        </button>
    `);
}

/**
 * Cancel bulk edit mode
 * Reloads the page to reset everything
 */
function cancelBulkEdit() {
    // Reload page to reset everything
    window.location.reload();
}
