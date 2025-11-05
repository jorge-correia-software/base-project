@props([
    'name' => 'content',
    'label' => 'Content',
    'value' => '',
    'required' => false,
    'minHeight' => '273px',
    'maxHeight' => '273px'
])

<div class="row">
    <div class="col-md-12">
        <div class="mb-1">
            <label for="{{ $name }}" class="form-label">
                {{ $label }}
                @if($required)
                    <span class="text-danger">*</span>
                @endif
            </label>
            <div id="editor-wrapper" class="quill-editor-wrapper">
                <div id="editor" style="min-height: {{ $minHeight }}; max-height: {{ $maxHeight }};">
                    {!! old($name, $value) !!}
                </div>
            </div>
        </div>
        <input type="hidden" name="{{ $name }}" id="{{ $name }}" {{ $required ? 'required' : '' }}>
        @error($name)
            <p class="text-danger text-xs mt-2">{{ $message }}</p>
        @enderror
    </div>
</div>

@once
    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <style>
    .quill-editor-wrapper {
        border: 1px solid #d2d6da;
        border-radius: 0.375rem;
        transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        background: white;
    }

    .quill-editor-wrapper.is-focused {
        border-color: #3A416F;
        box-shadow: inset 1px 0 #3A416F, inset -1px 0 #3A416F, inset 0 -1px #3A416F, inset 0 1px #3A416F;
    }

    .quill-editor-wrapper .ql-toolbar {
        border: none;
        border-bottom: 1px solid #d2d6da;
        border-radius: 0.375rem 0.375rem 0 0;
    }

    .quill-editor-wrapper .ql-container {
        border: none;
        font-family: inherit !important;
        font-size: 0.875rem !important;
    }

    .quill-editor-wrapper .ql-editor {
        min-height: {{ $minHeight }};
        max-height: {{ $maxHeight }};
        overflow-y: auto;
        font-size: 0.875rem !important;
        line-height: 1.5 !important;
    }

    .quill-editor-wrapper .ql-editor p {
        font-size: 0.875rem !important;
    }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
    $(document).ready(function() {
        // Initialize Quill editor
        const quill = new Quill('#editor', {
            theme: 'snow'
        });

        // Get the wrapper element
        const editorWrapper = $('#editor-wrapper');

        // Handle focus behavior
        quill.on('selection-change', function(range) {
            if (range) {
                editorWrapper.addClass('is-focused');
            } else {
                editorWrapper.removeClass('is-focused');
            }
        });

        // On form submit, copy Quill content to hidden input
        $('form').on('submit', function() {
            $('#{{ $name }}').val(quill.root.innerHTML);
        });
    });
    </script>
    @endpush
@endonce
