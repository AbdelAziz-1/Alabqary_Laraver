<?php
namespace App\Http\Controllers\Courses;

use App\Models\courses;
use App\Models\courses_video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\courses\CourseRequest;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = courses::with('videos')->get();
        return view('general.courses.create', compact('courses'));
    }

    public function create()
    {
        return view('general.courses.create');
    }

    public function store(CourseRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('course_images', 'public');
        }
        $course = courses::create($data);
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $path = $video->store('course_videos', 'public'); 
                courses_video::create([
                    'course_id' => $course->id,
                    'video_path' => $path, 
                ]);
            }
        }
        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    public function show($id)
    {
        $course = courses::with('videos')->findOrFail($id);
        return view('general.courses.show', compact('course'));
    }

    public function edit($id)
    {
        $course = courses::findOrFail($id);
        return view('general.courses.create', compact('course'));
    }

    public function update(CourseRequest $request, $id)
    {
        $course = courses::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('course_images', 'public');
        }

        $course->update($data);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    public function destroy($id)
    {
        $course = courses::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}