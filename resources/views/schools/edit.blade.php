@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow-md">
    <h2 class="text-2xl font-semibold mb-4">Edit School</h2>

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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-9">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('schools.update', $school) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- School Name -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('School Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $school->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- School Address -->
                        <div class="mt-4">
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $school->address)" required />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- State -->
                        <div class="mt-4">
                            <x-input-label for="state_id" :value="__('State')" />
                            <select id="state_id" name="state_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" required>
                                <option value="">Select State</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}" {{ $school->state_id == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('state_id')" class="mt-2" />
                        </div>

                        <!-- District -->
                        <div class="mt-4">
                            <x-input-label for="district_id" :value="__('District')" />
                            <select id="district_id" name="district_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" required>
                                <option value="">Select District</option>
                                @foreach ($districts as $district)
                                    <option value="{{ $district->id }}" {{ $school->district_id == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('district_id')" class="mt-2" />
                        </div>

                        <!-- City -->
                        <div class="mt-4">
                            <x-input-label for="city_id" :value="__('City / Village')" />
                            <select id="city_id" name="city_id" class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm" required>
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ $school->city_id == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
                        </div>

                        <!-- Establishment Date -->
                        <div class="mt-4">
                            <x-input-label for="establishment_date" :value="__('Establishment Date')" />
                            <x-text-input id="establishment_date" name="establishment_date" type="date" class="mt-1 block w-full" :value="old('establishment_date', $school->establishment_date)" required />
                            <x-input-error :messages="$errors->get('establishment_date')" class="mt-2" />
                        </div>

                        <!-- Contact Number -->
                        <div class="mt-4">
                            <x-input-label for="contact_number" :value="__('Contact Number')" />
                            <x-text-input id="contact_number" name="contact_number" type="text" class="mt-1 block w-full" :value="old('contact_number', $school->contact_number)" required />
                            <x-input-error :messages="$errors->get('contact_number')" class="mt-2" />
                        </div>

                        <!-- Photos -->
                        <div class="mt-4">
                            <x-input-label for="photos" :value="__('School Photos')" />
                            <input id="photos" name="photos[]" type="file" multiple class="mt-1 block w-full" accept="image/*" onchange="previewImages(event)" />
                            <x-input-error :messages="$errors->get('photos.*')" class="mt-2" />
                            <div class="mt-2">
                                @foreach ($school->photos as $photo)
                                    <img src="{{ Storage::url($photo->photo_path) }}" alt="School Photo" class="w-20 h-20 inline-block mr-2">
                                @endforeach
                                <div id="imagePreview" class="mt-4 flex flex-wrap gap-2"></div>
                            </div>
                        </div>

                        <div class="mt-6">
                                <x-primary-button>{{ __('Update School') }}</x-primary-button>
                        </div>
                        <!-- Students -->
                        <div class="mt-4" id="students">
                            <x-input-label :value="__('Students')" />
                            @foreach ($school->students as $index => $student)
                                <div class="student-row mt-2 flex items-center space-x-4">
                                    <input type="text" name="students[{{ $index }}][name]" value="{{ $student->name }}" placeholder="Student Name" class="border-gray-300 rounded-md" required>
                                    <select name="students[{{ $index }}][standard_id]" class="border-gray-300 rounded-md" required>
                                        @foreach ($standards as $standard)
                                            <option value="{{ $standard->id }}" {{ $student->standard_id == $standard->id ? 'selected' : '' }}>
                                                {{ $standard->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div>
                                        <label><input type="radio" name="students[{{ $index }}][gender]" value="male" {{ $student->gender == 'male' ? 'checked' : '' }} required> Male</label>
                                        <label><input type="radio" name="students[{{ $index }}][gender]" value="female" {{ $student->gender == 'female' ? 'checked' : '' }}> Female</label>
                                        <label><input type="radio" name="students[{{ $index }}][gender]" value="other" {{ $student->gender == 'other' ? 'checked' : '' }}> Other</label>
                                    </div>
                                    <input type="number" name="students[{{ $index }}][year]" value="{{ $student->year }}" class="border-gray-300 rounded-md" required>
                                    <img src="{{ Storage::url($student->photo_path) }}" alt="Student Photo" class="w-20 h-20 inline-block mr-2">
                                </div>
                            @endforeach
                            <x-input-error :messages="$errors->get('students.*')" class="mt-2" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    
<script>


    function previewImages(event) {
            const previewContainer = document.getElementById('imagePreview');
            previewContainer.innerHTML = ''; // Clear previous previews

            for (const file of event.target.files) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = "w-24 h-24 object-cover rounded border";
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        }
        // Dynamic District and City Dropdowns
        document.getElementById('state_id').addEventListener('change', function() {
            const stateId = this.value;
            if (stateId) {
                fetch(`/districts?state_id=${stateId}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        const districtSelect = document.getElementById('district_id');
                        districtSelect.innerHTML = '<option value="">Select District</option>';
                        data.forEach(district => {
                            const option = document.createElement('option');
                            option.value = district.id;
                            option.textContent = district.name;
                            districtSelect.appendChild(option);
                        });
                        // Reset city dropdown
                        document.getElementById('city_id').innerHTML = '<option value="">Select City</option>';
                    })
                    .catch(error => console.error('Error fetching districts:', error));
            } else {
                document.getElementById('district_id').innerHTML = '<option value="">Select District</option>';
                document.getElementById('city_id').innerHTML = '<option value="">Select City</option>';
            }
        });

        document.getElementById('district_id').addEventListener('change', function() {
            const districtId = this.value;
            if (districtId) {
                fetch(`/cities?district_id=${districtId}`)
                    .then(response => response.json())
                    .then(data => {
                        const citySelect = document.getElementById('city_id');
                        citySelect.innerHTML = '<option value="">Select City</option>';
                        data.forEach(city => {
                            const option = document.createElement('option');
                            option.value = city.id;
                            option.textContent = city.name;
                            citySelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error fetching cities:', error));
            } else {
                document.getElementById('city_id').innerHTML = '<option value="">Select City</option>';
            }
        });
    </script>
@endsection
