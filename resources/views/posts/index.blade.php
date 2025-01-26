<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Blog') }}
            </h2>
            @if (Auth::user()->profile == "administrator")
                <x-primary-button class="">
                    <a href="{{ route("posts.create") }}">+ AÑADIR NUEVO</a>
                </x-primary-button>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($posts as $post)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <h2 class="text-2xl font-semibold text-gray-800"><a href="{{ route("posts.show",$post)}}">{{ $post->title }}</a></h2>
                        <p class="mt-2 text-gray-600">{{ $post->desde }} | {{ $post->category->name}} | {{ count($post->likes) }} me gusta</p>
                        <p class="mt-2 text-gray-600">{{ $post->resumen }} 
                         <a href="{{ route("posts.show",$post)}}">Leer más</a></p>
                        {{--@if ($user->profile == "administrator")
                            <p class="mt-2">[<a href="{{ route("posts.edit",$post)}}">Editar</a>]</p>
                        @endif--}}
                </div>
            @endforeach
            {{$posts->links()}}
        </div>
    </div>
</x-app-layout>
