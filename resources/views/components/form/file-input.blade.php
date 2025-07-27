{{-- resources/views/components/form/file-input.blade.php --}}
@props([
    'label' => null,
    'name' => '',
    'accept' => '',
    'multiple' => false,
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

    <input
        class="form-control {{ $class }}"
        type="file"
        name="{{ $name }}"
        @if($id) id="{{ $id }}" @else id="{{ $name }}" @endif
        @if($accept) accept="{{ $accept }}" @endif
        @if($multiple) multiple @endif
        @if($required) required @endif
        {{ $attributes }}
    >

    @error($name)
    <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
