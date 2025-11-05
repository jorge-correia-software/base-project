@props([
    'post',
    'imageHeight' => '200px',
    'excerptLimit' => 100,
    'showViews' => true,
    'cardClass' => '',
])

<div class="custom-card overflow-hidden h-100 {{ $cardClass }}">
    @if($post->featuredImage)
        <img src="{{ asset('storage/' . $post->featuredImage->file_path) }}"
             class="card-img-top"
             alt="{{ $post->title }}"
             style="height: {{ $imageHeight }}; object-fit: cover;">
    @else
        <div class="bg-gradient-primary d-flex align-items-center justify-content-center"
             style="height: {{ $imageHeight }};">
            <i class="material-icons-round" style="font-size: 48px; opacity: 0.3;">article</i>
        </div>
    @endif
    <div class="p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="badge bg-primary-pink text-white">{{ $post->category->name ?? 'News' }}</span>
            <small class="text-muted">{{ $post->published_at->format('M d, Y') }}</small>
        </div>
        <h4 class="card-title h5 mb-3">{{ $post->title }}</h4>
        <p class="card-text text-muted">{{ Str::limit($post->excerpt, $excerptLimit) }}</p>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                Read More
                <i class="material-icons-round align-middle ms-1" style="font-size: 16px;">arrow_forward</i>
            </a>
            @if($showViews)
                <small class="text-muted">
                    <i class="material-icons-round align-middle" style="font-size: 16px;">visibility</i>
                    {{ $post->views }}
                </small>
            @endif
        </div>
    </div>
</div>
