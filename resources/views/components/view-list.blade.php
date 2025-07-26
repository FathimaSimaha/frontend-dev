@props([
    'columns' => [], // Array of column names
    'data' => [], // Array of data rows
    'statusOptions' => ['Paid', 'Pending'], // Status filter options
    'module' => 'items', // Module name for links and labels
    'createRoute' => '#', // Route for creating a new item
    'viewRoute' => '#', // Route for viewing an item
    'editRoute' => '#', // Route for editing an item
    'deleteRoute' => '#', // Route for deleting an item
])

<div class="card">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="d-flex flex-wrap align-items-center gap-3">
            <div class="d-flex align-items-center gap-2">
                <span>Show</span>
                <select class="form-select form-select-sm w-auto">
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                </select>
            </div>
            <div class="icon-field">
                <input type="text" name="search" class="form-control form-control-sm w-auto" placeholder="Search">
                <span class="icon">
                    <iconify-icon icon="ion:search-outline"></iconify-icon>
                </span>
            </div>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-3">
            <select class="form-select form-select-sm w-auto">
                <option>Status</option>
                @foreach ($statusOptions as $status)
                    <option>{{ $status }}</option>
                @endforeach
            </select>
            <a href="{{ $createRoute }}" class="btn btn-sm btn-primary-600"><i class="ri-add-line"></i> Create
                {{ ucfirst($module) }}</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table bordered-table mb-0">
            <thead>
                <tr>
                    <th scope="col">
                        <div class="form-check style-check d-flex align-items-center">
                            <input class="form-check-input" type="checkbox" value="" id="checkAll">
                            <label class="form-check-label" for="checkAll">
                                S.L
                            </label>
                        </div>
                    </th>
                    @foreach ($columns as $column)
                        <th scope="col">{{ $column }}</th>
                    @endforeach
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $item)
                    <tr>
                        <td>
                            <div class="form-check style-check d-flex align-items-center">
                                <input class="form-check-input" type="checkbox" value=""
                                    id="check{{ $index + 1 }}">
                                <label class="form-check-label" for="check{{ $index + 1 }}">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </label>
                            </div>
                        </td>
                        @foreach ($columns as $key => $column)
                            @php
                                $value = is_array($item) ? $item[$key] ?? '' : $item->$key ?? '';
                                $isImage = strpos($key, 'image') !== false;
                                $isStatus = strtolower($column) == 'status';
                            @endphp
                            <td>
                                @if ($isImage && $value)
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $value }}" alt=""
                                            class="flex-shrink-0 me-12 radius-8">
                                        <h6 class="text-md mb-0 fw-medium flex-grow-1">{{ $item['name'] ?? '' }}</h6>
                                    </div>
                                @elseif($isStatus)
                                    <span
                                        class="px-24 py-4 rounded-pill fw-medium text-sm {{ $value == 'Paid' ? 'bg-success-focus text-success-main' : 'bg-warning-focus text-warning-main' }}">
                                        {{ $value }}
                                    </span>
                                @elseif(strtolower($column) == 'invoice')
                                    <a href="javascript:void(0)" class="text-primary-600">{{ $value }}</a>
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        @endforeach
                        <td>
                            <a href="{{ str_replace(':id', $item['id'] ?? $index, $viewRoute) }}"
                                class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                            </a>
                            <a href="{{ str_replace(':id', $item['id'] ?? $index, $editRoute) }}"
                                class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="lucide:edit"></iconify-icon>
                            </a>
                            <a href="{{ str_replace(':id', $item['id'] ?? $index, $deleteRoute) }}"
                                class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-24">
            <span>Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries</span>
            <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                <li class="page-item">
                    <a class="page-link text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px bg-base"
                        href="{{ $data->previousPageUrl() }}"><iconify-icon icon="ep:d-arrow-left"
                            class="text-xl"></iconify-icon></a>
                </li>
                @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                    <li class="page-item">
                        <a class="page-link {{ $data->currentPage() == $page ? 'bg-primary-600 text-white' : 'bg-primary-50 text-secondary-light' }} fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px"
                            href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                <li class="page-item">
                    <a class="page-link text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px bg-base"
                        href="{{ $data->nextPageUrl() }}"> <iconify-icon icon="ep:d-arrow-right"
                            class="text-xl"></iconify-icon> </a>
                </li>
            </ul>
        </div>
    </div>
</div>
