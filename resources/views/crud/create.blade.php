<x-layout>
    @admin
        <x-crud.create action="admin"/>
    @else
        <x-crud.create action="user"/>
    @endadmin
</x-layout>
