<x-app-layout title="{{ $title ?? '' }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-8 bg-light">
                <ul>
                    <li>{{ $article->id }}</li>
                    <li>{{ $article->point_id }}</li>
                    <li>{{ $article->program->points->first()->point_type }}</li>
                </ul>
            </div>
            <div class="col-lg-3 col-4">
                <div class="mt-2"><h4>Member</h4></div>

            </div>
        </div>
    </div>

    @push('scripts')
        <script type="module">

        </script>
    @endpush
</x-app-layout>
