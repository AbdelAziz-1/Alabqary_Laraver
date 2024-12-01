<?php
namespace App\Http\Controllers\subject;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\SubjectRequest;
use App\Models\Grade;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Subjects = Subject::with('grade')->get();
        $grades = Grade::query()->get();
        return view('general.subjects.create', compact('Subjects','grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Subjects = Subject::query()->get();
        return view('general.subjects.create', compact('Subjects'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        Subject::create($request->validated());
        return redirect()->route('subject.index')->with('success', 'Subject created successfully!');
    }
    /**
     * Display the specified resource.
     */

    public function edit($id)
    {
        $Subject = Subject::with('grade')->findOrFail($id);
        $Subjects = Subject::all();
        return view('general.subjects.create', compact('Subject','Subjects'));
    }

    public function update(SubjectRequest $request, Subject $Subject)
    {
        $Subject->update($request->validated());
        return redirect()->route('subject.index')->with('success', 'Subject updated successfully!');
    }

    public function destroy($id)
    {
        $Subject = Subject::findOrFail($id);
        $Subject->delete();

        return redirect()->back()->with('success', 'Subject deleted successfully!');
    }
}
