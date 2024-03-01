<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Blog',
        ];
        return Inertia::render("Blog/Index", $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Add Blog',
        ];
        return Inertia::render("Blog/Add", $data);
    }

    public function create(Request $r)
    {
        dd($r->all());
    }
}
