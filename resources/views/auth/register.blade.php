@extends('layouts.auth', ['title' => 'تسجيل مستخدم جديد'])

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

                                <h2 class="fw-bold fs-24">انشاء حساب</h2>

                                <!-- <p class="text-muted mt-1 mb-4">New to our platform? Sign up now! It only takes a
                                    minute</p> -->

                                <div>
                                    <form class="authentication-form">
                                        <div class="my-3">
                                            <label class="form-label" for="example-name">اسم المستخدم</label>
                                            <input type="text" id="example-name" name="example-name"
                                                   class="form-control" placeholder="Enter your name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="example-email">البريد الالكتروني</label>
                                            <input type="email" id="example-email" name="example-email"
                                                   class="form-control bg-" placeholder="Enter your email">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="example-password">كلمة السر</label>
                                            <input type="text" id="example-password" class="form-control"
                                                   placeholder="Enter your password">
                                        </div>
                                        <!-- <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                                <label class="form-check-label" for="checkbox-signin">لقد قرات </label>
                                            </div>
                                        </div> -->

                                        <div class="mt-4 text-center d-grid">
                                            <button class="btn btn-soft-primary" type="submit">تسجيل الحساب</button>
                                        </div>
                                    </form>

                                
                                </div>

                                <p class="mt-auto text-danger text-center">انا امتلك حساب بالفعل !! <a
                                        href="{{ route('second', [ 'auth' , 'login']) }}" class="text-dark fw-bold ms-1">تسجيل دخول</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-5 d-none d-xxl-flex">
                    <div class="card h-100 mb-0 overflow-hidden">
                        <div class="d-flex flex-column h-100">
                            <img src="/images/small/img-10.jpg" alt="" class="w-100 h-100">
                        </div>
                    </div> <!-- end card -->
                </div>
            </div>
        </div>
    </div>

@endsection
