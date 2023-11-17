<x-app-layout>
    <div class="container">
        <div class="row justify-content-center bg-light">
            <div class="col-lg-6">
                <form action="" id="login-register">
                    @csrf
                    <div class="mb-3 mt-3">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control form-control-sm" id="name" placeholder="Enter name">
                    </div>
                    <div class="mb-3 col-md-6 mt-3">
                        <label for="gender">Jenis Kelamin</label>
                        <select class="form-control form-control-sm" name="gender">
                            <option value="">--Option--</option>
                            <option value="Male">Pria</option>
                            <option value="Female">Wanita</option>
                        </select>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control form-control-sm" id="email" placeholder="Enter email">
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="card_id">No KTP</label>
                            <input type="text" name="people_card" class="form-control form-control-sm" placeholder="Enter ID">
                        </div>
                        <div class="col">
                            <label for="phone">No HP</label>
                            <input type="text" name="phone" class="form-control form-control-sm" placeholder="Enter Phone">
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="city">Kota</label>
                        <input type="text" name="city" class="form-control form-control-sm" placeholder="Enter Kota">
                    </div>
                    <div class="mb-5 col-md-6">
                        <label for="referral">Kode Referral <i>(Optional)</i></label>
                        <input type="text" name="referral" class="form-control form-control-sm"
                               placeholder="Enter Referral">
                    </div>
                    <div class="mb-5">
                        <label for="pwd">Password</label>
                        <input type="password" name="password" class="form-control form-control-sm" id="pwd"
                               placeholder="Enter password">
                    </div>
                    <div class="mb-5">
                        <label for="pwd">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control form-control-sm" id="pwd"
                               placeholder="Enter password">
                    </div>
                    <div class="flex-row">
                        <a class="text-muted" href="{{ route('login') }}">Akun Ready</a>
                        <button type="submit" class="btn btn-md btn-dark float-end">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="module">

            $(document).ready(function () {
                $('#login-register').submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: '/register',
                        data: $(this).serialize(),
                        success: function (response) {
                            if (response.status === true) {
                                console.log(response.message);
                                window.location = 'dashboard';
                            }
                        },
                        error: function (xhr, status, error) {
                            if (xhr.status === 403) {
                                console.log(xhr.status);
                            }
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                var errorMessages = '';
                                $.each(errors, function (key, value) {
                                    errorMessages += value[0] + '<br>';
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validasi Gagal',
                                    html: errorMessages,
                                });
                            } else {
                                alert('Hubungi Administrator')
                                console.log("Status: " + xhr.status);
                                console.log("Pesan: " + error);
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
