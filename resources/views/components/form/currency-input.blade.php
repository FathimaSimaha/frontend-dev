{{-- resources/views/components/form/currency-input.blade.php --}}
@props([
    'label' => null,
    'name' => '',
    'placeholder' => '0.00',
    'currency' => 'Rs.',
    'required' => false,
    'value' => '',
    'class' => '',
    'colClass' => 'col-12',
    'id' => null
])

<div class="{{ $colClass }}">
    @if($label)
    <label class="form-label" @if($id || $name) for="{{ $id ?: $name }}" @endif>
        {{ $label }}
        @if($required) <span class="text-danger">*</span> @endif
    </label>
    @endif

    <div class="input-group">
        <span class="input-group-text bg-base">{{ $currency }}</span>
        <input
            type="text"
            name="{{ $name }}"
            @if($id) id="{{ $id }}" @else id="{{ $name }}" @endif
            class="form-control flex-grow-1 {{ $class }}"
            placeholder="{{ $placeholder }}"
            value="{{ old($name, $value) }}"
            @if($required) required @endif
            {{ $attributes }}
        >
    </div>

    @error($name)
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
