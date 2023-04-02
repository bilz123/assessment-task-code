<?php

namespace App\Http\Controllers\Profile;

use Stripe\StripeClient;
use Illuminate\Support\Str;
use App\Models\StripeStateToken;
use App\Http\Controllers\Controller;

class StripeController extends Controller
{
    protected StripeClient $stripeClient;

    public function __construct(StripeClient $stripeClient)
    {
        $this->stripeClient = $stripeClient;
    }

    public function index()
    {
        try {
            $vendor = auth()->user();

            if ($vendor->completed_stripe_onboarding) {
                $loginLink = $this->stripeClient->accounts->createLoginLink($vendor->stripe_connect_id);

                return redirect($loginLink->url);
            }

            // create stripe connect id, if the auth user doesn't have one
            if (empty($vendor->stripe_connect_id)) {
                $account = $this->stripeClient->accounts->create([
                    'country' => 'US',
                    'type' => 'express',
                    'email' => $vendor->email,
                ]);

                $vendor->update(['stripe_connect_id' => $account->id]);
            }

            $token = Str::random();

            StripeStateToken::updateOrcreate([
                'user_id' => $vendor->id
            ], [
                'token' => $token,
            ]);

            $onboardingLink = $this->stripeClient->accountLinks->create([
                'account' => $vendor->stripe_connect_id,
                'refresh_url' => route('profile.stripe.index'),
                'return_url' => route('profile.stripe.callback', ['token' => $token]),
                'type' => 'account_onboarding',
            ]);

            return redirect($onboardingLink->url);
        } catch (\Exception $exception) {
            return back()->withErrors(['message' => $exception->getMessage()]);
        }
    }

    public function callback($token)
    {
        $stripeToken = StripeStateToken::where([
            'user_id' => auth()->user()->id,
            'token' => $token,
        ])->first();

        if (empty($stripeToken)) abort(404);

        $stripeToken->delete();

        auth()->user()->update([
            'completed_stripe_onboarding' => true,
        ]);

        return redirect()->route('profile.index')
            ->with('success', 'You have successfully connected with your <i>Stripe Connect</i> account.');
    }
}
