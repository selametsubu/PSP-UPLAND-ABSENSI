<x-guest-layout>
    <div class="card shadow border rounded-3 w-md-550px">
        <div class="card-body p-10 p-lg-20">

            <!--begin::Heading-->
            <div class="text-center mb-0">
                <!--begin::Title-->
                <h2 class="text-orange fw-bolder mb-10">Form Reset Password</h2>
                <!--end::Title-->
                <!--begin::Subtitle-->
                <div class="text-gray-500 fw-semibold fs-6"></div>
                <!--end::Subtitle=-->
            </div>
            <!--begin::Heading-->

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <x-app-label for="email">{{ __('Email') }}</x-app-label>

                    <x-app-input-text id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)"
                        required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-app-label for="password">{{ __('Password') }}</x-app-label>

                    <x-app-input-text id="password" class="block mt-1 w-full" type="password" name="password" required />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-app-label for="password_confirmation">{{ __('Konfirmasi Password') }}</x-app-label>

                    <x-app-input-text id="password_confirmation" class="block mt-1 w-full" type="password"
                        name="password_confirmation" required />
                </div>

                <div class="row mt-5">
                    <div class="col-lg-8">
                        <x-button class="btn-orange w-100">
                            {{ __('Reset Password') }}
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
