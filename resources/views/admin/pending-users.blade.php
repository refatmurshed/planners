<x-app-layout>
    <h1>Pending Users</h1>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
                <form method="POST" action="/admin/users/approve/{{ $user->id }}">
                    @csrf
                    <button type="submit">Approve</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</x-app-layout>
