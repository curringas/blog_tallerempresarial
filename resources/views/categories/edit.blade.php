<x-app-layout>
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($title) }}
            </h2>
            <x-primary-button class="">
                <a href="{{ route("categories.index") }}">< Volver al listado</a>
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
                    
                        <form method="post" action="{{ route($route,$category) }}" class="mt-6 space-y-6">
                            @csrf
                            @if ($category)
                                @method("put") {{--Modificando--}}
                            @endif
    
                            <div>
                                <x-input-label for="update_name" :value="__('Nombre de la categoría')" :required=true />
                                <x-text-input id="update_name" name="name" value="{{ $category->name ?? old('name')}}" type="text" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
    
                            <div>
                                <x-input-label for="update_slug" :value="__('Slug de la categoría')" :required=true />
                                <x-text-input id="update_slug" name="slug" value="{{ $category->slug ?? old('slug')}}" type="text" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                            </div>


                    
                            <div>
                                <x-input-label for="update_description" :value="__('Descripción de la categoría')" />
                                <x-textarea id="update_description" name="description" type="text" class="mt-1 block w-full">
                                    {{ $category->description ?? old('description')}}
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
