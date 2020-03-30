<div id="app">
    <div class="bg-{{ config('theme.color', 'gray') }}-800 pb-32">
        <header class="py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl leading-9 font-bold text-white">
                    {{ config('app.site_name', 'Ed\'s Laravel Boilerplate') }}
                </h2>
            </div>
        </header>
    </div>
    <main class="-mt-32">
        <div class="max-w-7xl mx-auto pb-12 px-4 sm:px-6 lg:px-8">
            <!-- Replace with your content -->
            <div class="bg-white rounded-lg shadow px-5 py-6 sm:px-6">
                <div class="rounded-lg min-h-96 p-6">
                    @yield('content')
                </div>
            </div>
            <!-- /End replace -->


            @include('layouts.footers.' . config('theme.footer', 'simple_social'))




        </div>

    </main>
</div>
