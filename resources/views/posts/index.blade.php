@extends('layouts.app')

@section('title', 'Blog - Latest News & Updates')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-light-pink">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="display-4 gradient-text mb-3">Latest News & Updates</h1>
                <p class="lead text-muted">
                    Stay informed with our latest insights, announcements, and success stories.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Blog Posts Grid -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($posts as $post)
            <div class="col-lg-4 col-md-6">
                <x-post-card :post="$post" imageHeight="250px" :excerptLimit="120" />
            </div>
            @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="material-icons-round text-muted" style="font-size: 64px; opacity: 0.3;">article</i>
                    <h3 class="mt-3 text-muted">No posts found</h3>
                    <p class="text-muted">Check back soon for new content!</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
        <div class="row mt-5">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
