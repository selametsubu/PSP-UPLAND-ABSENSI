<!DOCTYPE html>
<html data-theme="light">
<!--begin::Head-->

<head>
    @include('inc.metas')
    @include('inc.styles')
</head>
<!--end::Head-->
<!--begin::Body-->

<body data-kt-name="metronic" id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat"
    data-theme="light" style="background: #fef0de">
    <div class="d-flex mx-5 my-5">
        <div>
            <img src="{{ asset('media/logos/logo_direktorat.png') }}" height="50px" width="50px" />
        </div>
        <div class="pt-1 mx-3">
            <div class="fw-bolder">Direktorat Jenderal Prasarana dan Sarana Pertanian</div>
            <span>Kementerian Pertanian Republik Indonesia</span>
        </div>
    </div>

    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page bg image-->
        <style>
            body {
                background: #FFF;

            }
        </style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <!--begin::Aside-->
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <!--begin::Aside-->
                <div class="d-flex flex-column">
                    <div>
                        <!--begin::Logo-->
                        <a href="{{ route('dashboard') }}">
                            <img alt="Logo" src="{{ asset('media/logos/upland.png') }}" width="300" />
                        </a>
                        <!--end::Logo-->
                    </div>
                    <div class="pt-3 ml-5 text-center text-orange">
                        <h1 class="text-orange">Aplikasi Absensi UPLAND</h1>
                    </div>


                </div>
                <!--begin::Aside-->
            </div>
            <!--begin::Aside-->
            <!--begin::Body-->
            <div class="d-flex flex-center w-lg-50 p-10">
                {{ $slot }}
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    @include('inc.scripts')

    @yield('scripts')

    {{ $scripts }}

    <script>
        $(document).ready(function() {
            KTThemeMode.setMode("light");
        });
    </script>
</body>
<!--end::Body-->

</html>
