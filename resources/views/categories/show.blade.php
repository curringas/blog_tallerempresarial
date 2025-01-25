<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lectores') }}
            </h2>
            <x-primary-button class="">
                <a href="{{ route("categories.index") }}">< Volver al listado</a>
            </x-primary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h2 class="text-2xl font-semibold text-gray-800"><a href="">{{ $category->name }}</a></h2> 
                        <p class="mt-2 text-gray-600">{{ $category->description }}</p>                       
                        @if ($user->profile == "administrator")
                            <p class="mt-2">
                                <form method="post" action="{{ route("categories.destroy",$category)}}">
                                    @csrf
                                    @method("delete")
                                    <a href="{{ route("categories.edit",$category)}}">
                                        <x-primary-button type="button">Editar</x-primary-button>
                                    </a>
                                    <x-secondary-button type="submit">Eliminar</x-secondary-button>
                                </form>
                            </p>
                        @endif
                </div>
        </div>
    </div>
</x-app-layout>
