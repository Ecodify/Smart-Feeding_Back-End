<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\DevicesSensors;
use Illuminate\Http\Request;
use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DevicesSensorsController extends Controller
{
    public function add(Request $request)
    {
        try {
            $devices = Auth::user();

            if (!$devices)
            {
                return ApiHelpers::error([], 'Unauthorized', 401);
            }

            $dateTime = now();

            $year = $dateTime->year;
            $month = $dateTime->month;
            $day = $dateTime->day;
            $time = $dateTime->toTimeString();

            $validated = [
                'year' => $year,
                'month' => $month,
                'day' => $day,
                'timestamp' => $time,
                'temperature' => $request->input('temperature'),
                'humidity' => $request->input('humidity'),
                'ammonia' => $request->input('ammonia'),
            ];

            $data = DevicesSensors::create($validated);

            return ApiHelpers::success($data, 'Berhasil mengirim data!');
        } catch (Exception $e) {
            return ApiHelpers::error($e, 'Terjadi Kesalahan');
        }
    }

    public function data()
    {
        try{
            $devices = Auth::user();

            if (!$devices)
            {
                return ApiHelpers::error([], 'Unauthorized', 401);
            }

            $data = DevicesSensors::all();

            return ApiHelpers::success($data, 'Berhasil mengambil seluruh data!');
        } catch (Exception $e) {
            return ApiHelpers::error($e, 'Terjadi Kesalahan');
        }
    }

    public function current()
    {
        try {
            $devices = Auth::user();

            if (!$devices) {
                return ApiHelpers::error([], 'Unauthorized', 401);
            }

            $data = DevicesSensors::latest('id')->first();

            return ApiHelpers::success($data, 'Berhasil mengambil terkini data!');
        } catch (Exception $e) {
            return ApiHelpers::error($e, 'Terjadi Kesalahan');
        }
    }
}
