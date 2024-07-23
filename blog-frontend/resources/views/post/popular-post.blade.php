@if (empty($post)) {{-- Postun içi boşmu değilmi onu kontrol ediyorum çünkü boşsa hiçbirşey çıkmıyor uyarı vermesini sağlıyorum. --}}

    <div class="p-5 mb-5 mt-5 flex justify-center">
        <div class="danger-alert-spe flex items-center p-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Post not shared!</span>
            </div>
        </div>
    </div>

@else

    <div class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 p-5 mb-5 mt-5 flex-wrap ">
        @foreach ($post as $posts)
            <div class="custom-center">
                <div
                    class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 fixed-card">
                    <a href="post/detail/{{ $posts['slug'] }}" class="custom-center">
                        <img class="rounded-t-lg fixed-image" src="http://localhost:8181/storage/{{ $posts['image'] }}"
                            alt="" />
                    </a>
                    <div class="p-5">
                        <a href="post/detail/{{ $posts['slug'] }}">
                            <h5
                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white fixed-title">
                                {{ $posts['title'] }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 fixed-content">
                            {{ Str::limit(html_entity_decode(strip_tags($posts['content'])), 100) }}</p>
                        <a href="post/detail/{{ $posts['slug'] }}"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Read more
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endif
