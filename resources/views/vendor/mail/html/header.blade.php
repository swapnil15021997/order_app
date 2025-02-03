@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Sonic')
<img src="{{ asset('static/sonic-large.svg')}}" width="110" height="35" alt="Sonic"
class="">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
