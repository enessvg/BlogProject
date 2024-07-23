@include('inc/navbar')

<div class="container mx-auto mt-5">

    <h2 class="text-3xl font-bold mt-10 mb-5 text-center">Categories</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 p-4 lg:grid-cols-6 gap-4 m-135">
        @foreach ($allCategory as $category)
            <a href="/category/{{ $category['slug'] }}">
                <div class="flex-auto flex justify-center font-bold category-box">{{ $category['name'] }}</div>
            </a>
        @endforeach
    </div>

    <h2 class="text-3xl font-bold mt-10 mb-5 text-center">Popular Posts</h2>
    @include('post/popular-post', ['post' => $popularPosts])

    <h2 class="text-3xl font-bold mb-5 text-center">All Posts</h2>
    @include('post/all-post', ['post' => $allPosts])


</div>
@include('inc/footer')
