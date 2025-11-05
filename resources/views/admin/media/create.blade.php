@extends('layouts.admin')

@section('title', 'Upload Media')
@section('breadcrumb', 'Upload Media')
@section('page-title', 'Upload Media Files')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Upload Files</h6>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Select Files *</label>
                                <input type="file" class="form-control" name="files[]" multiple required accept="image/*,video/*,.pdf,.doc,.docx">
                                <small class="form-text text-muted">
                                    Maximum file size: 10MB per file. Supported formats: Images (jpg, png, gif, svg), Videos (mp4, webm), Documents (pdf, doc, docx)
                                </small>
                            </div>
                            @error('files')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div id="uploadProgress" class="mt-3" style="display: none;">
                        <div class="progress">
                            <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 0%"></div>
                        </div>
                        <p class="text-sm text-center mt-2">Uploading...</p>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">
                                <i class="material-icons-round opacity-10">upload</i> Upload Files
                            </button>
                            <a href="{{ route('admin.media.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Upload Guidelines</h6>
                </div>
            </div>
            <div class="card-body">
                <h6 class="mb-3">Recommended Image Sizes:</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="material-icons-round opacity-10 text-sm me-2">check_circle</i> Hero Section: 1920x1080px</li>
                    <li class="mb-2"><i class="material-icons-round opacity-10 text-sm me-2">check_circle</i> Featured Images: 1200x630px</li>
                    <li class="mb-2"><i class="material-icons-round opacity-10 text-sm me-2">check_circle</i> Thumbnails: 600x400px</li>
                    <li class="mb-2"><i class="material-icons-round opacity-10 text-sm me-2">check_circle</i> Profile Images: 400x400px</li>
                </ul>
                <h6 class="mb-3 mt-4">Tips for Better Performance:</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="material-icons-round opacity-10 text-sm me-2">tips_and_updates</i> Use compressed images to improve page load times</li>
                    <li class="mb-2"><i class="material-icons-round opacity-10 text-sm me-2">tips_and_updates</i> Prefer JPG for photos, PNG for graphics with transparency</li>
                    <li class="mb-2"><i class="material-icons-round opacity-10 text-sm me-2">tips_and_updates</i> Use descriptive file names for better SEO</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('uploadForm').addEventListener('submit', function() {
        document.getElementById('uploadProgress').style.display = 'block';
    });
</script>
@endpush
