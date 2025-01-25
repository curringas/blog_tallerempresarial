<x-app-layout>
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($title) }}
            </h2>
            <x-primary-button class="">
                <a href="{{ route("posts.index") }}">< Volver al listado</a>
            </x-primary-button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __($subtitle) }}
                            </h2>
                        </header>
                    
                        <form method="post" action="{{ route($route,$post) }}" class="mt-6 space-y-6">
                            @csrf
                            @if ($post)
                                @method("put") {{--Modificando--}}
                            @endif
    
                            <div>
                                <x-input-label for="update_title" :value="__('Título')" />
                                <x-text-input id="update_title" name="title" value="{{ $post->title ?? ''}}" type="text" class="mt-1 block w-full" />
                            </div>
    
                            <div>
                                <x-input-label for="update_slug" :value="__('Slug')" />
                                <x-text-input id="update_slug" name="slug" value="{{ $post->slug ?? ''}}" type="text" class="mt-1 block w-full" />
                            </div>
                    
                            <div>
                                <x-input-label for="update_category" :value="__('Categoría')" />
                                <x-text-input id="update_category" name="category"  value="{{ $post->category ?? ''}}" type="text" class="mt-1 block w-full" />
                            </div>
                    
                            <div>
                                <x-input-label for="update_content" :value="__('Contenido del post')" />
                                <x-textarea id="update_content" name="content" type="text" class="mt-1 block w-full">
                                    {{ $post->content ?? ''}}
                                </x-textarea>
                            </div>
                    
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Guardar') }}</x-primary-button>
                    
                                @if (session('status') === 'password-updated')
                                    <p
                                        x-data="{ show: true }"
                                        x-show="show"
                                        x-transition
                                        x-init="setTimeout(() => show = false, 2000)"
                                        class="text-sm text-gray-600"
                                    >{{ __('Saved.') }}</p>
                                @endif
                            </div>
                        </form>
                    </section>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
