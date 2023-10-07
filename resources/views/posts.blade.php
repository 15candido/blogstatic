<x-GuestLayout>
    <div class="max-w-7xl flex mx-auto my-6 gap-6 p-2">
        @foreach ($posts as $post)
        <article class="w-full flex flex-col my-6 space-y-2 p-3 bg-white shadow-md shadow-gray-300 rounded-md hover:shadow-lg
            hover:shadow-gray-400">
            <a href="/posts/{{$post->slug}}">
                <h1 class="font-bold text-2xl">{{$post->title}}</h1>
            </a>
            <p class="leading-6">{!! $post->excerpt !!}</p>
        </article>
        @endforeach
    </div>
</x-GuestLayout>