{{-- resources/views/components/form/card.blade.php --}}
@props([
    'title' => null,
    'headerActions' => null,
    'class' => '',
    'bodyClass' => '',
    'spacing' => 'mt-24'
])

<div class="card {{ $spacing }} {{ $class }}">
    @if($title || $headerActions)
    <div class="card-header {{ $headerActions ? 'd-flex justify-content-between align-items-center' : '' }}">
        @if($title)
        <h6 class="card-title mb-0">{{ $title }}</h6>
        @endif
        @if($headerActions)
        {{ $headerActions }}
        @endif
    </div>
    @endif

    <div class="card-body {{ $bodyClass }}">
        {{ $slot }}
    </div>
</div>
