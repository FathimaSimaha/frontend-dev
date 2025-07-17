@props(['href', 'icon'])

<li>
    <a href="{{ $href }}">
        <iconify-icon icon="{{ $icon }}" class="menu-icon"></iconify-icon>
        <span>{{ $slot }}</span> 
    </a>
</li>
