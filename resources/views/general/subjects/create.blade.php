@extends('layouts.vertical', ['title' => isset($subject) ? 'Edit subject' : 'ٌانشاء مادة جديد'])

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
    <div class="col-xl-12 col-lg-12 ">
        <form action="{{ isset($Subject) ? route('subject.update', $Subject->id) : route('subject.store') }}"
            method="POST">
            @csrf
            @if(isset($Subject))
                @method('PUT') <!-- Use PUT method for updates -->
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($Subject) ? 'تعديل المادة' : 'ٌانشاء مادة جديد' }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- subject Title Input -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="title" class="form-label">اسم المادة الدراسية </label>
                                <input type="text" id="title" name="title" class="form-control"
                                    placeholder="ادخل اسم المادة" value="{{ old('title', $Subject->title ?? '') }}"
                                    required>
                            </div>
                        </div>
                        <!-- grades Input -->
                        <div class="col-lg-6 mb-3">
                            <div class="mb-3">
                                <label for="grade_id" class="form-label">المرحلة التعليمية</label>
                                <select name="grade_id" class="form-control" id="grade_id">
                                    @foreach($Subjects as $item)
                                        <option value="{{ $item->grade->id }}" 
                                            {{ isset($Subject) && $Subject->grade_id == $item->grade->id ? 'selected' : '' }}>
                                            {{ $item->grade->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- Note Input -->
                        <div class="col-lg-12 mb-3">
                            <div class="mb-3">
                                <label for="note" class="form-label">ملاحظات</label>
                                <textarea name="note" class="form-control" id="note"
                                    placeholder="اضف ملاحظات...">{{ old('note', $Subject->note ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="col-lg-2 mb-3">
                        <button type="submit" class="btn float-left btn-outline-secondary w-100 ">
                            {{ isset($Subject) ? 'تعديل المادة الدراسية' : 'انشاء مادة جديد' }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">قائمة المواد الدراسية</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @isset($Subjects)
                        @if($Subjects->isNotEmpty())
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>العنوان</th>
                                        <th>المرحلة الدراسية</th>
                                        <th>الملاحظات</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Subjects as $subject)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->grade->title}}</td>
                                            <td>{{ $item->note }}</td>
                                            <td>
                                                <a href="{{ route('subject.edit', $item->id) }}"
                                                    class="btn btn-primary btn-sm">تعديل</a>
                                                <form action="{{ route('subject.destroy', $item->id) }}" method="POST"
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
                            <div class="alert alert-warning">No subjects available.</div>
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script-bottom')
@vite(['resources/js/pages/ecommerce-subject-details.js'])
@endsection