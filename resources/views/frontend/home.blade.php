<x-app-layout>
    @push('styles')
        <style>
            .button-membership {
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                animation: blinkAnimation 1s infinite;
            }

            @keyframes blinkAnimation {
                0%, 49%, 100% {
                    opacity: 1;
                }
                50% {
                    opacity: 0;
                }
            }
        </style>
    @endpush

    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-8 shadow-lg p-3 mb-5 bg-light">
                <div class="mt-2"><h5>IKLAN</h5></div>
                <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3">
                                <h4 class="my-0 fw-normal">Free</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">$0<small
                                        class="text-muted fw-light">/mo</small></h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>10 users included</li>
                                    <li>2 GB of storage</li>
                                    <li>Email support</li>
                                    <li>Help center access</li>
                                </ul>
                                <button type="button" class="w-100 btn btn-lg btn-outline-dark">Sign up for free
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm">
                            <div class="card-header py-3">
                                <h4 class="my-0 fw-normal">Pro</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">$15<small
                                        class="text-muted fw-light">/mo</small></h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>20 users included</li>
                                    <li>10 GB of storage</li>
                                    <li>Priority email support</li>
                                    <li>Help center access</li>
                                </ul>
                                <button type="button" class="w-100 btn btn-lg btn-dark">Get started</button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card mb-4 rounded-3 shadow-sm border-dark">
                            <div class="card-header py-3 text-white bg-dark border-dark">
                                <h4 class="my-0 fw-normal">Enterprise</h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">$29<small
                                        class="text-muted fw-light">/mo</small></h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>30 users included</li>
                                    <li>15 GB of storage</li>
                                    <li>Phone and email support</li>
                                    <li>Help center access</li>
                                </ul>
                                <button type="button" class="w-100 btn btn-lg btn-dark">Contact us</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-4 shadow-lg p-3 mb-5 bg-light">
                <div class="mt-2"><h5>Member Login</h5></div>
                <form method="POST" id="login-form">
                    @csrf
                    <div class="mb-2">
                        <input name="phone" type="text" class="form-control form-control-sm"
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
                <div class="mt-5 py-3">
                    <h5>Free Joint Membership</h5>
                    <a href="{{ route('programs.joint') }}" class="btn btn-sm btn-dark button-membership">Click
                        here!</a>
                </div>

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
                            if (response.status === true) {
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
