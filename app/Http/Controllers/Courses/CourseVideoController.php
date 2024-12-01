<?php
namespace App\Http\Controllers\Courses;


use App\Models\courses_video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\courses\CourseVideoRequest;

class CourseVideoController   extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store(CourseVideoRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('course_videos', 'public');
        }

        courses_video::create($data);

        return redirect()->back()->with('success', 'Video added successfully!');
    }

    public function destroy($id)
    {
        $video = courses_video::findOrFail($id);
        $video->delete();

        return redirect()->back()->with('success', 'Video deleted successfully!');
    }
}