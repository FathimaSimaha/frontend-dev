{{-- resources/views/components/form/input.blade.php --}}
@props([
    'label' => null,
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'readonly' => false,
    'value' => '',
    'min' => null,
    'max' => null,
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

    <input
        type="{{ $type }}"
        name="{{ $name }}"
        @if($id) id="{{ $id }}" @else id="{{ $name }}" @endif
        class="form-control {{ $class }}"
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($value) value="{{ old($name, $value) }}" @else value="{{ old($name) }}" @endif
        @if($required) required @endif
        @if($readonly) readonly @endif
        @if($min !== null) min="{{ $min }}" @endif
        @if($max !== null) max="{{ $max }}" @endif
        {{ $attributes }}
    >

    @error($name)
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
