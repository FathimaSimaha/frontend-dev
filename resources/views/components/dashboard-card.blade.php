@props([
    'title',
    'value',
    'icon',
    'bgColor',
    'changeValue',
    'changeType' => 'success',
    'changeLabel'
])

<div class="col">
    <div class="card shadow-none border {{ $bgColor }} h-100">
        <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <p class="fw-medium text-primary-light mb-1">{{ $title }}</p>
                    <h6 class="mb-0">{{ $value }}</h6>
                </div>
                <div class="w-50-px h-50-px {{ $attributes->get('iconBg') }} rounded-circle d-flex justify-content-center align-items-center">
                    <iconify-icon icon="{{ $icon }}" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
            <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                <span class="d-inline-flex align-items-center gap-1 {{ $changeType === 'success' ? 'text-success-main' : 'text-danger-main' }}">
                    <iconify-icon icon="{{ $changeType === 'success' ? 'bxs:up-arrow' : 'bxs:down-arrow' }}" class="text-xs"></iconify-icon>
                    {{ $changeValue }}
                </span>
                {{ $changeLabel }}
            </p>
        </div>
    </div>
</div>
