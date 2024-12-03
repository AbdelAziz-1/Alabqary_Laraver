@extends('layouts.vertical', ['title' => 'عرض الدورة'])

@section('css')
@vite(['node_modules/choices.js/public/assets/styles/choices.min.css'])
@endsection

@section('content')
<div class="row" dir="rtl">
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $course->title }}</h4>
            </div>
            <div class="card-body">
                <!-- Display course image -->
                @if($course->image)
                    <div class="mb-3 col-4">
                        <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image" class="img-thumbnail" width="300">
                    </div>
                @endif

                <!-- Display course notes -->
                <div class="mb-3 col-6">
                    <h5>ملاحظات:</h5>
                    <p>{{ $course->note }}</p>
                </div>

                <!-- Display related videos -->
                <div class="mb-3">
                    <h5>الفيديوهات:</h5>
                    @if($course->videos->isNotEmpty())
                        <div class="row">
                            @foreach($course->videos as $video)
                                <div class="col-lg-4 mb-3">
                                    <video width="100%" controls>
                                        <source src="{{ asset('storage/' . $video->video_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>لا توجد فيديوهات مرفوعة لهذه الدورة.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
