@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
{{--                <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">--}}
                <img src="https://www.kemdikbud.go.id/main/files/large/83790f2b43f00be" class="logo" alt="Laravel Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
