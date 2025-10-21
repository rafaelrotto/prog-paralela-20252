<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\DisciplineService;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    public function __construct(private readonly DisciplineService $disciplineService) {}

    public function index(Request $request)
    {
        return $this->disciplineService->index($request->all());
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['company_id'] = auth()->user()->company_id;

        return $this->disciplineService->store($data);
    }

    public function show(string $id)
    {
        return $this->disciplineService->show($id);
    }

    public function update(Request $request, string $id)
    {
        return $this->disciplineService->update($request->all(), $id);
    }

    public function destroy(string $id)
    {
        $this->disciplineService->destroy($id);

        return response()->noContent();
    }
}
