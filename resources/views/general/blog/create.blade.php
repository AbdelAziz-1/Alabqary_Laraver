@extends('layouts.vertical', ['title' => isset($grade) ? 'Edit Grade' : 'ٌانشاء صف جديد'])

@section('css')
@vite(['node_modules/choices.js/public/assets/styles/choices.min.css'])
@endsection

@section('content')

<div class="row">
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

    <div class="col-xl-12 col-lg-12 ">
        <form 
            action="{{ isset($grade) ? route('grade.update', $grade->id) : route('grade.store') }}" 
            method="POST">
            @csrf
            @if(isset($grade))
                @method('PUT') <!-- Use PUT method for updates -->
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($grade) ? 'تعديل المقالة' : 'ٌانشاء مقالة جديدة' }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Grade Title Input -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">عنوان المقالة</label>
                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    class="form-control"
                                    placeholder="ادخل اسم المقالة"
                                    value="{{ old('title', $grade->title ?? '') }}"
                                    required>
                            </div>
                        </div>

                        <!-- Note Input -->
                        <div class="col-lg-12 mb-3">
                            <div class="mb-3">
                                <label for="note" class="form-label">وصف المقالة</label>
                                <textarea
                                    name="note"
                                    class="form-control"
                                    id="note"
                                    placeholder="اضف ملاحظات...">{{ old('note', $grade->note ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="col-lg-2 mb-3">
                    <button type="submit" class="btn float-left btn-outline-secondary w-100 ">
                        {{ isset($grade) ? 'Update Grade' : 'انشاء مقالة جديدة' }}
                    </button>
                </div>
            </div>
        </form>
        
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">قائمة الصفوف</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @isset($grades)
                    @if($grades->isNotEmpty())
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>العنوان</th>
                                <th>الملاحظات</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grades as $grade)
                            <tr>
                                <td>{{ $grade->id }}</td>
                                <td>{{ $grade->title }}</td>
                                <td>{{ $grade->note }}</td>
                                <td>
                                    <a href="{{ route('grade.edit', $grade->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                                    <form action="{{ route('grade.destroy', $grade->id) }}" method="POST" style="display:inline-block;">
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
                    <div class="alert alert-warning">No grades available.</div>
                    @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script-bottom')
@vite(['resources/js/pages/ecommerce-Grade-details.js'])
@endsection
