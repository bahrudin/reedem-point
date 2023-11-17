<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-8">
                <div class="mt-2"><h4>Welcome, <b
                            class="text-muted font-weight-bold">{{ \Illuminate\Support\Str::title($user->name) }}</b>
                    </h4></div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>NIK</th>
                        <td>{{ $user->people_card }}</td>
                    </tr
                    ><tr>
                        <th>Gender</th>
                        <td>{{ $user->gender }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="col-lg-3 col-4">
                <div class="mt-2"><h4>Member</h4></div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script type="module">
            $(document).ready(function () {
                $('#login-form').submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: '/login',
                        data: $(this).serialize(),
                        success: function (response) {
                            console.log(response.message);
                            // Simpan token di sini atau lakukan sesuatu yang diperlukan
                            alert('Success..');
                        },
                        error: function (error) {
                            console.error(error);
                            alert('Fail to run Login..');
                            // Handle error
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
