<?php

namespace App\Http\Controllers\Grade;

use App\Http\Controllers\Controller;
use App\Http\Requests\grade\GradeRequest;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grades = Grade::query()->get();
        return view('general.grade.create', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = Grade::query()->get();
        return view('general.grade.create', compact('grades'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeRequest $request)
    {
        Grade::create($request->validated());
        return redirect()->route('grade.index')->with('success', 'Grade created successfully!');
    }
    /**
     * Display the specified resource.
     */

    public function show(Grade $grade)
    {
        return view('general.grade.show', compact('grade'));
    }

    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $grades = Grade::all();
        return view('general.grade.create', compact('grade','grades'));
    }

    public function update(GradeRequest $request, Grade $grade)
    {
        $grade->update($request->validated());
        return redirect()->route('grade.index')->with('success', 'Grade updated successfully!');
    }

    public function destroy($id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return redirect()->back()->with('success', 'Grade deleted successfully!');
    }
}
