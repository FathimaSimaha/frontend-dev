{{-- resources/views/components/form/select.blade.php --}}
@props([
    'label' => null,
    'name' => '',
    'placeholder' => 'Choose...',
    'options' => [],
    'selected' => '',
    'required' => false,
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

    <select
        name="{{ $name }}"
        @if($id) id="{{ $id }}" @else id="{{ $name }}" @endif
        class="form-select {{ $class }}"
        @if($required) required @endif
        {{ $attributes }}
    >
        @if($placeholder)
        <option value="">{{ $placeholder }}</option>
        @endif

        @foreach($options as $value => $text)
        <option value="{{ $value }}" {{ old($name, $selected) == $value ? 'selected' : '' }}>
            {{ $text }}
        </option>
        @endforeach
    </select>

    @error($name)
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
