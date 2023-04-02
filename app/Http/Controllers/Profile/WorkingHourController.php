<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\OpeningHour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkingHourController extends Controller
{
   

    public function store(Request $request)
    {
        try {
      
            DB::beginTransaction();
            OpeningHour::whereVendorId(auth()->user()->id)->delete();
            $time = $request->time;
            for ($i = 1; $i <= count($time); $i++) {

                OpeningHour::create([
                    'vendor_id' => auth()->user()->id,
                    'day_of_week' => $time[$i]["day"],
                    'opens_at' => $time[$i]["opening"],
                    'closed_at' => $time[$i]["closing"],
                    'is_holiday' => array_key_exists('is_holiday', $time[$i]) ? $time[$i]["is_holiday"] : 0,
                ]);
            }
            DB::commit();
            return $this->jsonResponse(['message' => 'Working hours added succesfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse($e->getMessage(), $e->getCode());
        }
    }
}
