@if (Auth::check())
    <div class="mt-2">
        <ul class="list-group">
            <h5>NFORMASI POINT:</h5>
            <li class="list-group-item">POINT : {{ $totalAmount }}</li>
            <li class="list-group-item">KONVERSI POIN : {{ $convertedAmount }}</li>
            <li class="list-group-item">POINT EXPIRED DATE:
                @foreach ($expiredPoints as $point)
                    {{ $point->expired_at }}
                @endforeach
            </li>
        </ul>
    </div>
    @if((Auth::user()->programs()->exists()))
        <p class="mt-2">
        <h5>Dapatkan lebih banyak point membership</h5>
        <a href="{{ route('programs.joint') }}" class="btn btn-sm btn-dark button-membership">Click
            here!</a>
        </p>
    @else
        <div class="mt-2">
            <h5>Free Joint Membership</h5>
            <a href="{{ route('programs.joint') }}" class="btn btn-sm btn-dark button-membership">Click
                here!</a>
        </div>
    @endif
@else
@endif
