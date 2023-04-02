<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AvatarController extends Controller
{
    public function edit()
    {
        return view('profile.avatar-modal');
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'avatar' => 'required|file|mimes:jpg,png,gif|max:1024', // 1024 KB = 1 MB
            ], [
                'avatar.size' => 'Avatar must be less then 1 MB.'
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first(), JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

            $path = uploadPublicImage(
                $request->file('avatar'),
                'thumbnails/avatars',
                auth()->user()->avatar
            );

            DB::beginTransaction();

            auth()->user()->update([
                'avatar' => $path,
            ]);

            DB::commit();

            return $this->jsonResponse([
                'message' => 'Avatar updated successfully.',
                'params' => [
                    'url' => pathToUrl($path)
                ]
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse($e->getMessage(), $e->getCode());
        }
    }
}
