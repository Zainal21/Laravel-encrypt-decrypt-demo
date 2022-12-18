<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\EncryptService;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Validator;

class EncryptController extends Controller
{
    public function __construct(
        public EncryptService $encryptService
    )
    {}

    public function encrypt(Request $request)
    {
        try {
            $encrypt = $this->encryptService->encrypt($request);
            return response()->json([
                'result' => $encrypted,
                'statusCode' => 200
            ], 200);
        } catch (Exception $th) {
            return response()->json([
                'result' => $th->getMessage(),
                'statusCode' => 400
            ], 400);
        }
        
       
    }

    public function decrypt(Request $request)
    {
        $ncryper = new Encrypter(config('app.key'));
    
        $encrypted = $request->string_descrypt_key;

        $decrypted = $encrypter->decrypt($encrypted);

        return $decrypted;
    }
}
