<div class="bg-white dark:bg-neutral-800 rounded-xl p-6 shadow-md">
    <h2 class="text-2xl font-bold mb-4">🏆 All-Time Ranking</h2>
    <table class="min-w-full">
        <thead>
        <tr>
            <th class="text-left p-2">User</th>
            <th class="text-left p-2">Likes</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td class="p-2 max-w-xs whitespace-nowrap overflow-hidden text-ellipsis align-middle">
                    <img
                        src="{{ $user->profile_photo_path }}"
                        alt="Avatar"
                        class="rounded-full w-12 h-12 object-cover shadow inline-block mr-2"
                    >
                    {{ $user->name }}
                </td>
                <td class="p-2">
                    {{ $user->received_likes_count }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
