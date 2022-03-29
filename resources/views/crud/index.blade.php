<x-layout>
    <x-setting heading="Manage Posts">
        @if(count($posts) > 0)
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="/posts/{{ $post->slug }}">
                                                        {{ $post->title }}
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        @admin
                                            <x-update-button user="admin" post="{{ $post->id }}"/>
                                            <x-delete-button user="admin" post="{{ $post->id }}"/>
                                        @else
                                            <x-update-button user="user" post="{{ $post->id }}"/>
                                            <x-delete-button user="user" post="{{ $post->id }}"/>
                                        @endadmin
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $posts->links() }}
                        @else
                            <h2>You do not have any posts.</h2>
                            <hr>
                            <h3><a href="/user/posts/create" class="text-blue-500">Click here</a> to create a post!</h3>
                    </div>
                </div>
            </div>
        @endif
    </x-setting>
</x-layout>
