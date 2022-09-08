<?php

namespace App\Http\Controllers;

use App\Services\CClass\CClassGetService;
use App\Services\Journal\JournalGetService;
use App\Services\Journal\JournalPostService;
use Illuminate\Http\Request;

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
            $subjects = $service->findAll($class->pack_id, $class_id);

        return response()->json($subjects);
    }

    public function store(Request $request)
    {
        $service = new JournalPostService();
        $result = $service->createOrUpdate($request->json()->all());

        return response()->json($result);
    }

    public function find($class_id, $subject_id)
    {
        $service = new JournalGetService();
        $result = $service->findByClassAndSubject($class_id, $subject_id);

        return response()->json($result);
    }
}
