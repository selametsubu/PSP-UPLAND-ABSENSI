<x-app-full-layout>
    <x-slot name="page_title">Absen Datang</x-slot>

    <form id="app-form" enctype="multipart/form-data">
        <div class="d-none">
            <input type="text" name="created_by" value="{{ auth()->id() }}">
            <input type="text" name="userid" value="{{ auth()->id() }}">
            <input type="text" name="is_absen_datang" value="1">
            <input type="text" name="is_absen_pulang" value="0">
            <input type="text" name="status_spot" id="status_spot" value="0">
            <input type="text" name="status_absen" value="checkin">
        </div>

        <x-app-card>
            <x-slot name="title">
                Hari ini: &nbsp; <span id="tanggal_hari_ini"></span>
            </x-slot>
            <x-slot name="toolbar">

            </x-slot>

            <div id="alert-status">

            </div>

            <div class="fv-row mb-5 row">
                <x-app-label class="col-lg-3">Lokasi Anda</x-app-label>
                <div class="col-lg-9">
                    <div id="map" class="h-200px"></div>
                    <div class="alert alert-success mt-1">
                        Catatan: Akurasi Lokasi berbeda-beda untuk tiap perangkat yang anda gunakan.
                        Silahkan Muat Ulang (Resfresh) Halaman ini jika Lokasi tidak akurat.
                    </div>
                </div>
            </div>

            <div class="mb-5 row">
                <x-app-label class="col-lg-3 required">Waktu</x-app-label>

                <div class="col-lg-3 mb-1 fw-bold fv-row ">
                    <x-app-input-text name="tgl" id="tgl" readonly></x-app-input-text>
                </div>
                <div class="col-lg-3 mb-1 fw-bold fv-row ">
                    <x-app-input-text name="waktu" id="waktu" readonly></x-app-input-text>
                </div>
                <div class="col-lg-3 mb-1 fw-bold fv-row ">
                    <x-app-select id="waktu_bagian" name="waktu_bagian">
                    </x-app-select>
                </div>
            </div>
            <div class="fv-row mb-5 row">
                <x-app-label class="col-lg-3 required">Lokasi</x-app-label>
                <div class="col-lg-9">
                    <x-app-textarea id="lokasi" name="lokasi" readonly></x-app-textarea>
                    <div id="lokasi-status" class="p-1 mt-1 w-100px text-center fw-bold d-none rounded">

                    </div>
                </div>
            </div>
            <div class="mb-5 row">
                <x-app-label class="col-lg-3 required">Latitude \ Longitude</x-app-label>
                <div class="col fv-row ">
                    <x-app-input-text id="lat" name="lat" readonly></x-app-input-text>
                </div>
                <div class="col fv-row ">
                    <x-app-input-text id="lng" name="lng" readonly></x-app-input-text>
                </div>
            </div>
            <div class="fv-row mb-5 row">
                <x-app-label class="col-lg-3 required">Provinsi</x-app-label>
                <div class="col-lg-9">
                    <x-app-input-text id="prov" name="prov" readonly></x-app-input-text>
                </div>
            </div>
            <div class="fv-row mb-5 row">
                <x-app-label class="col-lg-3 required">Kabupaten</x-app-label>
                <div class="col-lg-9">
                    <x-app-input-text id="kab" name="kab" readonly></x-app-input-text>
                </div>
            </div>
            <div class="fv-row mb-5 row">
                <x-app-label class="col-lg-3 required">Kecamatan</x-app-label>
                <div class="col-lg-9">
                    <x-app-input-text id="kec" name="kec" readonly></x-app-input-text>
                </div>
            </div>
            <div class="fv-row mb-5 row">
                <x-app-label class="col-lg-3 required">Desa</x-app-label>
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
            <div class="mb-5 row">
                <x-app-label class="col-lg-3 required">Foto</x-app-label>
                <div class="col-lg-9 fv-row">
                    <div class="d-block  ">
                        <div class="image-input image-input-empty image-input-outline" data-kt-image-input="true">
                            <!--begin::Preview existing avatar-->
                            <div class="image-input-wrapper w-200px h-200px border-1 border-secondary form-control">
                            </div>
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Pilih Foto">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" name="swafoto" />
                                <input type="hidden" name="avatar_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->
                        </div>
                    </div>
                </div>
            </div>

            <x-slot name="footer">
                <button class="btn btn-warning w-100" type="button" id="btn-store">Absen</button>
            </x-slot>
        </x-app-card>
    </form>

    <x-slot name="scripts">
        <script>
            "use strict";

            var moduleControl = function() {
                var geocoder;
                var map;
                var marker;
                var circle;

                var zona_waktu;
                var absen_datang;
                var spot_hadir_opsi;
                var batas_absen_datang;
                var batas_absen_datang_opsi;
                var spotid = "{{ auth()->user()->spotid }}";
                var spot;
                var status_spot = @json(config('ref.status_spot'));

                var checkAlreadyAbsen = function() {
                    $.ajax({
                        type: "get",
                        url: apiUrl + "/absen-hadir/sudah-absen",
                        data: {
                            status_absen: 'checkin',
                            userid: "{{ auth()->id() }}"
                        },
                        dataType: "json",
                        async: false,
                        success: function(response) {
                            location.href = "{{ route('kehadiran.absen-datang.success') }}";
                        }
                    });
                }

                var checkIzinCuti = function() {
                    $.ajax({
                        type: "get",
                        url: apiUrl + "/izin/check",
                        data: {
                            userid: "{{ auth()->id() }}"
                        },
                        dataType: "json",
                        async: false,
                        success: function(response) {
                            let url = "{{ route('kehadiran.absen-datang.error') }}";
                            let message = "Absen dilarang. Anda sedang Izin / Cuti hari ini.";
                            location.href = url + "?message=" + message;
                        }
                    });
                }

                var getZonaWaktu = function() {
                    $.ajax({
                        type: "get",
                        url: apiUrl + "/zona-waktu",
                        dataType: "json",
                        async: false,
                        success: function(response) {
                            zona_waktu = response;
                            $("#waktu_bagian").empty().append('<option value="">Pilih Opsi</option>');
                            response.forEach(row => {
                                let tmp = `
                                <option value="${row.zona_waktu}">${row.zona_waktu}</option>
                                `;
                                $("#waktu_bagian").append(tmp);
                            });
                        }
                    });
                }

                var getConfig = function() {
                    $.ajax({
                        type: "get",
                        url: apiUrl + "/globalvar",
                        dataType: "json",
                        async: false,
                        success: function(response) {
                            setConfig(response);
                        }
                    });
                }

                var getSpot = function() {
                    $.ajax({
                        type: "get",
                        url: apiUrl + "/spot/" + spotid,
                        dataType: "json",
                        async: false,
                        success: function(response) {
                            spot = response;
                        }
                    });
                }

                var setConfig = function(data) {
                    batas_absen_datang_opsi = (data.filter(row => {
                        return row.varname === 'batas_absen_datang_opsi';
                    }))[0].val;
                    batas_absen_datang = (data.filter(row => {
                        return row.varname === 'batas_absen_datang';
                    }))[0].val;
                    spot_hadir_opsi = (data.filter(row => {
                        return row.varname === 'spot_hadir_opsi';
                    }))[0].val;

                    if (batas_absen_datang_opsi === 'Y') {
                        checkBatasWaktuAbsen();
                    }
                }

                var checkBatasWaktuAbsen = function() {
                    let date = new Date();

                    let dateLimit = new Date(date.toISOString().substring(0, 10) + " " + batas_absen_datang);
                    if (date > dateLimit) {
                        let url = "{{ route('kehadiran.absen-datang.error') }}";
                        let message = 'Batas waktu pengisian Absen Datang (' + batas_absen_datang + ') telah berakhir.';
                        location.href = url + '?message=' + message;
                    }
                }

                var initMap = function() {
                    let lat = parseFloat($("#lat").val());
                    let lng = parseFloat($("#lng").val());

                    geocoder = new google.maps.Geocoder();
                    var latlng = new google.maps.LatLng(lat, lng);
                    //console.log("latlng:" + latlng);
                    var mapOptions = {
                        zoom: 11,
                        center: latlng
                    }
                    map = new google.maps.Map(document.getElementById('map'), mapOptions);

                    marker = new google.maps.Marker({
                        map: map,
                        position: {
                            lat: lat,
                            lng: lng
                        }
                    });

                    if (spotid != '') {
                        circle = new google.maps.Circle({
                            map,
                            center: {
                                lat: parseFloat(spot.lat),
                                lng: parseFloat(spot.lng)
                            },
                            radius: parseFloat(spot.radius),
                        });

                        let bounds = circle.getBounds().contains( latlng );
                        if (bounds === true) {
                            let status = (status_spot.filter(row => {
                                return row.status_spot === 1;
                            }))[0];
                            console.log("status: ", status);
                            $("#status_spot").val(status.status_spot);
                            $("#lokasi-status").text(status.status_spot_text);
                            $("#lokasi-status").removeClass('d-none').css({
                                'background': status.status_spot_color
                            })
                        } else {
                            let status = (status_spot.filter(row => {
                                return row.status_spot === 2;
                            }))[0];

                            $("#status_spot").val(status.status_spot);
                            $("#lokasi-status").text(status.status_spot_text);
                            $("#lokasi-status").removeClass('d-none').css({
                                'background': status.status_spot_color
                            });

                            let tmp = `<div class="mb-5">
                            <div class="alert alert-danger">
                             Anda berada diluar radius spot lokasi tugas anda.
                             Klik <a href="https://www.google.com/maps/place/${spot.alamat}/@${spot.lat},${spot.lng},15z" target="blank">disini</a> untuk melihat spot lokasi tugas anda.
                             </div>
                             <div>`;
                            $("#alert-status").empty().append(tmp);
                        }
                    }
                }

                var initDateTime = function() {
                    let datetime = getCurrentDateTime();
                    let date = datetime[0];
                    let time = datetime[1];

                    $("#tanggal_hari_ini").text(date);
                    $("#tgl").val(dateFormat(moment()));
                    $("#waktu").val(time);
                }

                var initWaktuBagian = function() {
                    let waktu_bagian = zona_waktu.filter(row => {
                        return row.gmt === getTimeZone();
                    })[0].zona_waktu;
                    $("#waktu_bagian").val(waktu_bagian);
                }

                var handleControl = function() {
                    $("#btn-store").click(function(e) {
                        e.preventDefault();

                        validatorConfigs.rules = {
                            tgl: {
                                required: true,
                            },
                            waktu: {
                                required: true,
                            },
                            waktu_bagian: {
                                required: true,
                            },
                            lokasi: {
                                required: true,
                            },
                            lat: {
                                required: true,
                            },
                            lng: {
                                required: true,
                            },
                            swafoto: {
                                required: true,
                            },
                            catatan: {
                                maxlength: 4000,
                            }
                        };

                        let form = $("#app-form");
                        let validator = form.validate(validatorConfigs);

                        if (!form.valid()) {
                            validator.focusInvalid();
                            return;
                        }
                        let data = new FormData(form[0]);
                        let url = apiUrl + "/absen-hadir";
                        ajaxSave(url, data, onDataSaved)
                    });
                }

                var setLocationData = function(data) {
                    $("#lokasi").val(data.formatted_address);
                    $("#lat").val(data.geometry.location.lat());
                    $("#lng").val(data.geometry.location.lng());
                    $("#prov").val(data.address_components[3].long_name);
                    $("#kab").val(data.address_components[2].long_name);
                    $("#kec").val(data.address_components[1].long_name);
                    $("#desa").val(data.address_components[0].long_name);
                }

                var getLocation = function() {
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
                                        setLocationData(results[0]);
                                        initMap();
                                    } else {
                                        alertWarning('Lokasi tidak ditemukan.');
                                    }
                                });
                            },
                            () => {
                                //handleLocationError(true, infoWindow, map.getCenter());
                                alertError('Harap mengaktifkan pengaturan Lokasi di Browser anda.');
                            }
                        );
                    } else {
                        // Browser doesn't support Geolocation
                        alertError('Browser anda tidak support pendeteksi Lokasi.');
                    }
                }

                var onDataSaved = function() {
                    location.href = "{{ route('kehadiran.absen-datang.success') }}"
                }

                // Public methods
                return {
                    init: function() {
                        checkIzinCuti();
                        checkAlreadyAbsen();
                        getConfig();
                        getSpot();
                        getZonaWaktu();
                        getLocation();

                        setInterval(initDateTime, 1000);
                        initWaktuBagian();

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
