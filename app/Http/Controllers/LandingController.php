<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class LandingController extends Controller
{
    public function index()
    {
        $posts = Project::all();
        return view('home', compact('posts'));
    }
}
