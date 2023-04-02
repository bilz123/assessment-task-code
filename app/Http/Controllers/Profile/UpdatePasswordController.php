<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UpdatePasswordController extends Controller
{
    public function edit()
    {
        return view('profile.password-modal');
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return $this->jsonResponse($validator, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

            DB::beginTransaction();

            if (!(Hash::check($request->get('old_password'), auth()->user()->password))) {
                return $this->jsonResponse([
                    'old_password' => ['The provided old password is incorrect.']
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

            auth()->user()->update([
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            return $this->jsonResponse('Password updated successfully.', JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse($e->getMessage(), $e->getCode());
        }
    }
}
