@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Edit School</h2>

    <!-- Form for updating school details -->
    <form action="{{ route('schools.update', $school->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- School Name -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">School Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $school->name) }}" 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- City -->
        <div class="mb-4">
            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
            <input type="text" name="city" id="city" value="{{ old('city', $school->city) }}" 
                   class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            @error('city')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="mt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Update School
            </button>
            <a href="{{ route('schools.index') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
