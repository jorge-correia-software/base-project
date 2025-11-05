@extends('layouts.app')

@section('title', $post->title)

@section('content')
<!-- Post Header -->
<section class="py-5 bg-light-pink">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <a href="{{ route('posts.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill mb-3">
                    <i class="material-icons-round align-middle" style="font-size: 16px;">arrow_back</i>
                    Back to Blog
                </a>
                <div class="d-flex align-items-center mb-3">
                    <span class="badge bg-primary-pink text-white me-2">{{ $post->category->name ?? 'News' }}</span>
                    <small class="text-muted me-3">{{ $post->published_at->format('F d, Y') }}</small>
                    <small class="text-muted">
                        <i class="material-icons-round align-middle" style="font-size: 16px;">visibility</i>
                        {{ $post->views }} views
                    </small>
                </div>
                <h1 class="display-5 gradient-text mb-3">{{ $post->title }}</h1>
                @if($post->excerpt)
                    <p class="lead text-muted">{{ $post->excerpt }}</p>
                @endif
                <div class="d-flex align-items-center text-muted">
                    <i class="material-icons-round me-2">person</i>
                    <span>By {{ $post->author->name }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Image -->
@if($post->featuredImage)
<section class="py-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <img src="{{ asset('storage/' . $post->featuredImage->file_path) }}" class="img-fluid rounded shadow-lg" alt="{{ $post->title }}" style="width: 100%; max-height: 500px; object-fit: cover;">
            </div>
        </div>
    </div>
</section>
@endif

<!-- Post Content -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="post-content">
                    {!! $post->content !!}
                </div>

                <!-- Tags -->
                @if($post->tags->count() > 0)
                <div class="mt-5 pt-4 border-top">
                    <h6 class="mb-3">Tags:</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($post->tags as $tag)
                            <span class="badge bg-light text-dark border">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Related Posts -->
@if($relatedPosts->count() > 0)
<section class="py-5 bg-light-pink">
    <div class="container">
        <div class="row">
            <div class="col-12 mb-4">
                <h3 class="h4">Related Posts</h3>
            </div>
        </div>
        <div class="row g-4">
            @foreach($relatedPosts as $relatedPost)
            <div class="col-lg-4 col-md-6">
                <x-post-card :post="$relatedPost" imageHeight="200px" :excerptLimit="80" :showViews="false" />
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
.post-content {
    font-size: 1.125rem;
    line-height: 1.8;
    color: #555;
}

.post-content h2 {
    font-size: 2rem;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #333;
}

.post-content h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
    color: #333;
}

.post-content p {
    margin-bottom: 1.5rem;
}

.post-content ul,
.post-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.post-content li {
    margin-bottom: 0.5rem;
}

.post-content img {
    max-width: 100%;
    height: auto;
    border-radius: 0.5rem;
    margin: 2rem 0;
}

.post-content blockquote {
    border-left: 4px solid #e91e63;
    padding-left: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: #666;
}

.post-content a {
    color: #e91e63;
    text-decoration: none;
}

.post-content a:hover {
    text-decoration: underline;
}

.post-content code {
    background: #f8f9fa;
    padding: 0.2rem 0.4rem;
    border-radius: 0.25rem;
    font-size: 0.9em;
}

.post-content pre {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1.5rem 0;
}

.post-content pre code {
    background: none;
    padding: 0;
}
</style>
@endsection
