<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Edit profile!</h1>

                <form method="POST" action="/user/{{ $user->id }}/update" enctype="multipart/form-data" class="mt-10">
                    @csrf
                    @method('PUT')

                    <x-form.input name="name" type="name" :value="old('name', $user->name)"/>
                    <x-form.input name="username" type="username" :value="old('username', $user->username)"/>
                    <x-form.input name="current_password" type="password" autocomplete="current-password" />
                    <x-form.input name="password" type="password" autocomplete="current-password" />
<<<<<<< Updated upstream
{{--                    <x-form.input name="new password" type="password" autocomplete="current-password" />--}}
{{--                    <x-form.input name="confirm password" type="password" autocomplete="current-password" />--}}
=======
                    <x-form.input name="password_confirmation" type="password" autocomplete="current-password" />
>>>>>>> Stashed changes

                    <div class="flex mt-6">
                        <div class="flex-1">
                            <x-form.input name="avatar" type="file" :value="old('avatar', $user->avatar)"/>
                        </div>

                        <img src="{{ asset('storage/' . $user->avatar ) }}" alt="{{ $user->username }}'s avatar" class="rounded-xl ml-6"
                             width="100">
                    </div>

                    <x-form.button>Submit changes!</x-form.button>
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
