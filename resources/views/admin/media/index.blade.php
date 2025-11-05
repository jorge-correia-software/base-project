@extends('layouts.admin')

@section('title', 'Media Library')
@section('breadcrumb', 'Media')
@section('page-title', 'Media Library')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="text-white text-capitalize ps-3">Media Library</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('admin.media.create') }}" class="btn btn-sm btn-light me-3">
                                <i class="material-icons-round opacity-10">upload</i> Upload Files
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="row px-4">
                    @forelse($media as $file)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card">
                            @if($file->file_type === 'image')
                                <img src="{{ asset('storage/' . $file->file_path) }}" class="card-img-top" alt="{{ $file->file_name }}" style="height: 150px; object-fit: cover;">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-gradient-secondary" style="height: 150px;">
                                    <i class="material-icons-round text-white" style="font-size: 48px;">
                                        @if($file->file_type === 'video')
                                            video_library
                                        @elseif($file->file_type === 'document')
                                            description
                                        @else
                                            insert_drive_file
                                        @endif
                                    </i>
                                </div>
                            @endif
                            <div class="card-body p-2">
                                <h6 class="text-sm mb-1" title="{{ $file->file_name }}">{{ Str::limit($file->file_name, 20) }}</h6>
                                <p class="text-xs text-secondary mb-2">{{ number_format($file->file_size / 1024, 2) }} KB</p>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank" class="btn btn-sm btn-info mb-0">
                                        <i class="material-icons-round opacity-10 text-sm">visibility</i>
                                    </a>
                                    <form action="{{ route('admin.media.destroy', $file) }}" method="POST" onsubmit="return confirm('Delete this file?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger mb-0">
                                            <i class="material-icons-round opacity-10 text-sm">delete</i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <i class="material-icons-round opacity-10" style="font-size: 64px;">perm_media</i>
                        <p class="text-sm text-secondary mt-3">No media files yet. <a href="{{ route('admin.media.create') }}">Upload your first file</a></p>
                    </div>
                    @endforelse
                </div>
                <div class="px-3 mt-3">
                    {{ $media->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
