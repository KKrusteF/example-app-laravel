@props(['heading'])

<section class="py-8 max-w-4xl mx-auto">
    <h1 class="text-lg font-bold mb-8 pb-2 border-b">
        {{ $heading }}
    </h1>

    <div class="flex">
        <aside class="w-48 flex-shrink-0">
            <h4 class="font-semibold mb-4">Links</h4>
            <ul>
                @admin
                    <li>
                        <a href="/admin/posts" class="{{ request()->is('admin/posts') ? 'text-blue-500' : '' }}">All
                            Posts</a>
                    </li>
                    <li>
                        <a href="/admin/posts/create"
                           class="{{ request()->is('admin/posts/create') ? 'text-blue-500' : '' }}">New Post</a>
                    </li>
                @else
                    <li>
                        <a href="/user/{{ auth()->user()->id }}/posts"
                           class="{{ request()->is('user/2/posts') ? 'text-blue-500' : '' }}">All
                            Posts</a>
                    </li>
                    <li>
                        <a href="/user/posts/create"
                           class="{{ request()->is('user/posts/create') ? 'text-blue-500' : '' }}">New Post</a>
                    </li>
                @endcan
            </ul>
        </aside>

        <main class="flex-1">
            <x-panel>
                {{ $slot }}
            </x-panel>
        </main>
    </div>
</section>
