@extends('layouts.vertical', ['title' => 'عرض الدورة'])

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $course->title }}</h4>
            </div>
            <div class="card-body">
                <!-- عرض صورة الدورة -->
                @if($course->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image" class="img-thumbnail" width="300">
                    </div>
                @endif

                <!-- عرض ملاحظات الدورة -->
                <div class="mb-3">
                    <h5>ملاحظات:</h5>
                    <p>{{ $course->note }}</p>
                </div>

                <!-- عرض الفيديوهات المرتبطة -->
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
