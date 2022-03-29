@props(['user', 'post'])

<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
    <a href="/{{ $user }}/posts/{{ $post }}/edit"
       class="text-blue-500 hover:text-blue-600">Edit</a>
</td>
