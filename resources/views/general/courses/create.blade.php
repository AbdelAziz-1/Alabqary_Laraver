@extends('layouts.vertical', ['title' => isset($course) ? 'تعديل الدورة' : 'انشاء دورة جديدة'])

@section('css')

@vite(['node_modules/choices.js/public/assets/styles/choices.min.css'])
@endsection

@section('content')
<div class="row" dir="rtl">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="col-xl-12 col-lg-12">
        <form action="{{ isset($course) ? route('courses.update', $course->id) : route('courses.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($course))
            @method('PUT')
            @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($courses) ? 'تعديل الدورات' : 'انشاء دورة جديدة' }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">عنوان الدورة</label>
                                <input type="text" id="title" name="title" class="form-control"
                                    placeholder="Enter course title" value="{{ old('title', $course->title ?? '') }}"
                                    required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="image" class="form-label">صورة الدورة</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                                @if(isset($course->image))
                                <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image" width="100"
                                    class="mt-2">
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="note" class="form-label">الملاحظات</label>
                                <textarea name="note" class="form-control" id="note"
                                    placeholder="Add notes...">{{ old('note', $course->note ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Multiple Video Inputs -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="videos" class="form-label">فيديو الدورة</label>
                                <div id="videos-container">
                                    <div class="video-input d-flex align-items-center mb-2">
                                        <input type="file" name="videos[]" class="form-control" accept="video/*">
                                        <button type="button" class="btn btn-outline-secondary btn-sm ms-2 remove-video"
                                            style="display: none;">حذف</button>
                                    </div>
                                </div>
                                <button type="button" id="add-video" class="btn btn-outline-primary btn-sm mt-2">اضف فيديو جديد</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 mb-3">
                        <button type="submit" class="btn float-left btn-outline-secondary w-100 float-end">
                            {{ isset($course) ? 'تعديل الدورة' : 'اضافة دورة' }}
                        </button>
                    </div>
                </div>

            </div>
        </form>
        <!-- Courses List -->
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">قائمة الدورات</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @isset($courses)
                    @if($courses->isNotEmpty())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>اسم الدورة</th>
                                <th>الصورة</th>
                                <th>الملاحظات</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($courses as $course)
                            <tr>
                                <td>{{ $course->id }}</td>
                                <td>{{ $course->title }}</td>
                                <td>
                                    @if($course->image)
                                    <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image" width="50">
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>{{ $course->note }}</td>
                                <td>
                                    <a href="{{ route('courses.edit', $course->id) }}"
                                        class="btn btn-primary btn-sm">تعديل</a>
                                    <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info btn-sm">عرض التفاصيل</a>
                                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="alert alert-warning">لا توجد دورات متاحة حاليا.</div>
                    @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-bottom')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const videosContainer = document.getElementById('videos-container');
        const addVideoButton = document.getElementById('add-video');

        addVideoButton.addEventListener('click', function() {
            const newVideoInput = document.createElement('div');
            newVideoInput.classList.add('video-input', 'd-flex', 'align-items-center', 'mb-2');
            newVideoInput.innerHTML = `
                <input type="file" name="videos[]" class="form-control" accept="video/*">
                <button type="button" class="btn btn-outline-secondary btn-sm ms-2 remove-video">Remove</button>
            `;
            videosContainer.appendChild(newVideoInput);
        });

        videosContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-video')) {
                const videoInput = event.target.parentElement;
                videosContainer.removeChild(videoInput);
            }
        });
    });
</script>
@endsection