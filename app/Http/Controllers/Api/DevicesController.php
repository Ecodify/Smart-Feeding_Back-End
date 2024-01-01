<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Devices;
use Illuminate\Http\Request;
use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\FlareClient\Api;

class DevicesController extends Controller
{
    public function register(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:125',
                'category' => 'required|string|max:125',
                'population'=> 'required|string|max:125',
                'status' => 'required|string|max:125',
                'dht' => 'required|boolean',
                'relay' => 'required|boolean',
                'mq' => 'required|boolean'
            ]);

            if($validator->fails())
            {
                return ApiHelpers::error($validator->errors(), 'Ada data yang tidak valid!');
            }

            $validated = $validator->validated();

            $existingDevice = Devices::where('name', $validated['name'])->first();

            if ($existingDevice) {
                return ApiHelpers::error([], 'Device dengan nama tersebut sudah terdaftar!', 400);
            }

            Devices::create($validated);
            event(new Registered($validated));

            $devices = Devices::where('name', $validated['name'])->first();
            $token = $devices->createToken('authToken')->plainTextToken;

            $data = [
                'access_token' => "Bearer $token",
                'devices' => $devices
            ];

            return ApiHelpers::success($data, 'Berhasil Mendaftarkan Device Baru!');
        } catch (Exception $e) {
            return ApiHelpers::error($e, 'Terjadi Kesalahan');
        }
    }

    public function renew(Request $request)
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


    public function update(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return ApiHelpers::error([], 'Unauthorized', 401);
            }

            $validator = Validator::make($request->all(), [
                'dht' => 'required|boolean',
                'relay' => 'required|boolean',
                'mq' => 'required|boolean'
            ]);

            if ($validator->fails()) {
                return ApiHelpers::error($validator->errors(), 'Ada data yang tidak valid!');
            }

            $validated = $validator->validated();

            $device = Devices::where('id', $user->id)->first();

            if (!$device) {
                return ApiHelpers::error([], 'Device tidak ditemukan atau tidak memiliki izin!', 404);
            }

            $device->update([
                'dht' => $validated['dht'],
                'relay' => $validated['relay'],
                'mq' => $validated['mq']
            ]);

            return ApiHelpers::success($device, 'Berhasil Memperbarui Sensor');
        } catch (Exception $e) {
            return ApiHelpers::error($e, 'Terjadi Kesalahan');
        }
    }

    public function details(Request $request)
    {
        try{
            $devices = Auth::user();

            $data = [
                'name' => $devices->name,
                'category' => $devices->category,
                'population' => $devices->population,
                'status' =>  $devices->status
            ];

            return ApiHelpers::success($data, 'Ini adalah Detail Devices!');
        } catch (Exception $e) {
            return ApiHelpers::error($e, 'Terjadi Kesalahan');
        }
    }

    public function sensor(Request $request)
    {
        try{
            $devices = Auth::user();

            $data = [
                'dht' => $devices->dht,
                'relay' => $devices->relay,
                'mq' => $devices->mq
            ];

            return ApiHelpers::success($data, 'Ini adalah Detail Devices!');
        } catch (Exception $e) {
            return ApiHelpers::error($e, 'Terjadi Kesalahan');
        }
    }
}
