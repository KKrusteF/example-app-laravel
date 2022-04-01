@props(['comment'])

<x-panel class="bg-gray-100">
    <article class="flex space-x-4">
        <div style="flex-shrink: 0">
            <img src="{{ asset('storage/' . $comment->author->avatar ) }}"  alt="{{ $comment->author }}" width="60" height="60" class="rounded-full">
        </div>

        <div>
            <header class="mb-4">
                <h3 class="font-bold">{{ $comment->author->username }}</h3>
                <p class="text-xs">

                    Posted on
                    <time>{{ $comment->created_at->format('F j, Y, g:i a') }}</time>
                </p>
            </header>

            <p>
                {{ $comment->body }}
            </p>
        </div>
    </article>
</x-panel>
