<?php

namespace App\Http\Controllers;

use App\Interfaces\SchoolRepositoryInterface;
use App\Models\School;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SchoolController extends Controller
{
    protected $schoolRepository;

    public function __construct(SchoolRepositoryInterface $schoolRepository)
    {
        $this->schoolRepository = $schoolRepository;
    }

    public function index()
    {
        $schools = $this->schoolRepository->all();

        return view('schools.index', compact('schools'));
    }

    public function create()
    {
        $data = $this->schoolRepository->getRelatedData();
        return view('schools.create', $data);
    }

    public function store(Request $request)
    {
        $this->schoolRepository->create($request);
        return redirect()->route('schools.index')->with('success', 'School created successfully.');
    }

    public function show(School $school)
    {
        $school = $this->schoolRepository->find($school->id);
        return view('schools.show', compact('school'));
    }

    public function edit(School $school)
    {
        $data = $this->schoolRepository->getRelatedData();
        $school = $this->schoolRepository->find($school->id);
        $districts = \App\Models\District::where('state_id', $school->state_id)->get();
        $cities = \App\Models\City::where('district_id', $school->district_id)->get();
        return view('schools.edit', array_merge(compact('school', 'districts', 'cities'), $data));
    }

    public function update(Request $request, School $school)
    {
        $this->schoolRepository->update($school, $request);
        return redirect()->route('schools.index')->with('success', 'School updated successfully.');
    }

    public function destroy(School $school)
    {
        $this->schoolRepository->delete($school);
        return redirect()->route('schools.index')->with('success', 'School deleted successfully.');
    }

    public function exportPdf(School $school)
    {
        $school = $this->schoolRepository->find($school->id);
        $pdf = Pdf::loadView('schools.pdf', compact('school'));
        return $pdf->download('school_' . $school->id . '.pdf');
    }
}