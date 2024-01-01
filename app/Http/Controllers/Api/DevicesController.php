<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ApiHelpers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Spatie\FlareClient\Api;

class DevicesController extends Controller
{
    public function register(Request $request)
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
        try{

            $data = [
                '' => '',
            ];

            return ApiHelpers::success($data, '');
        } catch (Exception $e) {
            return ApiHelpers::error($e, 'Terjadi Kesalahan');
        }
    }

    public function details()
    {
        try{

            $data = [
                'name' => '',
                'category' => '',
                'population' => '',
                'status' => '',
            ];

            return ApiHelpers::success($data, 'Ini adalah Detail Devices!');
        } catch (Exception $e) {
            return ApiHelpers::error($e, 'Terjadi Kesalahan');
        }
    }

    public function sensor(Request $request)
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
}
