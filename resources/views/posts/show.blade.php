<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Blog : {{ $post->title }}
            </h2>
            <x-primary-button class="">
                <a href="{{ route("posts.index") }}">< Volver al listado</a>
            </x-primary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800"><a href="">{{ $post->title }}</a></h2>
                            <p class="mt-2 text-gray-600">{{ $post->created_at->format("d/m/Y")." | ".$post->category }}</p>
                        </div>
                        <div>
                            @if ($user->profile == "administrator")
                            <p class="mt-2">
                                <form method="post" action="{{ route("posts.destroy",$post)}}">
                                    @csrf
                                    @method("delete")
                                    @if (count($megusta))
                                        <a href="{{ route("likes.destroy",$megusta)}}">
                                            <x-like-button type="button">Me Gusta</x-like-button>
                                        </a>                                        
                                    @else
                                        <a href="{{ route("likes.store",$post)}}">
                                            <x-secondary-button type="button">¿Te gusta?</x-like-button>
                                        </a>
                                    @endif

                                    <a href="{{ route("posts.edit",$post)}}">
                                        <x-primary-button type="button">Editar</x-primary-button>
                                    </a>
                                    <x-secondary-button type="submit">Eliminar</x-secondary-button>
                                </form>
                            </p>
                        @endif
                        </div>
                    </div>
                    <p class="mt-2 text-gray-600">{{ $post->content }}</p>
                    <p class="mt-2 text-gray-600">{{ count($post->likes) }} me gusta</p>
                    <p class="mt-4">[<a href="{{ route("dashboard")}}">Volver a la lista</a>]</p>
                    @if ($user->profile == "administrator")
                        <p class="mt-2">
                            <form method="post" action="{{ route("posts.destroy",$post)}}">
                                @csrf
                                @method("delete")
                                <a href="{{ route("posts.edit",$post)}}">
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
