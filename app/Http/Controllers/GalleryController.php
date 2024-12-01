<?php

namespace App\Http\Controllers;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::all();
        return view('general.gallary.index', compact('galleries'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('general.gallary.index');
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'file' => 'required|file|mimes:jpg,png,jpeg|max:2048',
    ]);

    // رفع الملف
    $filePath = $request->file('file')->store('uploads', 'public');

    // إنشاء السجل
    Gallery::create([
        'title' => $request->title,
        'file' => $filePath,
    ]);

    return redirect()->route('gallery.index')->with('success', 'Gallery item created successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
{
    return view('general.gallary.index', compact('gallery'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        // تحديث البيانات
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
            $gallery->update([
                'title' => $request->title,
                'file' => $filePath,
            ]);
        } else {
            $gallery->update([
                'title' => $request->title,
            ]);
        }
    
        return redirect()->route('gallery.index')->with('success', 'Gallery item updated successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('gallery.index')->with('success', 'Gallery item deleted successfully!');
    }
    
}
