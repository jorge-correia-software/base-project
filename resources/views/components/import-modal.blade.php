@props([
    'modalId' => 'importModal',
    'title' => 'Import applications',
    'question' => 'How do you want to import your applications?',
    'csvLabel' => 'Upload a CSV file',
    'csvDescription' => 'Import a CSV file that\'s already formatted to fit our template.',
    'pdfLabel' => 'Import from PDF',
    'pdfDescription' => 'Import application data from PDF documents.',
    'sampleCsvUrl' => '#',
])

<style>
#{{ $modalId }} {
    --bs-primary: #000000;
    --bs-primary-rgb: 0, 0, 0;
}
#{{ $modalId }} .form-check-input:checked[type=radio] {
    --bs-form-check-bg-image: none !important;
    background-color: transparent !important;
    border-color: #000000 !important;
}
#{{ $modalId }} .form-check:not(.form-switch) .form-check-input[type=radio]:checked {
    border-color: #000000 !important;
}
#{{ $modalId }} .form-check:not(.form-switch) .form-check-input[type=radio]:checked:after {
    background: #000000 !important;
    opacity: 1 !important;
}
#{{ $modalId }} .form-check-input[type=radio]:focus {
    border-color: #000000 !important;
    box-shadow: none !important;
}
#{{ $modalId }} .form-check-input[type=radio]:focus:before,
#{{ $modalId }} .form-check-input[type=radio]:active:before,
#{{ $modalId }} .form-check-input[type=radio]:checked:before,
#{{ $modalId }} .form-check-input[type=radio]:before {
    background: transparent !important;
    opacity: 0 !important;
}
#{{ $modalId }} .ripple {
    display: none !important;
}
#{{ $modalId }} .form-check:not(.form-switch) .form-check-input[type=radio]:active {
    box-shadow: 0 0 0 12px rgba(0, 0, 0, 0.1) !important;
}
#{{ $modalId }} .form-check-input[type=radio]:active:after {
    background: #000000 !important;
}
</style>

<!-- Import Modal -->
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #f8f9fa;">
                <h5 class="modal-title font-weight-bolder" id="{{ $modalId }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6 class="text-sm mb-3">{{ $question }}</h6>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="radio" name="{{ $modalId }}ImportType" id="{{ $modalId }}CSV" value="csv" checked>
                    <label class="form-check-label" for="{{ $modalId }}CSV" style="cursor: pointer;">
                        <div class="font-weight-bold text-dark">{{ $csvLabel }}</div>
                        <div class="text-sm text-secondary">{{ $csvDescription }}</div>
                        @if($sampleCsvUrl)
                        <div class="text-sm"><a href="{{ $sampleCsvUrl }}" class="text-info">Download sample CSV</a></div>
                        @endif
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="{{ $modalId }}ImportType" id="{{ $modalId }}PDF" value="pdf">
                    <label class="form-check-label" for="{{ $modalId }}PDF" style="cursor: pointer;">
                        <div class="font-weight-bold text-dark">{{ $pdfLabel }}</div>
                        <div class="text-sm text-secondary">{{ $pdfDescription }}</div>
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-gray-custom mb-0" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-dark mb-0">Next</button>
            </div>
        </div>
    </div>
</div>
