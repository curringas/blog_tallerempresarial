@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src="https://tallerempresarial.es/wp-content/uploads/2019/03/logo.png" class="logo" alt="{{$slot}}">
@endif
</a>
</td>
</tr>
