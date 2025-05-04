<article id="{{ $post->id }}" class="flex max-w-xl flex-col items-start justify-between">
    <!-- Cover Image -->
    <img src="{{ asset($post->cover) }}" alt="Cover Image" class="w-full rounded-lg object-cover max-h-64">

    <div class="flex items-center gap-x-4 text-xs mt-4">
        <time datetime="2020-03-16" class="text-gray-500">Mar 16, 2020</time>
        <a href="#" class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100">{{ $post->category->name }}</a>
    </div>

    <div class="group relative">
        <h3 class="mt-3 text-lg/6 font-semibold text-gray-900 group-hover:text-gray-600">
            <a href="#">
                <span class="absolute inset-0"></span>
                {{ $post->title }}
            </a>
        </h3>
        <p class="mt-5 line-clamp-3 text-sm/6 text-gray-600">{{ $post->content }}</p>
    </div>

    <div class="relative mt-8 flex items-center gap-x-4">
        <img src="{{ asset($post->author->avatar) }}" alt="" class="size-10 rounded-full bg-gray-50">
        <div class="text-sm/6">
            <p class="font-semibold text-gray-900">
                <a href="#">
                    <span class="absolute inset-0"></span>
                    {{ $post->author->name }}
                </a>
            </p>
            <p class="text-gray-600">Co-Founder / CTO</p>
        </div>
    </div>
</article>