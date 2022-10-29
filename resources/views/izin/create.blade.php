<x-app-full-layout>
    <x-slot name="page_title">Izin & Cuti</x-slot>

    <form id="app-form">
        <input type="hidden" name="created_by" value="{{ auth()->id() }}">
        <x-app-card>
            <x-slot name="title">

            </x-slot>
            <x-slot name="toolbar">
                <x-app-btn-back href="{{ route('izin-cuti') }}"></x-app-btn-back>
            </x-slot>

            <div class="row">
                <div class="col-lg-6">
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Personil</x-app-label>
                        <x-app-select name="userid" id="userid">
                            <option value=""></option>
                        </x-app-select>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Jenis Izin</x-app-label>
                        <x-app-select name="jenis_izin" id="jenis_izin">
                            <option value=""></option>
                        </x-app-select>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Aktifitas</x-app-label>
                        <x-app-textarea name="aktifitas" id="aktifitas" rows="7"></x-app-textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Tanggal Dari</x-app-label>
                        <x-app-input-text name="tgl_dari" id="tgl_dari" readonly></x-app-input-text>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Tanggal Sampai</x-app-label>
                        <x-app-input-text name="tgl_sampai" id="tgl_sampai" readonly></x-app-input-text>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label>Durasi (hari)</x-app-label>
                        <x-app-input-text name="durasi" id="durasi" readonly />
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Dokumen</x-app-label>
                        <!--begin::Dropzone-->
                        <div class="dropzone" id="dz_dokumen">
                            <!--begin::Message-->
                            <div class="dz-message needsclick">
                                <!--begin::Icon-->
                                <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                <!--end::Icon-->

                                <!--begin::Info-->
                                <div class="ms-4">
                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Taruh atau Klik untuk upload File</h3>
                                    <span class="fs-7 fw-semibold text-gray-400">Maks 1 File</span>
                                </div>
                                <!--end::Info-->
                            </div>
                        </div>
                        <div class="text-muted">
                            Harap tunggu sampai proses selesai sebelum klik Simpan
                        </div>
                        <!--end::Dropzone-->
                        <div class="d-none">
                            <x-app-input-text name="dok_ori" id="dok_ori"></x-app-input-text>
                            <x-app-input-text name="dok_saved" id="dok_saved"></x-app-input-text>
                        </div>
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

                var userid = "{{ auth()->id() }}";

                var loadUser = function() {
                    $.ajax({
                        type: "get",
                        async: false,
                        url: apiUrl + "/user",
                        data: {
                            userid: userid,
                        },
                        dataType: "json",
                        success: function(response) {
                            let selected = '';
                            if (response.length == 1) {
                                selected = 'selected';
                            }
                            let tmp = `<option value=""></option>`;
                            response.forEach(row => {
                                tmp += `
                                <option data-email="${row.email}" value="${row.userid}" ${selected}>
                                    ${row.fullname}
                                </option>
                                `;
                            });
                            $("#userid").empty().append(tmp);
                        }
                    });
                }

                var loadRefIzin = function() {
                    $.ajax({
                        type: "get",
                        async: false,
                        url: apiUrl + "/izin/ref-jenis",
                        data: {
                            userid: userid,
                        },
                        dataType: "json",
                        success: function(response) {
                            let tmp = `<option value=""></option>`;
                            response.forEach(row => {
                                tmp += `
                                <option value="${row.jenis_izin}">
                                    ${row.jenis_izin}
                                </option>
                                `;
                            });
                            $("#jenis_izin").empty().append(tmp);
                        }
                    });
                }

                var filterOptionFormat = function(item) {
                    if (!item.id) {
                        return item.text;
                    }

                    var span = document.createElement('span');
                    var template = '';

                    template += '<div class="d-flex align-items-center">';
                    template += '<div class="d-flex flex-column">'
                    template += '<span class="fw-bold lh-1">' + item.text + '</span>';
                    template += '<span class="text-muted">' + item.element.getAttribute('data-email') + '</span>';
                    template += '</div>';
                    template += '</div>';

                    span.innerHTML = template;

                    return $(span);
                }

                var initControl = function() {
                    //begin::user
                    $("#userid").select2({
                        placeholder: 'Pilih Personil',
                        templateResult: filterOptionFormat
                    });
                    //end::user
                    //begin::user
                    $("#jenis_izin").select2({
                        placeholder: 'Pilih Opsi',
                    });
                    //end::user

                    $("#tgl_dari").daterangepicker(datePickerConfig);
                    $("#tgl_dari").on("apply.daterangepicker", function(ev, picker) {
                        $(this).val(picker.startDate.format("DD-MM-YYYY"));
                        //$("#tgl_sampai").val(picker.startDate.format("DD-MM-YYYY"));
                        //$("#tgl_sampai").daterangepicker(datePickerConfig);
                        hitungDurasi();
                    });

                    $("#tgl_sampai").daterangepicker(datePickerConfig);
                    $("#tgl_sampai").on("apply.daterangepicker", function(ev, picker) {
                        $(this).val(picker.startDate.format("DD-MM-YYYY"));
                        hitungDurasi();
                    });

                    //begin::dropzone
                    var myDropzone = new Dropzone("#dz_dokumen", {
                        url: apiUrl + "/izin/upload-dok", // Set the url for your upload script location
                        paramName: "file", // The name that will be used to transfer the file
                        maxFiles: 1,
                        maxFilesize: 10, // MB
                        addRemoveLinks: true,
                        acceptedFiles: ".jpg,.png,.pdf"
                    });

                    myDropzone.on("success", function(file, res) {
                        $("#dok_ori").val(res.dok_ori);
                        $("#dok_saved").val(res.dok_saved);
                    });

                    myDropzone.on("complete", function(file) {
                        //myDropzone.removeFile(file);
                    });
                    //end::dropzone
                }

                var hitungDurasi = function() {
                    if ($("#tgl_dari").val() != "" && $("#tgl_sampai").val() != "") {
                        var tgl_dari = moment($("#tgl_dari").val(), 'DD-MM-YYYY');
                        var tgl_sampai = moment($("#tgl_sampai").val(), 'DD-MM-YYYY');
                        var duration = moment.duration(tgl_sampai.diff(tgl_dari)).asDays() + 1;
                        if (duration < 1) {
                            alertError(
                                "Durasi Izin atau Cuti tidak boleh kurang dari 1 hari. Periksa kembali tanggal Dari dan Sampai"
                            );
                            $("#tgl_sampai").val("");
                            $("#durasi").val("")
                            return;
                        }
                        $("#durasi").val(duration)
                    }

                }

                var handleControl = function() {
                    $("#btn-create").click(function(e) {
                        e.preventDefault();

                        validatorConfigs.rules = {
                            jenis_izin: {
                                required: true,
                                maxlength: 255,
                            },
                            aktifitas: {
                                required: true,
                                maxlength: 255,
                            },
                            tgl_dari: {
                                required: true,
                            },
                            tgl_dari: {
                                required: true,
                            },
                            tgl_sampai: {
                                required: true,
                            },
                            userid: {
                                required: true,
                            },
                        };

                        let form = $("#app-form");
                        let validator = form.validate(validatorConfigs);

                        if (!form.valid()) {
                            validator.focusInvalid();
                            return;
                        }
                        let data = new FormData(form[0]);
                        let url = apiUrl + "/izin";
                        ajaxSave(url, data, onDataSaved)
                    });
                }


                var onDataSaved = function() {
                    location.href = "{{ route('izin-cuti') }}";
                }


                // Public methods
                return {
                    init: function() {
                        loadUser();
                        loadRefIzin();


                        initControl();
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
