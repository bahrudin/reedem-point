<x-app-layout>
    <div class="container my-3">
        <div class="row justify-content-center bg-light py-3">
            <div class="col-lg-6">
                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf
                    <div class="col-md-6">
                        <label class="form-label">Validasi Password</label>
                        <input id="password" class="form-control form-control-sm  mt-1 w-full" type="password" name="password"
                               required autocomplete="current-password"/>
                    </div>
                    <div class="flex justify-end mt-4 mb-3">
                        <button class="btn btn-sm btn-dark">
                            {{ __('Confirm') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
</x-app-layout>
