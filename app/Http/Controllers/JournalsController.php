<?php

namespace App\Http\Controllers;

use App\Services\CClass\CClassGetService;
use App\Services\Journal\JournalGetService;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\MagicConst\Class_;

class JournalsController extends Controller
{
    public function index(Request $request, $class_id) 
    {
        $classService = new CClassGetService();
        $class = $classService->find($class_id);

        $service = new JournalGetService();

        if($request->has('filters'))
            $subjects = $service->search($request->get('filters'), $class->pack_id);
        else
            $subjects = $service->findAll($class->pack_id);

        return response()->json($subjects);
    }
}
