@once
@push('styles')
<style>
/* Make Select2 match Material Dashboard form-control styling */
.select2-container--default .select2-selection--multiple {
    border: 1px solid #d2d6da !important;
    border-radius: 0.375rem !important;
    min-height: 40px !important;
    padding: 0.375rem 0.75rem !important;
    font-size: 0.875rem !important;
    line-height: 1.5 !important;
}

.select2-container--default .select2-selection--multiple .select2-selection__placeholder {
    color: #6c757d !important;
    font-size: 0.875rem !important;
}

.select2-container--default .select2-selection--multiple .select2-selection__rendered {
    color: #495057 !important;
    line-height: 24px !important;
    padding-left: 0 !important;
    font-size: 0.875rem !important;
}

.select2-container--default .select2-selection--multiple .select2-selection__rendered li {
    font-size: 0.875rem !important;
    line-height: 24px !important;
}

/* Style the search input field in multi-select which shows the placeholder */
.select2-container--default .select2-selection--multiple .select2-search__field {
    font-size: 0.875rem !important;
    line-height: 24px !important;
    height: 24px !important;
    margin-top: 0 !important;
}

.select2-container--default .select2-selection--multiple .select2-search__field::placeholder {
    font-size: 0.875rem !important;
    color: #6c757d !important;
}

.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: #3A416F !important;
}

/* Make Select2 single-select match Material Dashboard form-control styling */
.select2-container--default .select2-selection--single {
    border: 1px solid #d2d6da !important;
    border-radius: 0.375rem !important;
    height: 40px !important;
    padding: 0.375rem 0.75rem !important;
    font-size: 0.875rem !important;
    line-height: 1.5 !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #495057 !important;
    line-height: 24px !important;
    padding-left: 0 !important;
    font-size: 0.875rem !important;
}

.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: #6c757d !important;
    font-size: 0.875rem !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 38px !important;
}

.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #3A416F !important;
}

/* Make Select2 dropdown results match form-control font size */
.select2-results__option {
    font-size: 0.875rem !important;
}

.select2-dropdown {
    border: 1px solid #d2d6da !important;
    border-radius: 0.375rem !important;
}

.select2-results__message {
    font-size: 0.875rem !important;
}
</style>
@endpush
@endonce
