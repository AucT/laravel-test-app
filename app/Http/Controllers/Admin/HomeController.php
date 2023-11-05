<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $tags = [
            'title' => 'Admin Home Page',
        ];
        return view('admin.home', ['tags' => $tags]);
    }
}
