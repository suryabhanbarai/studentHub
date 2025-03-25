<?php

namespace App\Interfaces;

use App\Models\School;
use Illuminate\Http\Request;

interface SchoolRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(Request $request);
    public function update(School $school, Request $request);
    public function delete(School $school);
    public function getRelatedData();
    public function getSchoolsByLoginId($loginId);
}
