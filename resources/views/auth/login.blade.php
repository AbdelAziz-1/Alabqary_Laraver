@extends('layouts.auth', ['title' => 'Login'])

@section('content')
<div class="d-flex flex-column h-100 p-3" dir="rtl">
    <div class="d-flex flex-column flex-grow-1">
        <div class="row h-100">
            <div class="col-xxl-7">
                <div class="row justify-content-center h-100">
                    <div class="col-lg-6 py-lg-5">
                        <div class="d-flex flex-column h-100 justify-content-center">
                            <div class="auth-logo mb-4">
                                <a href="{{ route('second', [ 'dashboards' , 'index']) }}" class="logo-dark">
                                    <img src="/images/logo-dark.png" height="24" alt="logo dark">
                                </a>

                                <a href="{{ route('second', [ 'dashboards' , 'index']) }}" class="logo-light">
                                    <img src="/images/logo-light.png" height="24" alt="logo light">
                                </a>
                            </div>

                            <h2 class="fw-bold fs-24">تسجيل الدخول</h2>

                            <p class="text-muted mt-1 mb-4">ادخل اسم البريد الالكتروني وكلمة السر.</p>

                            <div class="mb-5">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <form method="POST" action="{{ route('login') }}" class="authentication-form">
                                    @csrf
                                    @if (sizeof($errors) > 0)
                                    @foreach ($errors->all() as $error)
                                    <p class="text-danger mb-3">{{ $error }}</p>
                                    @endforeach
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label" for="example-email">البريد الالكتروني</label>
                                        <input type="email" name="email" :value="old('email')"
                                            class="form-control bg-" placeholder="Enter your email"
                                            value="test@example.com">
                                    </div>
                                    <div class="mb-3">
                                        <!-- <a href="{{ route('second', [ 'auth' , 'reset-password']) }}"
                                               class="float-end text-muted text-unline-dashed ms-1">Reset password</a> -->
                                        <label class="form-label" for="example-password">كلمة السر</label>
                                        <input type="password" id="example-password" class="form-control"
                                            placeholder="ادخل كلمة السر" name="password" value="1234567890">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                            <label class="form-check-label" for="checkbox-signin">تذكرني</label>
                                        </div>
                                    </div>

                                    <div class="mb-1 text-center d-grid">
                                        <button class="btn btn-soft-primary" type="submit">تسجيل الدخول</button>
                                    </div>
                                </form>

                            </div>
                            <p class="text-danger text-center">لا امتلك حساب? <a href="{{ route('second', [ 'auth' , 'register']) }}"
                                    class="text-dark fw-bold ms-1">انشاء حساب </a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-5 d-none d-xxl-flex">
                <div class="card h-100 mb-0 overflow-hidden">
                    <div class="d-flex flex-column h-100">
                        <img src="/images/small/img-10.jpg" alt="" class="w-100 h-100">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection