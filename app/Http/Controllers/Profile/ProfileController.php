<?php

namespace App\Http\Controllers\Profile;

use App\Models\User;
use App\Models\OpeningHour;
use Stripe\StripeClient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\DatabaseManager;

class ProfileController extends Controller
{
    protected StripeClient $stripeClient;
    protected DatabaseManager $databaseManager;

    public function __construct(StripeClient $stripeClient, DatabaseManager $databaseManager)
    {
        $this->stripeClient = $stripeClient;
        $this->databaseManager = $databaseManager;
    }

    public function index()
    {        
        $seller = auth()->user();

        $balance = $seller->completed_stripe_onboarding
            ? $this->stripeClient
                ->balance->retrieve(null, ['stripe_account' => $seller->stripe_connect_id])
                ->available[0]
                ->amount
            : 0;
        $openingHoursCount = OpeningHour::whereVendorId(auth()->user()->id)->count();
        $openingHours = OpeningHour::whereVendorId(auth()->user()->id)->get();
      
        return view('profile.index', [
            'seller'  => $seller,
            'balance' => currency($balance, false),
            'openingHoursCount' =>$openingHoursCount,
            'openingHours' =>$openingHours
        ]);
    }

    public function edit()
    {
        return view('profile.modal');
    }

    public function update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'phone' => 'required',
                'alt_phone' => 'nullable',
                'address' => 'nullable',
                'description' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->jsonResponse($validator, JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

            DB::beginTransaction();

            auth()->user()->update($request->only([
                'name',
                'phone',
                'alt_phone',
                'address',
                'description',
            ]));

            DB::commit();

            return $this->jsonResponse([
                'message' => 'Profile updated successfully.',
                'params' => [
                    'name' => auth()->user()->name,
                    'phone' => auth()->user()->phone,
                    'alt_phone' => auth()->user()->alt_phone,
                    'address' => auth()->user()->address,
                    'description' => auth()->user()->description,
                ]
            ], JsonResponse::HTTP_OK);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse($e->getMessage(), $e->getCode());
        }
    }
}
