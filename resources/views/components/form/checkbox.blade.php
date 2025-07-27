{{-- resources/views/components/form/checkbox.blade.php --}}
@props([
    'label' => null,
    'name' => '',
    'value' => '1',
    'checked' => false,
    'class' => '',
    'colClass' => 'col-12',
    'id' => null
])

<div class="{{ $colClass }}">
    <div class="form-check">
        <input
            class="form-check-input {{ $class }}"
            type="checkbox"
            name="{{ $name }}"
            @if($id) id="{{ $id }}" @else id="{{ $name }}" @endif
            value="{{ $value }}"
            {{ old($name) || $checked ? 'checked' : '' }}
            {{ $attributes }}
        >
        @if($label)
        <label class="form-check-label" for="{{ $id ?: $name }}">
            {{ $label }}
        </label>
        @endif
    </div>

    @error($name)
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
