<x-app-layout>
    
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __($title) }}
            </h2>
            <x-primary-button class="">
                <a href="{{ route("users.index") }}">< Volver al listado</a>
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
                    
                        <form method="post" action="{{ route($route,$lector) }}" class="mt-6 space-y-6">
                            @csrf
                            @if ($lector)
                                @method("put") {{--Modificando--}}
                            @endif
    
                            <div>
                                <x-input-label for="update_name" :value="__('Nombre y apellidos')" :required=true />
                                <x-text-input id="update_name" name="name" value="{{ $lector->name ?? old('name')}}" type="text" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
    
                            <div>
                                <x-input-label for="update_email" :value="__('Email')" :required=true />
                                <x-text-input id="update_email" name="email" value="{{ $lector->email ?? old('email')}}" type="text" class="mt-1 block w-full" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="update_telephone" :value="__('Teléfono')" />
                                <x-text-input id="update_telephone" name="telephone" value="{{ $lector->telephone ?? old('telephone')}}" type="text" class="mt-1 block w-full" />
                                <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mt-4">
                                @if ($lector)  
                                <x-input-label for="password" :value="__('Contraseña')" />
                                <x-text-input id="password" class="block mt-1 w-full"
                                                type="password"
                                                name="password"
                                                autocomplete="new-password" />

                                @else
                                <x-input-label for="password" :value="__('Contraseña')" :required=true />
                                <x-text-input id="password" class="block mt-1 w-full"
                                                type="password"
                                                name="password"
                                                required 
                                                autocomplete="new-password" />

                                @endif
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                @if ($lector)

                                    <x-input-label for="password_confirmation" :value="__('Repite la contraseña')" />
                                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                type="password"
                                                name="password_confirmation" autocomplete="new-password" />

                                @else
                                    <x-input-label for="password_confirmation" :value="__('Repite la contraseña')" :required=true />
                                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                type="password"
                                                name="password_confirmation" required autocomplete="new-password" />
                                @endif 
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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
