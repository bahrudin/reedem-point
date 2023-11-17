<x-app-layout title="{{ $title ?? '' }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-11 bg-light">
                <div class="mt-2"><h4>{{ $title }}</h4></div>
                @foreach($articles as $article)
                    <div class="card my-2">
                        <div class="card-body">
                            <h5 class="card-title"><a
                                    href="{{ route('articles.clickPoint',['slug'=>$article->slug]) }}">{{ $article->title }}</a>
                            </h5>
                            <p class="card-text">{{ $article->content }}</p>
                        </div>
                    </div>
                @endforeach
                {!! $articles->withQueryString()->links('pagination::bootstrap-5') !!}
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
