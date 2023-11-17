@if (Auth::check())
    <div class="mt-2"><h5>Member</h5></div>
    <p>User is login.</p>

    @if((Auth::user()->programMembership()->exists()))
        <p class="bg-danger text-white p-1">Membership Ada</p>
    @else
        <div class="mt-2">
            <h5>Free Joint Membership</h5>
            <a href="{{ route('programs.joint') }}" class="btn btn-sm btn-dark button-membership">Click here!</a>
        </div>
    @endif
@else
    <form method="POST" id="login-form">
        @csrf
        <div class="mb-2">
            <input name="email" type="text" class="form-control form-control-sm"
                   placeholder="Phone" required/>
        </div>
        <div class="mb-2">
            <input name="password" type="password" class="form-control form-control-sm"
                   placeholder="Password" required/>
        </div>
        <div class="mt-2">
            <button type="submit" class="btn btn-sm btn-secondary">Login</button>
        </div>
    </form>
@endif
