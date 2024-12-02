@extends('layouts.vertical', ['title' => isset($gallery) ? 'تعديل الصور' : 'اضف صورة جديدة'])

@section('css')
@vite(['node_modules/choices.js/public/assets/styles/choices.min.css'])
@endsection

@section('content')

<div class="row"  dir="rtl">
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
        <form 
            action="{{ isset($gallery) ? route('gallery.update', $gallery->id) : route('gallery.store') }}" 
            method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($gallery))
                @method('PUT') <!-- Use PUT method for updates -->
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($gallery) ? 'تعديل الصورة' : 'إضافة صورة جديدة' }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Title Input -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">عنوان الصورة</label>
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    class="form-control"
                                    placeholder="أدخل عنوان الصورة"
                                    value="{{ old('title', $gallery->title ?? '') }}"
                                    required>
                            </div>
                        </div>

                        <!-- File Input -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="file" class="form-label">الصورة</label>
                                <input
                                    type="file"
                                    id="file"
                                    name="file"
                                    class="form-control"
                                    {{ isset($gallery) ? '' : 'required' }}>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="col-lg-2 mb-3">
                        <button type="submit" class="btn btn-outline-secondary w-100">
                            {{ isset($gallery) ? 'تحديث الصورة' : 'إضافة صورة جديدة' }}
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">قائمة الصور</h4>
            </div>
            <div class="card-body">
                @isset($galleries)
                @if($galleries->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>العنوان</th>
                            <th>الصورة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($galleries as $gallery)
                        <tr>
                            <td>{{ $gallery->id }}</td>
                            <td>{{ $gallery->title }}</td>
                            <td><img src="{{ asset('storage/'.$gallery->file) }}" alt="Image" width="100"></td>
                            <td>
                                <a href="{{ route('gallery.edit', $gallery->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                                <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST" style="display:inline-block;">
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
                <div class="alert alert-warning">لا توجد صور.</div>
                @endif
                @endisset
            </div>
        </div>
    </div>
</div>

@endsection

@section('script-bottom')
@vite(['resources/js/pages/ecommerce-gallery-details.js'])
@endsection
