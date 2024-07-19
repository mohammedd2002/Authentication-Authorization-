@section('titleAuth' , 'Front Reset Password Page')

<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets-front') }}/" data-template="vertical-menu-template-free">
@include('front.partials.authHead')


<body>
    <!-- Content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        @include('front.partials.authLogo')
                        <!-- /Logo -->
                        <h4 class="mb-2">Reset Password 🔒</h4>

                        <form id="formAuthentication" class="mb-3" action="{{ route('password.store') }}"
                            method="POST">
                            @csrf
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" 
                                    value="{{$request->route('email') }}" autofocus />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">New Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password"  class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password"/>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                            </div>

                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Confirm Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password"  class="form-control"
                                        name="password_confirmation"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />


                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100">Reset Password</button>
                        </form>

                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>
    <!-- / Content -->


    @include('front.partials.authScripts')
