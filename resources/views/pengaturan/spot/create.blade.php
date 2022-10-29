<x-app-full-layout>
    <x-slot name="page_title">Spot Kehadiran</x-slot>

    <form id="app-form">
        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
        <x-app-card>
            <x-slot name="title">

            </x-slot>
            <x-slot name="toolbar">
                <x-app-btn-back href="{{ route('pengaturan.spot') }}"></x-app-btn-back>
            </x-slot>

            <div class="alert alert-warning">
                Ketik Lokasi yang akan dicari pada Input Cari Lokasi,
                kemudian Pilih Lokasi pilihan yang muncul pada Input Pilih Lokasi
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-1">
                        <x-app-input-text placeholder="Cari Lokasi" id="address"></x-app-input-text>
                    </div>

                    <div class="mb-1">
                        <x-app-select id="lokasi" name="lokasi">

                        </x-app-select>
                    </div>

                    <div id="map" class="border h-600px">

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Alamat</x-app-label>
                        <x-app-textarea name="alamat" id="alamat" rows="5" readonly></x-app-textarea>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Latitude</x-app-label>
                        <x-app-input-text name="lat" id="lat" readonly></x-app-input-text>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Longitude</x-app-label>
                        <x-app-input-text name="lng" id="lng" readonly></x-app-input-text>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Nama Spot</x-app-label>
                        <x-app-input-text name="spot" id="spot"></x-app-input-text>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Radius (m)</x-app-label>
                        <x-app-input-text type="number" name="radius" id="radius"></x-app-input-text>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label>Catatan</x-app-label>
                        <x-app-textarea name="catatan" id="catatan" rows="5"></x-app-textarea>
                    </div>
                </div>
            </div>
            <x-slot name="footer">
                <x-app-btn-save type="button" class="float-end" id="btn-create"></x-app-btn-save>
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
                var locations = [];

                var initLocation = function(results) {
                    $("#lokasi").select2({
                        placeholder: 'Pilih Lokasi'
                    });

                    $("#lokasi").empty();
                    $("#lokasi").val('').trigger('change')

                    Object.entries(results).forEach(entry => {
                        const [key, value] = entry;

                        let tmp =
                            `<option value="${key}">${value.formatted_address}<option>`;
                        $("#lokasi").append(tmp);
                    });
                }

                var handleLocation = function() {
                    $("#lokasi").on("select2:select", function() {
                        let val = $(this).val()
                        setLocationData(locations[val])
                    });

                    $('#address').change(function(e) {
                        e.preventDefault();
                        clear();
                        searchAddress();
                    });
                }

                var setLocationData = function(data) {
                    $("#alamat").val(data.formatted_address);
                    $("#lat").val(data.geometry.location.lat());
                    $("#lng").val(data.geometry.location.lng());
                }

                var initMap = function() {
                    if ($("#radius").val() == '' || $("#lat").val() == "" || $("#lng").val() == "") {
                        geocoder = new google.maps.Geocoder();
                        var latlng = new google.maps.LatLng(-34.397, 150.644);
                        var mapOptions = {
                            zoom: 11,
                            center: latlng
                        }
                        map = new google.maps.Map(document.getElementById('map'), mapOptions);
                        return;
                    }

                    let lat = parseFloat($("#lat").val());
                    let lng = parseFloat($("#lng").val());
                    let radius = parseFloat($("#radius").val());

                    geocoder = new google.maps.Geocoder();
                    var latlng = new google.maps.LatLng(lat, lng);

                    var mapOptions = {
                        zoom: map.zoom ?? 11,
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

                    circle = new google.maps.Circle({
                        map,
                        center: {
                            lat: lat,
                            lng: lng
                        },
                        radius: parseFloat(radius),
                    });
                }

                var handleControl = function() {
                    $("#radius").change(function(e) {
                        e.preventDefault();
                        initMap();
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
                        let url = apiUrl + "/spot";
                        ajaxSave(url, data, onDataSaved)
                    });
                }

                var searchAddress = function() {
                    var address = document.getElementById('address').value;
                    geocoder.geocode({
                        'address': address
                    }, function(results, status) {
                        if (status == 'OK') {
                            map.setCenter(results[0].geometry.location);
                            map.zoom = 11;
                            marker = new google.maps.Marker({
                                map: map,
                                position: results[0].geometry.location
                            });

                            locations = results;

                            initLocation(results);
                            setLocationData(results[0]);

                        } else {
                            initLocation([]);
                            alertWarning('Lokasi tidak ditemukan.');
                        }
                    });
                }

                var clear = function() {
                    if (marker) {
                        marker.setMap(null);
                    }

                    if (circle) {
                        circle.setMap(null);
                    }
                }

                var onDataSaved = function() {
                    location.href = "{{ route('pengaturan.spot') }}";
                }


                // Public methods
                return {
                    init: function() {
                        initMap();
                        initLocation([]);

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
