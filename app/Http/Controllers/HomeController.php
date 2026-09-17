<?php

namespace App\Http\Controllers;

use App\Services\NaiveBayesService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(NaiveBayesService $service)
    {
        $stat = $service->getStats();
        $siap = $stat['model'] > 0;
        return view('home.index', compact('stat', 'siap'));
    }
}
