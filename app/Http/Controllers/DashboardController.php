<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        return view('dashboard', [
            'totalInteressados' => $request->user()->is_admin ? User::where('is_admin', false)->count() : null,
        ]);
    }
}
