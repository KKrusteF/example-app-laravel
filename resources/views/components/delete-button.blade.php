@props(['user', 'post'])

<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
    <form method="POST" action="/{{ $user }}/posts/{{ $post }}">
        @csrf
        @method('DELETE')

        <button class="text-xs text-red-600">Delete</button>
    </form>
</td>
