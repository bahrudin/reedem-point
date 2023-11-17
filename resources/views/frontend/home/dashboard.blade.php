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
                <div class="mt-2"><h5>WELCOME</h5></div>
            </div>
            <div class="col-lg-3 col-4 shadow-lg p-3 mb-5 bg-light">
                @include('layouts.partials.info')

            </div>
        </div>
    </div>
</x-app-layout>
