<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Level;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {   
        $levels = Level::where('status','active')->get();
        $lessons = Lesson::where('status','active')->get();
        $colors = ['#ff7c9d','#e9c00a','#69c03a','#6e9ce0','#bd4af3'];
        return view('home',compact('levels','lessons','colors'));
    }
}
