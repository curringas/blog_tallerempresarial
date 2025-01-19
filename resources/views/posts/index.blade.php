<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($posts as $post)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h2 class="text-2xl font-semibold text-gray-800"><a href="{{ route("posts.view",["post"=>$post->id])}}">{{ $post->title }}</a></h2>
                        <p class="mt-2 text-gray-600">{{ $post->desde }} | {{ $post->category}}</p>
                        <p class="mt-2 text-gray-600">{{ $post->resumen }}</p>
                        <p class="mt-2">[<a href="{{ route("posts.view",["post"=>$post->id])}}">Seguir leyendo</a>]</p>
                        @if ($user->profile == "administrator")
                            <p class="mt-2">[<a href="{{ route("posts.edit",["post"=>$post->id])}}">Editar</a>]</p>
                        @endif
                </div>
            @endforeach
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>
