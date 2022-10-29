<x-app-full-layout>
    <x-slot name="page_title">Absen Pulang</x-slot>

    <x-app-card>
        <!--begin::Alert-->
        <div class="alert alert-danger d-flex align-items-center p-5 mt-5">
            <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
            <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                <i class="fas fa-times fs-2x text-danger"></i>
            </span>
            <!--end::Svg Icon-->
            <div class="d-flex flex-column">
                <h4 class="mb-1 text-danger">Terjadi Kesalahan</h4>
                <span>
                    {{ request('message') }}
                </span>
            </div>
        </div>
        <!--end::Alert-->
    </x-app-card>

    <x-slot name="scripts">
        <script>
            "use strict";

            var moduleControl = function() {


                // Public methods
                return {
                    init: function() {

                    }
                }
            }();

            // On document ready
            KTUtil.onDOMContentLoaded(function() {
                moduleControl.init();
            });
        </script>
    </x-slot>
</x-app-full-layout>
