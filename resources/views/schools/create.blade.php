@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow-md">
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Add New School</h2>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            <strong>Whoops! Something went wrong.</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Starts Here -->
    <form action="{{ route('schools.store') }}" method="POST">
        @csrf

        <!-- School Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">School Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" 
                   class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <!-- City -->
        <div class="mb-4">
            <label for="city" class="block text-gray-700 font-semibold mb-2">City:</label>
            <input type="text" name="city" id="city" value="{{ old('city') }}" 
                   class="w-full border border-gray-300 px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <!-- Submit Button -->
        <div class="flex justify-between items-center">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Add School
            </button>
            <a href="{{ route('schools.index') }}" class="text-gray-600 hover:underline">Back to List</a>
        </div>
    </form>
</div>
@endsection
