<!--begin::Javascript-->
<script>
    var appUrl = "{{ env('APP_URL') }}";
    var apiUrl = "{{ env('API_URL') }}";
    var storageUrl = appUrl + "/storage";
</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('js/scripts.bundle.js') }}"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used by this page)-->
<script src="{{ asset('plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/sr-1.1.1/datatables.min.js">
</script>

<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used by this page)-->
<script src="{{ asset('js/widgets.bundle.js') }}"></script>
<script src="{{ asset('js/custom/widgets.js') }}"></script>
<script src="{{ asset('js/custom/apps/chat/chat.js') }}"></script>
<script src="{{ asset('js/custom/utilities/modals/upgrade-plan.js') }}"></script>
<script src="{{ asset('js/custom/utilities/modals/create-app.js') }}"></script>
<script src="{{ asset('js/custom/utilities/modals/users-search.js') }}"></script>
<!--end::Custom Javascript-->
<!--begin::jquery validation-->
<script src="{{ asset('plugins/custom/jquery-validation/dist/jquery.validate.min.js') }}"></script>
<script src="{{ asset('plugins/custom/jquery-validation/dist/additional-message.js') }}"></script>
<script src="{{ asset('plugins/custom/jquery-validation/dist/additional-methods.min.js') }}"></script>
<!--end::jquery validation-->
<!--end::Javascript-->

<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHatAf0FiABgQeJa0TUsffRBUmohRCGv0&libraries=drawing&v=weekly"
    defer>
</script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

<script src="{{ asset('js/general.helper.js') }}"></script>
<script src="{{ asset('js/configs.js') }}"></script>
<script src="{{ asset('js/datatable.js') }}"></script>


{{ $scripts ?? '' }}
