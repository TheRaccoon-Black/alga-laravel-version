<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\NaiveBayesService;

class EvaluationController extends Controller
{
    public function index(NaiveBayesService $service)
    {
        $model = $service->buildModel();
        if (empty($model['prior'])) {
            return view('admin.evaluation', ['model' => [], 'errorMessage' => 'Model belum dilatih. Silakan lakukan Latih Model terlebih dahulu.']);
        }

        $result = $service->evaluate();
        return view('admin.evaluation', $result);
    }
}
