<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EncryptDecryptData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        // Decrypt incoming request data (if encrypted)
        if ($request->has('encrypted_data')) {
            $decryptedData = decrypt($request->input('encrypted_data'));
            print_r($decryptedData);
            $request->merge(json_decode($decryptedData, true)); // Assuming JSON data
        }

        // Pass the request to the next middleware/controller
        $response = $next($request);

        // Encrypt the response data
        if ($response instanceof \Illuminate\Http\JsonResponse) {
            $originalData = $response->getData(true); // Get response data as array
            $encryptedData = json_encode($originalData); // Encrypt it
            $response->setData(['encrypted_data' => $encryptedData]);
        }

        return $response;
    }
}
