<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h2 class="text-2xl font-semibold text-gray-800"><a href="">{{ $post->title }}</a></h2>
                        <p class="mt-2 text-gray-600">{{ $post->created_at->format("d/m/Y")." | ".$post->category }}</p>
                        <p class="mt-2 text-gray-600">{{ $post->content }}</p>
                        <p class="mt-2">[<a href="{{ route("dashboard")}}">Volver a la lista</a>]</p>
                        @if ($user->profile == "administrator")
                            <p class="mt-2">[<a href="{{ route("posts.edit",["post"=>$post->id])}}">Editar</a>]</p>
                        @endif
                </div>
        </div>
    </div>
</x-app-layout>
