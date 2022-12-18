<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Validator;

interface EncryptServiceInterface
{
    public function encrypt(Request $request);
    public function decrypt(Request $request);
}

class EncryptService implements EncryptServiceInterface
{
    public function encrypt(Request $request)
    {
        $schema = Validator::make($request->all(), ['encrypt_string' => 'required']);

        if($schema->fails()){
             throw new Exception($schema->errors()->first());
        }
        
        $encrypter = new Encrypter(config('app.key'));

        $encrypted = $encrypter->encrypt($request->encrypt_string);

        return $encrypted;
    }

    public function decrypt(Request $request)
    {

        $schema = Validator::make($request->all(), ['encrypt_string' => 'required']);

        if($schema->fails()){
            throw new Exception($schema->errors()->first());
        }

        $decrypter = new Encrypter(config('app.key'));
    
        $encrypted = $request->decrypt_string;

        $decrypted = $decrypter->decrypt($encrypted);

        return $decrypted;
    }
}