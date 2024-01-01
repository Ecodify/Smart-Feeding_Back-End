<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\DevicesSensors;
use Illuminate\Http\Request;
use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Spatie\FlareClient\Api;

class DevicesSensorsController extends Controller
{
    public function add(Request $request)
    {
        try{
            $data = [
                '' => '',
            ];

            return ApiHelpers::success($data, '');
        } catch (Exception $e) {
            return ApiHelpers::error($e, 'Terjadi Kesalahan');
        }
    }

    public function data()
    {
        try{
            $allData = DevicesSensors::all();

            $data = [
                'data' => $allData,
            ];

            return ApiHelpers::success($allData, '');
        } catch (Exception $e) {
            return ApiHelpers::error($e, 'Terjadi Kesalahan');
        }
    }

    public function current(Request $request)
    {
        try {
            $lastData = DevicesSensors::latest('id')->first();

            $data = [
                'last_data' => $lastData,
            ];

            return ApiHelpers::success($lastData, '');
        } catch (Exception $e) {
            return ApiHelpers::error($e, 'Terjadi Kesalahan');
        }
    }
}
