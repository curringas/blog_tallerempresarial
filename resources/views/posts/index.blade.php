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
    <!-- Mostrar mensaje de éxito si existe -->
    @if (session('success'))
        <div class="px-4 py-3 mb-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <form method="get" action="{{ route("posts.index") }}" class="flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $subtitle}}
                    </h2>

                    @if (!$liked)
                        <x-select id="select_category" name="category_id" class="mt-1 block w-auto">
                            <option value="">Todas las categorías</option> 
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category_id == $category->id) selected
                                    
                                @endif>{{ $category->name }}
                                </option>
                            @endforeach
                        </x-select>
                    @endif

                    @if (count($user->likes) && !$liked)
                        <a href="{{ route("posts.liked")}}">
                            <x-like-button type="button">Mis articulos favoritos</x-like-button>
                        </a>                                        
                    @elseif ($liked)
                        <a href="{{ route("dashboard")}}">
                            <x-secondary-button type="button">Ver todos</x-like-button>
                        </a>
                    @endif
                </form>
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
<script>
    document.getElementById("select_category").addEventListener("change", function(){
        this.form.submit();
    });
 </script>
