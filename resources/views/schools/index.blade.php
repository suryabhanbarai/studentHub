@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">List of Schools</h1>
        
        <a href="{{ route('schools.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New School
        </a>

        <table class="table-auto w-full mt-4 border-collapse border border-gray-400">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-400 px-4 py-2">ID</th>
                    <th class="border border-gray-400 px-4 py-2">Name</th>
                    <th class="border border-gray-400 px-4 py-2">City Details</th>
                    <th class="border border-gray-400 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schools as $school)
                    <tr>
                        <td class="border border-gray-400 px-4 py-2">{{ $school->id }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $school->name }}</td>
                        <td class="border border-gray-400 px-4 py-2">{{ $school->city }}</td>
                        <td class="border border-gray-400 px-4 py-2">
                            <a href="{{ route('schools.edit', $school->id) }}" class="text-blue-500">Edit</a> | 
                            <form action="{{ route('schools.destroy', $school->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $schools->links() }}
        </div>
    </div>
@endsection
