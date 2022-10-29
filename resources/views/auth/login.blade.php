<x-guest-layout>
    <!--begin::Card-->
    <div class="card shadow border rounded-3 w-md-550px">
        <!--begin::Card body-->
        <div class="card-body p-10 p-lg-20">
            <!--begin::Form-->
            <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="{{ route('login') }}"
                method="POST">
                @csrf
                <!--begin::Heading-->
                <div class="text-center mb-0">
                    <!--begin::Title-->
                    <h2 class="text-orange fw-bolder mb-10">Selamat Datang,<br>Silahkan Login dengan Akun Anda</h2>
                    <!--end::Title-->
                    <!--begin::Subtitle-->
                    <div class="text-gray-500 fw-semibold fs-6"></div>
                    <!--end::Subtitle=-->
                </div>
                <!--begin::Heading-->

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4 text-danger" :errors="$errors" />

                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Email-->
                    <input type="text" value="{{ old('email') }}" placeholder="Email" name="email"
                        autocomplete="off" class="form-control bg-transparent" />
                    <!--end::Email-->
                </div>
                <!--end::Input group=-->
                <div class="fv-row mb-3">
                    <!--begin::Password-->
                    <input type="password" placeholder="Password" name="password" autocomplete="off"
                        class="form-control bg-transparent" />
                    <!--end::Password-->
                </div>
                <!--end::Input group=-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                    <div>
                        <div class="block mt-0">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" name="remember">
                                <span class="ml-2 text-sm text-white-">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                    </div>
                    <!--begin::Link-->
                    <a href="{{ route('password.request') }}" class="link-primary">Lupa Password ?</a>
                    <!--end::Link-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Submit button-->
                <div class="d-grid mb-10">
                    <button type="submit" id="kt_sign_in_submit" class="btn btn-orange">
                        <!--begin::Indicator label-->
                        <span class="indicator-label">Log In</span>
                        <!--end::Indicator label-->
                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        <!--end::Indicator progress-->
                    </button>
                </div>
                <!--end::Submit button-->
                <!--begin::Sign up-->
                <div class="text-gray-500 text-center fw-semibold fs-6">Belum menjadi anggota ? Ayo
                    <a href="{{ route('register') }}" class="text-orange">
                        Daftar
                    </a>
                </div>
                <!--end::Sign up-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</x-guest-layout>
