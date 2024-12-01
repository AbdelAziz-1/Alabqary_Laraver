@extends('layouts.vertical', ['title' => isset($contact) ? 'Edit Contact' : 'Contact Us'])

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

    <div class="col-xl-12 col-lg-12">
        <form 
            action="{{ isset($contact) ? route('contact-us.update', $contact->id) : route('contact-us.store') }}" 
            method="POST">
            @csrf
            @if(isset($contact))
                @method('PUT')
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($contact) ? 'تعديل الرسالة' : 'إضافة رسالة جديدة' }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- First Name -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">الاسم الأول</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" 
                                    value="{{ old('first_name', $contact->first_name ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">الاسم الأخير</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" 
                                    value="{{ old('last_name', $contact->last_name ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" id="email" name="email" class="form-control" 
                                    value="{{ old('email', $contact->email ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">الهاتف</label>
                                <input type="text" id="phone" name="phone" class="form-control" 
                                    value="{{ old('phone', $contact->phone ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="message" class="form-label">الرسالة</label>
                                <textarea id="message" name="message" class="form-control" rows="4" required>{{ old('message', $contact->message ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="col-lg-2 mb-3">
                    <button type="submit" class="btn btn-outline-secondary w-100">
                        {{ isset($contact) ? 'Update Message' : 'إضافة رسالة' }}
                    </button>
                </div>
            </div>
        </form>

        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">قائمة الرسائل</h4>
            </div>
            <div class="card-body">
                @isset($contacts)
                @if($contacts->isNotEmpty())
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                        <tr>
                            <td>{{ $contact->id }}</td>
                            <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>
                                <a href="{{ route('contact-us.edit', $contact->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                                <form action="{{ route('contact-us.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
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
                <div class="alert alert-warning">لا توجد رسائل.</div>
                @endif
                @endisset
            </div>
        </div>
    </div>
</div>

@endsection
