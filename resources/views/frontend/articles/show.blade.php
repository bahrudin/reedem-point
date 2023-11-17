<x-app-layout title="{{ $title ?? '' }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-8 bg-light">
                <div class="mt-2"><h4>{{ $title }}</h4></div>
                <h1>{{ $article->title }}</h1>
                <p>{{ $article->contents }}</p>

                <div class="row py-5">
                    <b>Details Row Data</b>
                    <div class="mt-3">
                        <ol class="list-group list-group-flush">
                            <div class="fw-bold text-primary">Article</div>
                            <li class="list-group-item">ID-Atikel : <i class="text-danger">{{ $article->id }}</i></li>
                            <li class="list-group-item">ID-Program : <i class="text-danger">{{ $article->program_id }}</i></li>
                            <li class="list-group-item">ID-Point : <i class="text-danger">{{ $article->point_id }}</i></li>
                            <li class="list-group-item">Slug : <i class="text-danger">{{ $article->slug }}</i></li>
                        </ol>
                        <ol class="list-group list-group-flush">
                            <div class="fw-bold text-primary">Relasi to Program <i class="text-muted" style="font-size: 12px">Bisa digunakan ke table-product, table-promo dan lain-lain</i></div>
                            <li class="list-group-item">ID-Program : <i class="text-danger">{{ $article->program->id }}</i></li>
                            <li class="list-group-item">Nama Program : <i class="text-danger">{{ $article->program->name }}</i></li>
                        </ol>
                        <ol class="list-group list-group-flush">
                            <div class="fw-bold text-primary">Relasi Point to Program</div>
                            <li class="list-group-item">ID-Program : <i class="text-danger">{{ $article->program->id }}</i></li>
                            <li class="list-group-item">ID-Point : <i class="text-danger">{{ $article->program->points->first()->id }}</i></li>
                            <li class="list-group-item">Point Type : <i class="text-danger">{{ $article->program->points->first()->point_type }}</i></li>
                            <li class="list-group-item">Amount (Jumlah point yang diberikan) :<i class="text-danger"> {{ $article->program->points->first()->amount }}</i></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-4">
                <div class="mt-2"><h4>Member</h4></div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script type="module">
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let pointType = "{{ $typePoint }}";

                function sendData() {
                    let userId = {{ \Illuminate\Support\Facades\Auth::id() }};
                    let articleId = "{{ $article->id }}";
                    let slugs = "{{ $article->slug }}";
                    let programId = "{{ $article->program_id }}";
                    let pointId = "{{ $article->point_id }}";
                    let amount = "{{ $article->program->points->first()->amount }}";

                    $.ajax({
                        url: '/api/record-read-time',
                        type: 'POST',
                        data: {
                            user_id: userId,
                            article_id: articleId,
                            program_id: programId,
                            point_id: pointId,
                            amount: amount,
                            slug: slugs,
                        },
                        success: function (response) {
                            console.log('Data terkirim', response);
                        },
                        error: function (error) {
                            console.error('Gagal mengirim data', error);
                        }
                    });
                }

                if (pointType === 'one_time') {
                    sendData();
                } else if (pointType === 'multiple') {
                    // Set interval 15 detik
                    setInterval(function () {
                        sendData();
                    }, 15000); // 15 detik
                }
            });
        </script>
    @endpush
</x-app-layout>
