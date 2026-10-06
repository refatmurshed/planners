@extends('admin.layout')

@section('content')

<h1 class="text-2xl font-bold mb-4">Members List</h1>

<!-- 🔍 Search -->
<input type="text" placeholder="Search..." class="border p-2 mb-4 w-full rounded">

<table class="w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="p-2">Name</th>
            <th class="p-2">Email</th>
            <th class="p-2">Phone</th>
            <th class="p-2">Join Date</th>
            <th class="p-2">Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($members as $member)
        <tr class="text-center border-t">
            <td class="p-2">{{ $member->name }}</td>
            <td class="p-2">{{ $member->email }}</td>
            <td class="p-2">{{ $member->phone }}</td>
            <td class="p-2">{{ $member->joining_date }}</td>
            <td class="p-2">
                <a href="#" class="text-blue-500">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
