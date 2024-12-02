@extends('layouts.vertical', ['title' => isset($setting) ? 'تعديل الاعدادات' : 'الاعدادات'])

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
        <form 
            action="{{ isset($setting) ? route('settings.update', $setting->id) : route('settings.store') }}" 
            method="POST">
            @csrf
            @if(isset($setting))
                @method('PUT')
            @endif
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ isset($setting) ? 'تعديل الاعدادات' : 'اضف اعدادات جديدة' }}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Phone -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">رقم الهاتف</label>
                                <input type="text" id="phone" name="phone" class="form-control" 
                                    value="{{ old('phone', $setting->phone ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الالكتروني</label>
                                <input type="email" id="email" name="email" class="form-control" 
                                    value="{{ old('email', $setting->email ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Social Links -->
                        @foreach (['socialLink1', 'socialLink2', 'socialLink3', 'socialLink4'] as $link)
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="{{ $link }}" class="form-label">{{ ucfirst($link) }}</label>
                                    <input type="text" id="{{ $link }}" name="{{ $link }}" class="form-control" 
                                        value="{{ old($link, $setting->$link ?? '') }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Submit Button -->
                    <div class="col-lg-2 mb-3">
                        <button type="submit" class="btn btn-outline-secondary w-100">
                            {{ isset($setting) ? 'تحديث الاعدادات' : 'اضافة الاعدادات' }}
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="card mt-3">
            <div class="card-header">
                <h4 class="card-title">Settings List</h4>
            </div>
            <div class="card-body">
                @isset($settings)
                @if($settings->isNotEmpty())
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Social Link 1</th>
                            <th>Social Link 2</th>
                            <th>Social Link 3</th>
                            <th>Social Link 4</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($settings as $setting)
                        <tr>
                            <td>{{ $setting->id }}</td>
                            <td>{{ $setting->phone }}</td>
                            <td>{{ $setting->email }}</td>
                            <td>{{ $setting->socialLink1 }}</td>
                            <td>{{ $setting->socialLink2 }}</td>
                            <td>{{ $setting->socialLink3 }}</td>
                            <td>{{ $setting->socialLink4 }}</td>
                            <td>
    <!-- زر تعديل -->
    <a href="{{ route('settings.edit', $setting->id) }}" class="btn btn-primary btn-sm" style="padding: 5px 15px;">
        Edit
    </a>
    </td>
    <td>
    <!-- نموذج حذف -->
    <form action="{{ route('settings.destroy', $setting->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this setting?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm" style="padding: 5px 15px;">
            Delete
        </button>
    </form>
</td>

                        </tr>
                        @endforeach
                    </tbody>
                 
                </table>
                </div>
                @else
                <div class="alert alert-warning">No settings found.</div>
                @endif
                @endisset
            </div>
        </div>
    </div>
</div>

@endsection
