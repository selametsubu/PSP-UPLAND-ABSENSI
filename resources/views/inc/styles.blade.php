<link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
<link rel="shortcut icon" href="{{ asset('media/logos/logo.png') }}" />
<!--begin::Fonts-->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
<!--end::Fonts-->
<!--begin::Vendor Stylesheets(used by this page)-->
<link href="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />


<!--end::Vendor Stylesheets-->
<!--begin::Global Stylesheets Bundle(used by all pages)-->
<link href="{{ asset('plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
<!--end::Global Stylesheets Bundle-->
<style>
    .text-orange{
        color: #F89516 !important;
    }
    .btn-orange{
        background: #F89516 !important;
        color: #FFF !important;
    }

    .select2-container--disabled .selection .select2-selection{
        background: #E7F0FE;
    }

    /* .menu-item.here{
        background: var(--bs-orange);
        color: var(--bs-white) !important;
    }
    .menu-item.here .menu-title, .menu-item.here .svg-icon{
        color: var(--bs-white) !important;
    } */
</style>

<style>
    .image-input .image-input-wrapper {
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
</style>

{{ $styles ?? '' }}
