<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\SchoolRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class SchoolApiController extends Controller
{
    protected $schoolRepository;

    public function __construct(SchoolRepositoryInterface $schoolRepository)
    {
        $this->schoolRepository = $schoolRepository;
    }
    
    public function index(Request $request)
    {
        //dd($request->all());
        $rules = [
            'password' => 'required|string',
            'login_id' => 'required|integer|exists:users,id',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            // Convert errors to a numeric array
            $errorMessages = array_values($validator->errors()->all());

            return [
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $errorMessages, // Array of error messages
                'status_code' => 422 // Optionally add status code
            ];
        }
        $school = $this->schoolRepository->getSchoolsByLoginId($request->login_id);

        //dd($school);
        $user = User::where('id', $request->login_id)->first();
        if (!$school || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json($school);
    }
}
