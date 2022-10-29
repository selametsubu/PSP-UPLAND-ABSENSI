<x-guest-layout>
    <div class="card shadow border rounded-3 w-md-550px">
        <div class="card-body p-10 p-lg-20">

            <!--begin::Heading-->
            <div class="text-center mb-0">
                <!--begin::Title-->
                <h2 class="text-orange fw-bolder mb-10">Form Lupa Password</h2>
                <!--end::Title-->
                <!--begin::Subtitle-->
                <div class="text-gray-500 fw-semibold fs-6"></div>
                <!--end::Subtitle=-->
            </div>
            <!--begin::Heading-->

            <div class="mb-4 text-sm text-gray-600">
                {{ __('Lupa Password anda?
                    Tidak masalah.
                    Selahkan masukkan email anda dan klik Kirim Link Reset Password.
                    ') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="row">
                    <div class="col-lg-12">
                        <x-app-label>Email</x-app-label>

                        <x-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                            required autofocus />
                    </div>

                </div>

                <div class="row mt-10">
                    <div class="col-lg-8">
                        <x-button class="btn btn-orange w-100">
                            {{ __('Kirim Link Reset Password') }}
                        </x-button>
                    </div>
                    <div class="col-lg-4">
                        Kembali ke halaman <a href="{{ route('login') }}" class="text-orange">Login</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
