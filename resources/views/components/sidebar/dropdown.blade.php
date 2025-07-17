@props(['icon', 'title', 'items' => []])

<li class="dropdown">
    <a href="javascript:void(0)">
        <iconify-icon icon="{{ $icon }}" class="menu-icon"></iconify-icon>
        <span>{{ $title }}</span>
    </a>
    <ul class="sidebar-submenu">
        @foreach ($items as $item)
            <li>
                <a href="{{ $item['href'] }}">
                    <i class="ri-circle-fill circle-icon {{ $item['color'] }} w-auto"></i>
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
</li>
