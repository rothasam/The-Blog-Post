@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded-2xl shadow-md  mx-auto w-[90%] mt-10">
    <!-- Header -->
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-xl font-semibold flex items-center gap-2">
            List All Users
        </h2>
        <a href="#" class="bg-indigo-500 hover:bg-indigo-600 text-white text-sm px-4 py-2 rounded-lg flex items-center gap-1 shadow">
            ➕ Add User
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-xl shadow-sm">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700 font-medium">
                <tr>
                    <th class="py-3 px-4">#</th>
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Email</th>
                    <th class="py-3 px-4">Role</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="py-3 px-4">{{ $user->user_id }}</td>
                    <td class="py-3 px-4 font-medium text-gray-800">{{ $user->first_name . ' ' . $user->last_name }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $user->email }}</td>
                    <td class="py-3 px-4 capitalize">{{ $user->roles->name }}</td>
                    <td class="py-3 px-4">
                        @if($user->status === 'active')
                            <span class="inline-block px-2 py-1 text-green-700 bg-green-100 rounded-full text-xs font-medium">Active</span>
                        @else
                            <span class="inline-block px-2 py-1 text-red-700 bg-red-100 rounded-full text-xs font-medium">Inactive</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-right">
                        <div class="flex justify-end gap-2">
                            <a href=""
                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1.5 rounded-lg text-xs font-medium shadow">
                                ✏️ Edit
                            </a>
                            <form action="" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs font-medium shadow">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection