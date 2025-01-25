<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Listado de categorías') }}
            </h2>
            @if (Auth::user()->profile == "administrator")
                <x-primary-button class="">
                    <a href="{{ route("categories.create") }}">+ AÑADIR NUEVO</a>
                </x-primary-button>
            @endif
        </div>
    </x-slot>
    <!-- Mostrar mensaje de éxito si existe -->
    @if (session('success'))
        <div class="px-4 py-3 mb-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mostrar mensaje de error si existe -->
    @if (session('error'))
        <div class="px-4 py-3 mb-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
            {{ session('error') }}
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($categories as $category)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h2 class="text-2xl font-semibold text-gray-800">
                            @if ($user->profile == "administrator")
                                <a href="{{ route("categories.show",$category)}}">
                            @endif
                            {{ $category->name }}
                            @if ($user->profile == "administrator")
                                </a>
                            @endif
                        </h2>
                        <p class="mt-2 text-gray-600">{{ $category->resumen }}</p>
                        @if ($user->profile == "administrator")
                            <p class="mt-2">[<a href="{{ route("categories.edit",$category)}}">Editar</a>]</p>
                        @endif
                </div>
            @endforeach
            {{$categories->links()}}
        </div>
    </div>
</x-app-layout>
