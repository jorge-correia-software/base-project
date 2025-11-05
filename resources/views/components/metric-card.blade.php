@props([
    'title' => 'Metric',
    'value' => '0',
    'icon' => 'dashboard',
    'iconColor' => 'dark',
    'iconShape' => 'border-radius-lg',
    'footer' => null,
])

<div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
        <div class="card-header p-2 ps-3">
            <div class="d-flex justify-content-between">
                <div>
                    <p class="text-sm mb-0 text-capitalize">{{ $title }}</p>
                    <h5 class="mb-0">{!! $value !!}</h5>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-{{ $iconColor }} shadow-{{ $iconColor }} shadow text-center {{ $iconShape }}">
                    <i class="material-symbols-rounded opacity-10">{{ $icon }}</i>
                </div>
            </div>
        </div>
        @if($footer)
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
            <p class="mb-0 text-sm">{!! $footer !!}</p>
        </div>
        @endif
    </div>
</div>
