<style>
    .image-input .image-input-wrapper {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
</style>
<div class="aside-user mb-5 mb-lg-10" id="kt_aside_user">
    <!--begin::User-->
    <div class="d-flex align-items-center flex-column">

        <!--begin::Symbol-->
        <div class="symbol symbol-75px mb-4">
            @if (auth()->user()->photo)

                <div class="d-block">
                    <div class="image-input img-thumbnail image-input-outline" data-kt-image-input="true">
                        <!--begin::Preview existing avatar-->
                        <div
                            class="image-input-wrapper w-125px h-125px border-1 border-secondary form-control"
                            style="background-image: url({{ route('download_file', ['path' => auth()->user()->photo]) }})">
                        </div>
                        <!--end::Preview existing avatar-->
                    </div>
                </div>
            @else
                <img src="/media/avatars/blank.png" alt="" />
            @endif
        </div>
        <!--end::Symbol-->


        <!--begin::Info-->
        <div class="text-center">
            <!--begin::Username-->
            <a href="{{ route('profil-saya') }}"
                class="text-gray-800 text-hover-primary fs-4 fw-bolder">{{ auth()->user()->fullname }}</a>
            <!--end::Username-->
            <!--begin::Description-->
            <span class="text-gray-600 fw-semibold d-block fs-7 mb-1">{{ auth()->user()->role->rolename }}</span>
            <!--end::Description-->
        </div>
        <!--end::Info-->
    </div>
    <!--end::User-->
</div>
