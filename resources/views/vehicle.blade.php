<x-layout>
    <x-view-list
        :columns="['Vehicle ID', 'Model', 'Year', 'Status']"
        :data="$vehicles"
        :statusOptions="['Active', 'Inactive']"
        module="vehicle"
        createRoute="{{ route('vehicles.create') }}"
        viewRoute="{{ route('vehicles.show', ':id') }}"
        editRoute="{{ route('vehicles.edit', ':id') }}"
        deleteRoute="{{ route('vehicles.destroy', ':id') }}"
    />
</x-layout>
