<x-guestLayout>
    <div class="max-w-7xl flex-col mx-auto my-6 space-y-6 p-2">
        <h1 class="font-bold text-2xl">{!! $post->title !!}</h1>
        <p class="leading-6">
            {!! $post->body !!}
        </p>
        <a href="/">
            <button class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded-md 
            font-extrabold text-base uppercas">Go Back</button>
        </a>

    </div>
</x-guestLayout>