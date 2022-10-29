<x-app-full-layout>
    <x-slot name="page_title">Kehadiran</x-slot>

    <x-app-card>
        <x-slot name="title">
            Hari ini: &nbsp; <span id="tanggal_hari_ini"></span>
        </x-slot>
        <x-slot name="toolbar">

        </x-slot>

        <div class="row">
            <div class="col-lg-12">
                <form id="form-absen-datang">
                    <div class="bg-warning p-5 text-center" role="button" id="btn-absen-datang">
                        <span class="display-3 text-uppercase">Absen Datang</span>
                    </div>

                    <div class="accordion accordion-icon-toggle" id="kt_absen_datang">
                        <!--begin::Item-->
                        <div class="mb-5">
                            <!--begin::Header-->
                            <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse"
                                data-bs-target="#kt_absen_datang_item_1" aria-expanded="false"
                                id="btn-collapse-absen-datang">
                                <div class="fs-4 fw-semibold mb-0 w-100">
                                    <div class="separator my-5"></div>
                                </div>
                                <span class="accordion-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                    <span class="svg-icon svg-icon-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="18" y="13" width="13"
                                                height="2" rx="1" transform="rotate(-180 18 13)"
                                                fill="currentColor"></rect>
                                            <path
                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div id="kt_absen_datang_item_1" class="fs-6 ps-10 collapse-"
                                data-bs-parent="#kt_absen_datang" style="">
                                <div id="collapse-absen-datang">

                                    <div class="fv-row
                                        mb-5 row">
                                        <x-app-label class="col-lg-3">Jam</x-app-label>


                                        <div class="col-lg-9  fw-bold">
                                            <span id="jam" class="jam">

                                            </span>
                                            <span id="zona_waktu">
                                                {{ auth()->user()->spot->zonaWaktu->zona_waktu }}
                                                ({{ auth()->user()->spot->zonaWaktu->keterangan }})
                                            </span>

                                        </div>

                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Lokasi</x-app-label>
                                        <div class="col-lg-9">
                                            <x-app-textarea id="lokasi" name="lokasi" readonly></x-app-textarea>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Latitude \ Longitude</x-app-label>
                                        <div class="col">
                                            <x-app-input-text id="lat" name="lat" readonly></x-app-input-text>
                                        </div>
                                        <div class="col">
                                            <x-app-input-text id="lng" name="lng" readonly></x-app-input-text>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Provinsi</x-app-label>
                                        <div class="col-lg-9">
                                            <x-app-input-text id="prov" name="prov" readonly></x-app-input-text>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Kabupaten</x-app-label>
                                        <div class="col-lg-9">
                                            <x-app-input-text id="kab" name="kab" readonly></x-app-input-text>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Kecamatan</x-app-label>
                                        <div class="col-lg-9">
                                            <x-app-input-text id="kec" name="kec" readonly></x-app-input-text>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Desa</x-app-label>
                                        <div class="col-lg-9">
                                            <x-app-input-text id="desa" name="desa" readonly></x-app-input-text>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Catatan</x-app-label>
                                        <div class="col-lg-9">
                                            <x-app-textarea id="catatan" name="catatan"></x-app-textarea>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Foto</x-app-label>
                                        <div class="col-lg-9">
                                            <div class="d-block">
                                                <div class="image-input image-input-empty image-input-outline"
                                                    data-kt-image-input="true">
                                                    <!--begin::Preview existing avatar-->
                                                    <div
                                                        class="image-input-wrapper w-200px h-200px border-1 border-secondary form-control">
                                                    </div>
                                                    <!--end::Preview existing avatar-->
                                                    <!--begin::Label-->
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change avatar">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="swafoto" />
                                                        <input type="hidden" name="avatar_remove" />
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Cancel-->
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        title="Cancel avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Cancel-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="btn-absen-datang">
                                        <button class="btn btn-warning w-100" type="button"
                                            id="btn-create-absen-datang">Absen</button>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Item-->
                    </div>
                </form>
            </div>
            <div class="col-lg-12">
                <form id="form-absen-pulang">
                    <div class="bg-orange p-5 text-center">
                        <span class="display-3 text-uppercase">Absen Pulang</span>
                    </div>
                    <div class="accordion accordion-icon-toggle" id="kt_absen_pulang">
                        <!--begin::Item-->
                        <div class="mb-5">
                            <!--begin::Header-->
                            <div class="accordion-header py-3 d-flex collapsed" data-bs-toggle="collapse"
                                data-bs-target="#kt_absen_pulang_item_1" aria-expanded="false">
                                <div class="fs-4 fw-semibold mb-0 w-100">
                                    <div class="separator my-5"></div>
                                </div>
                                <span class="accordion-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                    <span class="svg-icon svg-icon-4">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="18" y="13" width="13"
                                                height="2" rx="1" transform="rotate(-180 18 13)"
                                                fill="currentColor"></rect>
                                            <path
                                                d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>

                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div id="kt_absen_pulang_item_1" class="fs-6 ps-10 collapse"
                                data-bs-parent="#kt_absen_pulang" style="">
                                <div id="collapse-absen-datang">

                                    <div class="fv-row
                                        mb-5 row">
                                        <x-app-label class="col-lg-3">Jam</x-app-label>


                                        <div class="col-lg-9">
                                            <span class="jam">

                                            </span>
                                            <span id="zona_waktu">
                                                {{ auth()->user()->spot->zonaWaktu->zona_waktu }}
                                                ({{ auth()->user()->spot->zonaWaktu->keterangan }})
                                            </span>

                                        </div>

                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Lokasi</x-app-label>
                                        <div class="col-lg-9">
                                            <x-app-textarea id="lokasi" name="lokasi"></x-app-textarea>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Provinsi</x-app-label>
                                        <div class="col-lg-9">
                                            <x-app-input-text id="prov" name="prov"></x-app-input-text>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Kabupaten</x-app-label>
                                        <div class="col-lg-9">
                                            <x-app-input-text id="kab" name="kab"></x-app-input-text>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Kecamatan</x-app-label>
                                        <div class="col-lg-9">
                                            <x-app-input-text id="kec" name="kec"></x-app-input-text>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Desa</x-app-label>
                                        <div class="col-lg-9">
                                            <x-app-input-text id="desa" name="desa"></x-app-input-text>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Catatan</x-app-label>
                                        <div class="col-lg-9">
                                            <x-app-textarea id="catatan" name="catatan"></x-app-textarea>
                                        </div>
                                    </div>
                                    <div class="fv-row mb-5 row">
                                        <x-app-label class="col-lg-3">Foto</x-app-label>
                                        <div class="col-lg-9">
                                            <div class="d-block">
                                                <div class="image-input image-input-empty image-input-outline"
                                                    data-kt-image-input="true">
                                                    <!--begin::Preview existing avatar-->
                                                    <div
                                                        class="image-input-wrapper w-200px h-200px border-1 border-secondary form-control">
                                                    </div>
                                                    <!--end::Preview existing avatar-->
                                                    <!--begin::Label-->
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change avatar">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <!--begin::Inputs-->
                                                        <input type="file" name="swafoto" />
                                                        <input type="hidden" name="avatar_remove" />
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Cancel-->
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        title="Cancel avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Cancel-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="btn-absen-datang">
                                        <button class="btn btn-warning w-100" type="button"
                                            id="btn-absen-datang">Absen</button>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Item-->
                    </div>
                </form>
            </div>
        </div>

    </x-app-card>

    <x-slot name="scripts">
        <script>
            "use strict";

            var moduleControl = function() {
                var geocoder;

                var initTime = function() {
                    let datetime = getCurrentDateTime();
                    let date = datetime[0];
                    let time = datetime[1];

                    $("#tanggal_hari_ini").text(date);
                    $(".jam").text(time);
                }

                var handleControl = function() {
                    $("#btn-absen-datang").click(function(e) {
                        e.preventDefault();

                        getLocation("#form-absen-datang");
                    });
                }

                var setLocationData = function(form, data) {

                    $(form + " #lokasi").val(data.formatted_address);
                    $(form + " #lat").val(data.geometry.location.lat());
                    $(form + " #lng").val(data.geometry.location.lng());
                    $(form + " #prov").val(data.address_components[3].long_name);
                    $(form + " #kab").val(data.address_components[2].long_name);
                    $(form + " #kec").val(data.address_components[1].long_name);
                    $(form + " #desa").val(data.address_components[0].long_name);
                }

                var getLocation = function(form) {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            (position) => {
                                const pos = {
                                    lat: position.coords.latitude,
                                    lng: position.coords.longitude,
                                };

                                geocoder = new google.maps.Geocoder();
                                geocoder.geocode({
                                    'latLng': pos
                                }, function(results, status) {
                                    if (status == 'OK') {
                                        setLocationData(form, results[0]);
                                    } else {
                                        alertWarning('Lokasi tidak ditemukan.');
                                    }
                                });
                            },
                            () => {
                                handleLocationError(true, infoWindow, map.getCenter());
                            }
                        );
                    } else {
                        // Browser doesn't support Geolocation
                        handleLocationError(false, infoWindow, map.getCenter());
                    }
                }

                var onDataSaved = function() {

                }

                // Public methods
                return {
                    init: function() {
                        setInterval(initTime, 1000);
                        handleControl();
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
