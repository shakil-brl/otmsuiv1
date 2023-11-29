<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function index()
    {
        return view('admins.index');
    }

    public function dashboard()
    {

        $app_url = Str::finish(config('app.api_url'), '/');

        $response = Http::withHeaders([
            'Authorization' => Session::get('tokenType') . Session::get('accessToken'),
        ])->get($app_url . 'dashboard/summery');
        $data = $response->json();
        if (isset($data['success'])) {
            if ($data['success'] !== true) {
                abort(403, 'Unauthorized');
            }
        } else {
            if (isset($data['message'])) {
                return $data['message'];
            } else {
                return "API Server Error";
            }
        }

        return view('admins.dashboard', $data['data']);
    }

    public function profile()
    {
        return view('admins.profile');
    }

    public function show($userProfileId)
    {
        return view('admins.show', compact('userProfileId'));
    }
}
