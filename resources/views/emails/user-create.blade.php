<x-mail::message>
# ¡Hola {{$lector->name}}!
<x-mail::panel>
Tu usuario {{$lector->email}} ha sido dado de alta como lector en Blog Taller Empresarial
</x-mail::panel>
<x-mail::button :url="route('login')" color="green">
Visita la aplicación
</x-mail::button>
</x-mail::message>