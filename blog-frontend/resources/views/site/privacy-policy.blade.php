@include('inc.navbar')

<div class="container mx-auto mt-30">
<div class="p-5">
    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white text-center">{{ $privacy_policy['title'] }}</h1>
    <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">{{ $privacy_policy['description'] }}</p>
</div>
</div>


@include('inc.footer')
