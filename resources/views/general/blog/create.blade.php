@extends('layouts.vertical', ['title' => isset($blog) ? 'تعديل الخبر' : 'انشاء خبر جديد'])

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
        <form action="{{ isset($Blog) ? route('blog.update', $Blog->id) : route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($Blog))
            @method('PUT')
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($Blog) ? 'تعديل الخبر' : 'انشاء خبر جديدة' }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- blog Title Input -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">عنوان الخبر</label>
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    class="form-control"
                                    placeholder="ادخل اسم الخبر"
                                    value="{{ old('title', $Blog->title ?? '') }}"
                                    required>
                            </div>
                        </div>

                        <!-- Note Input -->
                        <div class="col-lg-12 mb-3">
                            <div class="mb-3">
                                <label for="content" class="form-label">وصف الخبر</label>
                                <textarea
                                    name="content"
                                    class="form-control"
                                    id="content"
                                    placeholder="اضف ملاحظات...">{{ old('content', $Blog->content ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Image Input -->
                        <div class="col-lg-12 mb-3">
                            <div class="mb-3">
                                <label for="image" class="form-label">اضف صورة الخبر</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                        </div>

                        @if(isset($Blog) && $Blog->image)
                        <div class="mb-3">
                            <label for="current-image" class="form-label">الصورة الحالية</label>
                            <img src="{{ asset('storage/' . $Blog->image) }}" alt="Current Image" class="img-fluid">
                        </div>
                        @endif
                    </div>
                    <!-- Submit Button -->
                    <div class="col-lg-2 mb-3">
                        <button type="submit" class="btn float-left btn-outline-secondary w-100">
                            {{ isset($Blog) ? 'تحديث الخبر' : 'انشاء خبر جديدة' }}
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">قائمة الاخبار</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @isset($Blogs)
                    @if($Blogs->isNotEmpty())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>صورة الخبر</th>
                                <th>العنوان</th>
                                <th>الملاحظات</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td>
                                    @if ($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" width="100"  class="img-fluid">
                                    @else
                                    <p>No image available.</p>
                                    @endif
                                </td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->content }}</td>
                                <td>
                                    <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                                    <form action="{{ route('blog.destroy', $blog->id) }}" method="POST" style="display:inline-block;">
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
                    <div class="alert alert-warning">لا توجد اخبار متاحة حاليا.</div>
                    @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script-bottom')
@vite(['resources/js/pages/ecommerce-blog-details.js'])
@endsection