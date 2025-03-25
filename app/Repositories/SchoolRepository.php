<?php

namespace App\Repositories;

use App\Models\School;
use App\Models\SchoolPhoto;
use App\Models\Student;
use App\Models\State;
use App\Models\District;
use App\Models\City;
use App\Models\Standard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\SchoolRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SchoolRepository implements SchoolRepositoryInterface
{
    protected $school;
    
    public function __construct(School $school)
    {
        $this->school = $school;
    }
    public function all()
    {
        return School::simplePaginate(10);
    }

    public function find($id)
    {
        return School::with(['photos', 'students.standard', 'state', 'district', 'city'])->findOrFail($id);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'state_id' => 'required|exists:states,id',
            'district_id' => 'required|exists:districts,id',
            'city_id' => 'required|exists:cities,id',
            'establishment_date' => 'required|date',
            'contact_number' => 'required|digits:10',
            'photos.*' => 'nullable|image|max:2048',
            'students.*.name' => 'required|string|max:255',
            'students.*.standard_id' => 'required|exists:standards,id',
            'students.*.gender' => 'required|in:male,female,other',
            'students.*.year' => 'required|integer|min:2000|max:' . date('Y'),
            'students.*.photo' => 'nullable|image|max:2048',
        ]);

        // Create the school record with user_id
        $school = School::create([
            'name' => $validated['name'],
            'address' => $validated['address'],
            'state_id' => $validated['state_id'],
            'district_id' => $validated['district_id'],
            'city_id' => $validated['city_id'],
            'establishment_date' => $validated['establishment_date'],
            'contact_number' => $validated['contact_number'],
            'login_id' => Auth::id()
        ]);
        // Handle school photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('school_photos', 'public');
                SchoolPhoto::create(['school_id' => $school->id, 'photo_path' => $path]);
            }
        }

        // Handle students
        foreach ($validated['students'] as $studentData) {
            $photoPath = $studentData['photo'] ? $studentData['photo']->store('student_photos', 'public') : null;
            Student::create([
                'school_id' => $school->id,
                'name' => $studentData['name'],
                'standard_id' => $studentData['standard_id'],
                'gender' => $studentData['gender'],
                'year' => $studentData['year'],
                'photo_path' => $photoPath,
            ]);
        }

        return $school;
    }

    public function update(School $school, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'state_id' => 'required|exists:states,id',
            'district_id' => 'required|exists:districts,id',
            'city_id' => 'required|exists:cities,id',
            'establishment_date' => 'required|date',
            'contact_number' => 'required|digits:10',
            'photos.*' => 'nullable|image|max:2048',
            'students.*.name' => 'required|string|max:255',
            'students.*.standard_id' => 'required|exists:standards,id',
            'students.*.gender' => 'required|in:male,female,other',
            'students.*.year' => 'required|integer|min:2000|max:' . date('Y'),
            'students.*.photo' => 'nullable|image|max:2048',
        ]);

        $school->update($validated);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('school_photos', 'public');
                SchoolPhoto::create(['school_id' => $school->id, 'photo_path' => $path]);
            }
        }

        return $school;
    }

    public function delete(School $school)
    {
        $school->delete();
    }

    public function getRelatedData()
    {
        return [
            'states' => State::all(),
            'standards' => Standard::all(),
        ];
    }
    
    public function getSchoolsByLoginId($loginId)
    {
        return $this->school->where('login_id', $loginId)->get(); 
    }
}