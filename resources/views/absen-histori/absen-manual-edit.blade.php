<x-app-full-layout>
    <x-slot name="page_title">Absen Manual</x-slot>
    <x-slot name="hide_sidebar"></x-slot>

    <form id="app-form">
        <div class="d-none">
            <input type="text" name="created_by" value="{{ auth()->id() }}">
            <input type="text" name="userid" value="{{ $user->userid }}">
            <input type="text" name="tgl" value="{{ $tgl }}">
            <input type="text" name="lat_datang" id="lat_datang" value="{{ $data->lat_datang }}">
            <input type="text" name="lng_datang" id="lng_datang" value="{{ $data->lng_datang }}">
            <input type="text" name="lat_pulang" id="lat_pulang" value="{{ $data->lat_pulang }}">
            <input type="text" name="lng_pulang" id="lng_pulang" value="{{ $data->lng_pulang }}">
            <input type="text" name="status_spot_datang" id="status_spot_datang" value="{{ $data->datang_status_spot ?? 0 }}">
            <input type="text" name="status_spot_pulang" id="status_spot_pulang" value="{{ $data->pulang_status_spot ?? 0 }}">
        </div>

        <x-app-card>
            <x-slot name="title">
                <div class="small">
                    <span class="font-weight-bold text-warning">{{ $user->fullname }}</span> ({{ $user->email }}) | {{ $user->role->displayname }} | <span class="font-weight-bold text-warning">{{ $data->tgl }}</span> | {{ $data->hari }}
                </div>
            </x-slot>
            <hr>
            <x-slot name="toolbar">
                <x-app-btn-back href="#" onclick="window.history.back();"></x-app-btn-back>
            </x-slot>

            <div class="row">
                <div class="col-md-6">
                    <div class="font-weight-bold text-warning mb-5">Datang</div>
                    @php
                        $datang = \Carbon\Carbon::parse($data->tgl." ".$data->absen_datang)->format('H:i');
                        $pulang = \Carbon\Carbon::parse($data->tgl." ".$data->absen_pulang)->format('H:i');
                        $aktifitas = explode(", ",$data->aktifitas);
                    @endphp
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Jam</x-app-label>
                        <x-app-input-text name="waktu_datang" id="waktu_datang" type="time" value="{{ $datang }}"></x-app-input-text>
                    </div>

                    <div class="fv-row mb-5">
                        <x-app-label>Aktifitas/Catatan</x-app-label>
                        <textarea name="catatan_datang" id="catatan_datang" rows="3" class="form-control">{{ $aktifitas[0] ?? '' }}</textarea>
                    </div>

                    <div class="fv-row mb-5">
                        <x-app-label class="required">Lokasi</x-app-label>
                        <textarea name="lokasi_datang" id="alamat_datang" readonly class="form-control">{{ $data->datang_lokasi }}</textarea>
                    </div>

                    <div class="mb-1">
                        <x-app-input-text placeholder="Cari Lokasi" id="address_datang" value="{{ $data->datang_lokasi }}"></x-app-input-text>
                    </div>

                    <div class="mb-1">
                        <x-app-select id="lokasi_datang" value="{{ $data->datang_lokasi }}">

                        </x-app-select>
                    </div>

                    <div id="map_datang" class="border h-250px">

                    </div>

                    <div class="my-5 row">
                        <x-app-label class="col-lg-3 required">Foto</x-app-label>
                        <div class="col-lg-9 fv-row">
                            <div class="d-block  ">
                                <div class="image-input image-input-empty image-input-outline" data-kt-image-input="true">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper datang w-200px h-200px border-1 border-secondary form-control">
                                        @if ($data->swafoto_thumb_datang)
                                            <img src="{{asset('storage/'.$data->swafoto_thumb_datang)}}" width="100%" alt="">
                                        @endif
                                    </div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Pilih Foto">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="swafoto_datang" />
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
                </div>
                <div class="col-md-6">
                    <div class="font-weight-bold text-warning mb-5">Pulang</div>

                    <div class="fv-row mb-5">
                        <x-app-label class="required">Jam</x-app-label>
                        <x-app-input-text name="waktu_pulang" id="waktu_pulang" type="time" value="{{ $pulang }}"></x-app-input-text>
                    </div>

                    <div class="fv-row mb-5">
                        <x-app-label>Aktifitas/Catatan</x-app-label>
                        <textarea name="catatan_pulang" id="catatan_pulang" rows="3" class="form-control">{{ $aktifitas[1] ?? '' }}</textarea>
                    </div>

                    <div class="fv-row mb-5">
                        <x-app-label class="required">Lokasi</x-app-label>
                        <textarea name="lokasi_pulang" id="alamat_pulang" readonly class="form-control">{{ $data->pulang_lokasi }}</textarea>
                    </div>

                    <div class="mb-1">
                        <x-app-input-text placeholder="Cari Lokasi" id="address_pulang" value="{{ $data->pulang_lokasi }}"></x-app-input-text>
                    </div>

                    <div class="mb-1">
                        <x-app-select id="lokasi_pulang" value="{{ $data->pulang_lokasi }}">

                        </x-app-select>
                    </div>

                    <div id="map_pulang" class="border h-250px">

                    </div>

                    <div class="my-5 row">
                        <x-app-label class="col-lg-3 required">Foto</x-app-label>
                        <div class="col-lg-9 fv-row">
                            <div class="d-block  ">
                                <div class="image-input image-input-empty image-input-outline" data-kt-image-input="true">
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper pulang w-200px h-200px border-1 border-secondary form-control">
                                        @if ($data->swafoto_thumb_pulang)
                                            <img src="{{asset('storage/'.$data->swafoto_thumb_pulang)}}" width="100%" alt="">
                                        @endif
                                    </div>
                                    <!--end::Preview existing avatar-->
                                    <!--begin::Label-->
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Pilih Foto">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <!--begin::Inputs-->
                                        <input type="file" name="swafoto_pulang" />
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
                </div>
                <x-slot name="footer">
                    <x-app-btn-save type="button" class="float-end" id="btn-create"></x-app-btn-save>
                </x-slot>
                </div>
        </x-app-card>
    </form>
    <x-slot name="scripts">

        <script>
            "use strict";

            var moduleControl = function() {

                var geocoder_datang;
                var geocoder_pulang;
                var map_datang;
                var map_pulang;
                var marker_datang;
                var marker_pulang;
                var drawingManager_datang;
                var drawingManager_pulang;
                var circle_datang;
                var circle_pulang;
                var locations = [];
                var spotid = "{{ auth()->user()->spotid }}";
                var spot;
                var status_spot_datang = @json(config('ref.status_spot'));
                var status_spot_pulang = @json(config('ref.status_spot'));

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

                var initLocation = function(results, absenType) {
                    if (absenType == 'datang') {
                        $("#lokasi_datang").select2({
                            placeholder: 'Pilih Lokasi'
                        });

                        $("#lokasi_datang").empty();
                        $("#lokasi_datang").val('').trigger('change')

                        Object.entries(results).forEach(entry => {
                            const [key, value] = entry;

                            let tmp =
                                `<option value="${key}">${value.formatted_address}<option>`;
                            $("#lokasi_datang").append(tmp);
                        });
                    }else{
                        $("#lokasi_pulang").select2({
                            placeholder: 'Pilih Lokasi'
                        });

                        $("#lokasi_pulang").empty();
                        $("#lokasi_pulang").val('').trigger('change')

                        Object.entries(results).forEach(entry => {
                            const [key, value] = entry;

                            let tmp =
                                `<option value="${key}">${value.formatted_address}<option>`;
                            $("#lokasi_pulang").append(tmp);
                        });
                    }

                }

                var handleLocation = function() {
                    $("#lokasi_datang").on("select2:select", function() {
                        let val = $(this).val()
                        setLocationData(locations[val], 'datang')
                    });

                    $("#lokasi_pulang").on("select2:select", function() {
                        let val = $(this).val()
                        setLocationData(locations[val], 'pulang')
                    });

                    $('#address_datang').change(function(e) {
                        e.preventDefault();
                        clear('datang');
                        searchAddress('datang');
                    });

                    $('#address_pulang').change(function(e) {
                        e.preventDefault();
                        clear('pulang');
                        searchAddress('pulang');
                    });
                }

                var setLocationData = function(data, absenType) {
                    if (absenType == 'datang') {
                        handleSpot(data.geometry.location, absenType);
                        $("#alamat_datang").val(data.formatted_address);
                        $("#lat_datang").val(data.geometry.location.lat());
                        $("#lng_datang").val(data.geometry.location.lng());
                    }else{
                        handleSpot(data.geometry.location, absenType);
                        $("#alamat_pulang").val(data.formatted_address);
                        $("#lat_pulang").val(data.geometry.location.lat());
                        $("#lng_pulang").val(data.geometry.location.lng());
                    }
                }

                var initMapDatang = function() {
                    if ($("#lat_datang").val() == "" || $("#lng_datang").val() == "") {
                        geocoder_datang = new google.maps.Geocoder();
                        var latlng = new google.maps.LatLng(-34.397, 150.644);
                        var mapOptions = {
                            zoom: 11,
                            center: latlng
                        }
                        map_datang = new google.maps.Map(document.getElementById('map_datang'), mapOptions);
                        handleMapMarker('datang')
                        return;
                    }

                    let lat = parseFloat($("#lat_datang").val());
                    let lng = parseFloat($("#lng_datang").val());

                    geocoder_datang = new google.maps.Geocoder();
                    var latlng = new google.maps.LatLng(lat, lng);

                    var mapOptions = {
                        zoom: 11,
                        center: latlng
                    }
                    map_datang = new google.maps.Map(document.getElementById('map_datang'), mapOptions);

                    marker_datang = new google.maps.Marker({
                        map: map_datang,
                        position: {
                            lat: lat,
                            lng: lng
                        },
                        draggable: true
                    });

                    handleMapMarker('datang')
                }

                var handleSpot = function (latlng, absenType) {
                    if (spotid != '') {

                        if (absenType == 'datang') {
                            // create spot
                            circle_datang = new google.maps.Circle({
                                map_datang,
                                center: {
                                    lat: parseFloat(spot.lat),
                                    lng: parseFloat(spot.lng)
                                },
                                radius: parseFloat(spot.radius),
                            });

                            // checking spot
                            let bounds = circle_datang.getBounds().contains( latlng );
                            if (bounds === true) {
                                $("#status_spot_datang").val(1);
                            } else {
                                $("#status_spot_datang").val(2);
                                alertWarning('Anda berada diluar radius spot lokasi tugas anda.');
                            }
                            console.log($("#status_spot_datang").val());

                        }else{
                            // create spot
                            circle_pulang = new google.maps.Circle({
                                map_pulang,
                                center: {
                                    lat: parseFloat(spot.lat),
                                    lng: parseFloat(spot.lng)
                                },
                                radius: parseFloat(spot.radius),
                            });

                            // checking spot
                            let bounds = circle_pulang.getBounds().contains( latlng );
                            if (bounds === true) {
                                $("#status_spot_pulang").val(1);
                            } else {
                                $("#status_spot_pulang").val(2);
                                alertWarning('Anda berada diluar radius spot lokasi tugas anda.');
                            }
                            console.log($("#status_spot_pulang").val());
                        }
                    }
                }

                var initMapPulang = function() {
                    if ($("#lat_pulang").val() == "" || $("#lng_pulang").val() == "") {
                        geocoder_pulang = new google.maps.Geocoder();
                        var latlng = new google.maps.LatLng(-34.397, 150.644);
                        var mapOptions = {
                            zoom: 11,
                            center: latlng
                        }
                        map_pulang = new google.maps.Map(document.getElementById('map_pulang'), mapOptions);
                        handleMapMarker('pulang')
                        return;
                    }

                    let lat = parseFloat($("#lat_pulang").val());
                    let lng = parseFloat($("#lng_pulang").val());

                    geocoder_pulang = new google.maps.Geocoder();
                    var latlng = new google.maps.LatLng(lat, lng);

                    var mapOptions = {
                        zoom: 11,
                        center: latlng
                    }
                    map_pulang = new google.maps.Map(document.getElementById('map_pulang'), mapOptions);

                    marker_pulang = new google.maps.Marker({
                        map: map_pulang,
                        position: {
                            lat: lat,
                            lng: lng
                        },
                        draggable: true
                    });

                    handleMapMarker('pulang')
                }

                var handleMapMarker = function(absenType) {
                    if (absenType == 'datang') {
                        drawingManager_datang = new google.maps.drawing.DrawingManager({
                            drawingControl: true,
                            drawingControlOptions: {
                                position: google.maps.ControlPosition.TOP_CENTER,
                                drawingModes: [
                                    google.maps.drawing.OverlayType.MARKER,
                                ],
                            },
                            markerOptions: {
                                draggable: true
                            },
                        });

                        drawingManager_datang.setMap(map_datang);

                        google.maps.event.addListener(drawingManager_datang, 'overlaycomplete', function(event) {
                            if (marker_datang != undefined) {
                                marker_datang.setMap(null);
                            }
                            var data = {
                                type: event.type,
                                draw: ''
                            };

                            marker_datang = event.overlay;
                            data.draw = {
                                lat: event.overlay.position.lat(),
                                lng: event.overlay.position.lng(),
                            }

                            geocoder_datang.geocode({
                                "latLng": new google.maps.LatLng(event.overlay.position.lat(), event.overlay.position.lng()),
                            }, function(results, status) {
                                initLocation(results, "datang");
                                setLocationData(results[0], "datang");
                            });
                        })
                    }else{
                        drawingManager_pulang = new google.maps.drawing.DrawingManager({
                            drawingControl: true,
                            drawingControlOptions: {
                                position: google.maps.ControlPosition.TOP_CENTER,
                                drawingModes: [
                                    google.maps.drawing.OverlayType.MARKER,
                                ],
                            },
                            markerOptions: {
                                draggable: true
                            },
                        });

                        drawingManager_pulang.setMap(map_pulang);

                        google.maps.event.addListener(drawingManager_pulang, 'overlaycomplete', function(event) {
                            if (marker_pulang != undefined) {
                                marker_pulang.setMap(null);
                            }
                            var data = {
                                type: event.type,
                                draw: ''
                            };

                            marker_pulang = event.overlay;
                            data.draw = {
                                lat: event.overlay.position.lat(),
                                lng: event.overlay.position.lng(),
                            }

                            geocoder_pulang.geocode({
                                "latLng": new google.maps.LatLng(event.overlay.position.lat(), event.overlay.position.lng()),
                            }, function(results, status) {
                                initLocation(results, "pulang");
                                setLocationData(results[0], "pulang");
                            });
                        })
                    }
                }

                var handleControl = function() {
                    $('[name="swafoto_datang"]').change(function () {
                        $('.image-input-wrapper.datang img').remove();
                    });
                    $('[name="swafoto_pulang"]').change(function () {
                        $('.image-input-wrapper.pulang img').remove();
                    });
                    $("#btn-create").click(function(e) {
                        e.preventDefault();

                        validatorConfigs.rules = {
                            spot: {
                                required: true,
                                maxlength: 255,
                            },
                            radius: {
                                required: true,
                            },
                            alamat: {
                                required: true,
                                maxlength: 4000,
                            },
                            lat: {
                                required: true,
                            },
                            lng: {
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
                        let url = apiUrl + "/absen-manual";
                        ajaxSave(url, data, onDataSaved)
                    });
                }

                var searchAddress = function(absenType) {
                    if (absenType == 'datang') {
                        var address = document.getElementById('address_datang').value;

                        geocoder_datang.geocode({
                            'address': address
                        }, function(results, status) {
                            if (status == 'OK') {
                                map_datang.setCenter(results[0].geometry.location);
                                map_datang.zoom = 11;
                                marker_datang = new google.maps.Marker({
                                    map: map_datang,
                                    position: results[0].geometry.location,
                                    draggable: true
                                });

                                locations = results;

                                initLocation(results, absenType);
                                setLocationData(results[0], absenType);

                            } else {
                                initLocation([]);
                                alertWarning('Lokasi tidak ditemukan.');
                            }
                        });
                    }
                    if (absenType == 'pulang') {
                        var address = document.getElementById('address_pulang').value;

                        geocoder_pulang.geocode({
                            'address': address
                        }, function(results, status) {
                            if (status == 'OK') {
                                map_pulang.setCenter(results[0].geometry.location);
                                map_pulang.zoom = 11;
                                marker_pulang = new google.maps.Marker({
                                    map: map_pulang,
                                    position: results[0].geometry.location,
                                    draggable: true
                                });

                                locations = results;

                                initLocation(results, absenType);
                                setLocationData(results[0], absenType);

                            } else {
                                initLocation([]);
                                alertWarning('Lokasi tidak ditemukan.');
                            }
                        });
                    }
                }

                var clear = function(typeAbsen) {
                    if (typeAbsen == 'datang' && marker_datang) {
                        marker_datang.setMap(null);
                    }else if(typeAbsen == 'pulang' && marker_pulang){
                        marker_pulang.setMap(null);
                    }
                }

                var onDataSaved = function() {
                    location.href = "{{ route('absen.manual') }}"+`?p_userid={{$user->userid}}&p_date_from={{$p_date_from}}&p_date_to={{$p_date_to}}&p_global={{$p_global}}`
                }


                // Public methods
                return {
                    init: function() {
                        initMapDatang();
                        initMapPulang();
                        initLocation([]);
                        getSpot();

                        handleLocation();
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
