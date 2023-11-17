<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-8">
                <div class="mt-2"><h4>ARTIKEL</h4></div>
                <form id="form-membership">
                    @csrf
                    <div class="mb-3 col-md-6 mt-3">
                        <label for="email">Program Membership</label>
                        <select class="form-control form-control-sm" name="program_id">
                            <option value="">--Option--</option>
                            @if(count($programs)>0)
                                @foreach ($programs as $id => $name)
                                    <option value="{{ $id }}" class="text-capitalize">{{$name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary btn-save">Joint</button>
                </form>
            </div>
            <div class="col-lg-3 col-4">
                <div class="mt-2"><h4>Member</h4></div>
                <button type="submit" class="btn btn-sm btn-primary btn-save">Save</button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script type="module">
            $("#form-membership").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '/programs/joint',
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Good Job',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.log(response.message);
                    },
                    error: function (xhr, status, error) {
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
                        }else {
                            alert('Hubungi Administrator')
                            console.log("Status: " + xhr.status);
                            console.log("Pesan: " + error);
                        }
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
