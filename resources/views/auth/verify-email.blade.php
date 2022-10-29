<x-guest-layout>
    <div class="card shadow border rounded-3 w-md-550px">
        <div class="card-body p-10 p-lg-20">

            <!--begin::Heading-->
            <div class="text-center mb-0">
                <!--begin::Title-->
                <h2 class="text-orange fw-bolder mb-10">Selamat Datang, {{ auth()->user()->fullname }}</h2>
                <!--end::Title-->
                <!--begin::Subtitle-->
                <div class="text-gray-500 fw-semibold fs-6"></div>
                <!--end::Subtitle=-->
            </div>
            <!--begin::Heading-->

            <div class="mb-4 text-gray-600 fs-21px">
                {{ __('Terima Kasih sudah mendaftar pada aplikasi Absensi UPLAND!
                                                Sebelum mulai menggunakan aplikasi ini, harap melakukan verifikasi email dengan klik link yang kami kirim ke email
                                                anda. Jika anda belum menerima email silahkan klik tombol Kirim Ulang Email Verifikasi dibawah ini.
                                                ') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 alert alert-success">
                    {{ __('Link telah dikirim ke email anda.') }}
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <div class="row">
                    <div class="col-lg-8">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                                <x-button class="btn btn-orange w-100">
                                    {{ __('Kirim Ulang Email Verifikasi') }}
                                </x-button>

                        </form>
                    </div>
                    <div class="col-lg-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="btn btn-danger w-100">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
