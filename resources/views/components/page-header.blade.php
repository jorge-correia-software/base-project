@props([
    'icon',
    'title',
    'subtitle',
    'backRoute' => null,
])

<div class="row">
    <div class="col-12">
        <h5 class="mb-0 font-weight-bolder d-flex align-items-center">
            @if($backRoute)
                <a href="{{ $backRoute }}" class="text-dark text-decoration-none d-inline-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px; border-radius: 8px; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f0f0f0'" onmouseout="this.style.backgroundColor='transparent'">
                    <i class="material-symbols-rounded">{{ $icon }}</i>
                </a>
                <i class="material-symbols-rounded me-2 text-secondary">chevron_right</i>
            @else
                <i class="material-symbols-rounded me-2">{{ $icon }}</i>
            @endif
            {!! $title !!}
        </h5>
        <p class="mb-4 text-sm">
            {{ $subtitle }}
        </p>
        @if(isset($actions))
            {{ $actions }}
        @endif
    </div>
</div>
