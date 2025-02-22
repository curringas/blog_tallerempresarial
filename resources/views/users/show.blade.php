<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lectores') }}
            </h2>
            <x-primary-button class="">
                <a href="{{ route("users.index") }}">< Volver al listado</a>
            </x-primary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-3xl font-semibold text-gray-800"><a href="">{{ $lector->name }}</a></h2>
                            <p class="mt-2 text-gray-600">{{ $lector->email." | ".$lector->telephone }}</p>
                        </div>
                        <div>
                            @if ($user->profile == "administrator")
                                <p class="mt-6">
                                    <form method="post" action="{{ route("users.destroy",$lector)}}">
                                        @csrf
                                        @method("delete")
                                        <a href="{{ route("users.edit",$lector)}}">
                                            <x-primary-button type="button">Editar</x-primary-button>
                                        </a>
                                        <x-secondary-button type="submit">Eliminar</x-secondary-button>
                                    </form>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div>
                        <hr class="mt-3 mb-3">
                        <h3 class="mt-3">Le gustan {{count($lector->likes)}} artículos del blog:</h3>
                        @foreach ($lector->likes as $like)
                            <li class="mt-2 text-gray-600">{{ $like->post->title}}</p>
                        @endforeach

                        @if ($user->profile == "administrator")
                            <p class="mt-6">
                                <form method="post" action="{{ route("users.destroy",$lector)}}">
                                    @csrf
                                    @method("delete")
                                    <a href="{{ route("users.edit",$lector)}}">
                                        <x-primary-button type="button">Editar</x-primary-button>
                                    </a>
                                    <x-secondary-button type="submit">Eliminar</x-secondary-button>
                                </form>
                            </p>
                        @endif
                    </div>
                </div>
        </div>
    </div>
</x-app-layout>
