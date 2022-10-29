<x-app-full-layout>
    <x-slot name="page_title">Personil</x-slot>
    <x-app-card>
        <x-slot name="title">

        </x-slot>
        <x-slot name="toolbar">
            <x-app-btn-back href="{{ route('pengaturan.personil') }}"></x-app-btn-back>
        </x-slot>

        <form id="app-form" enctype="multipart/form-data">
            <input type="hidden" name="created_by" value="{{ auth()->id() }}">
            <div class="row">
                <div class="col-lg-6">
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Nama Lengkap</x-app-label>
                        <x-app-input-text name="fullname" id="fullname"></x-app-input-text>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Nama Singkat</x-app-label>
                        <x-app-input-text name="nickname" id="nickname"></x-app-input-text>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">NIK</x-app-label>
                        <x-app-input-text name="nik" id="nik"></x-app-input-text>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Tanggal lahir</x-app-label>
                        <x-app-input-text name="tgl_lahir" id="tgl_lahir"></x-app-input-text>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Jenis Kelamin</x-app-label>
                        <x-app-select name="jenis_kelamin" id="jenis_kelamin">
                            <option value="">Pilih Opsi</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </x-app-select>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Aktif</x-app-label>
                        <x-app-select name="aktif" id="aktif">
                            <option value="">Pilih Opsi</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </x-app-select>
                        <div class="text-muted">
                            Jika tidak Aktif maka tidak bisa login ke dalam semua aplikasi
                            UPLAND
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-5">
                        <x-app-label class="w-100">Foto Profile</x-app-label>
                        <div class="d-block">
                            <div class="image-input image-input-empty image-input-outline" data-kt-image-input="true">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-125px h-125px border-1 border-secondary form-control">
                                </div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="bi bi-pencil-fill fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="photo" />
                                    <input type="hidden" name="avatar_remove" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span
                                    class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="bi bi-x fs-2"></i>
                                </span>
                                <!--end::Cancel-->
                            </div>
                        </div>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">No HP</x-app-label>
                        <x-app-input-text name="telpno" id="telpno"></x-app-input-text>
                        <div class="text-muted">Direkomendasikan memiliki aplikasi WhatsApp</div>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label>Alamat</x-app-label>
                        <x-app-textarea name="alamat" id="alamat" rows="9"></x-app-textarea>
                    </div>
                </div>
            </div>

            <x-app-form-title>Absensi & Spot</x-app-form-title>
            <div class="row">
                <div class="col-lg-6 fv-row">
                    <x-app-label class="required">Personil Absen</x-app-label>
                    <x-app-select name="wajib_absen" id="wajib_absen">
                        <option value="">Pilih Opsi</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </x-app-select>
                </div>
                <div class="col-lg-6 fv-row">
                    <x-app-label>Spot Kehadiran</x-app-label>
                    <x-app-select name="spotid" id="spotid">
                        <option value="">Pilih Opsi</option>
                    </x-app-select>
                </div>
            </div>

            <x-app-form-title>Email & Password</x-app-form-title>
            <div class="row">
                <div class="col-lg-6 fv-row">
                    <x-app-label class="required">Email</x-app-label>
                    <x-app-input-text name="email" id="email"></x-app-input-text>
                </div>
                <div class="col-lg-3 fv-row">
                    <x-app-label class="required">Password</x-app-label>
                    <x-app-input-password name="password" id="password"></x-app-input-password>
                </div>
                <div class="col-lg-3 fv-row">
                    <x-app-label class="required">Konfirmasi Password</x-app-label>
                    <x-app-input-password name="password_confirmation" id="password_confirmation"></x-app-input-password>
                </div>
            </div>

            <x-app-form-title>Peran & Lokasi Penugasan</x-app-form-title>
            <div class="row">
                <div class="col-lg-6 fv-row">
                    <x-app-label class="required">Peran</x-app-label>
                    <x-app-select name="roleid" id="roleid">
                        <option value=""></option>
                    </x-app-select>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-5">
                        <x-app-label>Kabupaten</x-app-label>
                        <x-app-select name="kdkab" id="kdkab">
                            <option value=""></option>
                        </x-app-select>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label>Kecamatan</x-app-label>
                        <x-app-select name="kdkec" id="kdkec">
                            <option value=""></option>
                        </x-app-select>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label>Desa</x-app-label>
                        <x-app-select name="kddesa" id="kddesa">
                            <option value=""></option>
                        </x-app-select>
                    </div>
                </div>
            </div>
        </form>

        <x-slot name="footer">
            <x-app-btn-save id="btn-create" class="float-end"></x-app-btn-save>
        </x-slot>
    </x-app-card>

    <x-slot name="scripts">
        <script>
            "use strict";

            var moduleControl = function() {
                var disabledWilControl = function() {
                    $("#kdkab, #kdkec, #kddesa")
                        .empty()
                        .select2({
                            placeholder: "Pilih Opsi",
                            disabled: true,
                            data: []
                        })
                }

                var initControl = function() {
                    // roleid
                    $("#roleid").select2({
                        placeholder: "Pilih Opsi",
                        ajax: {
                            url: apiUrl + '/role/select2',
                            dataType: 'json'
                        }
                    })

                    // spotid
                    $("#spotid").select2({
                        placeholder: "Pilih Opsi",
                        ajax: {
                            url: apiUrl + '/spot/select2',
                            dataType: 'json'
                        }
                    })

                    //datepicker
                    $("#tgl_lahir").daterangepicker(datePickerConfig);
                    $("#tgl_lahir").on("apply.daterangepicker", function(ev, picker) {
                        $(this).val(picker.startDate.format("DD-MM-YYYY"));
                    });
                }

                var handleControl = function() {
                    $("#roleid").on('select2:select', function(e) {
                        let data = $(this).select2('data')[0];

                        disabledWilControl();

                        if (data.kab == 1) {
                            $("#kdkab").select2({
                                placeholder: "Pilih Opsi",
                                disabled: false,
                                ajax: {
                                    url: apiUrl + '/kab/select2',
                                    dataType: 'json'
                                }
                            })
                        }
                        if (data.kec == 1) {
                            $("#kdkec").select2({
                                placeholder: "Pilih Opsi",
                                disabled: false,
                                ajax: {
                                    url: apiUrl + '/kec/select2',
                                    dataType: 'json',
                                    data: function(params) {
                                        return {
                                            q: params.term, // search term
                                            kdkab: $("#kdkab").val() ?? -1
                                        };
                                    },
                                }
                            })
                        }
                        if (data.desa == 1) {
                            $("#kddesa").select2({
                                placeholder: "Pilih Opsi",
                                disabled: false,
                                ajax: {
                                    url: apiUrl + '/desa/select2',
                                    dataType: 'json',
                                    data: function(params) {
                                        return {
                                            q: params.term, // search term
                                            kdkec: $("#kdkec").val() ?? -1
                                        };
                                    },
                                }
                            })
                        }
                    });

                    $("#kdkab").on('select2:select', function(e) {
                        $("#kdkec").val("").trigger("change");
                        $("#kddesa").val("").trigger("change");
                    })
                    $("#kdkec").on('select2:select', function(e) {
                        $("#kddesa").val("").trigger("change");
                    })

                    $("#btn-create").click(function(e) {
                        e.preventDefault();

                        validatorConfigs.rules = {
                            fullname: {
                                required: true,
                                maxlength: 500,
                            },
                            nickname: {
                                required: true,
                                maxlength: 50,
                            },
                            nik: {
                                required: true,
                                maxlength: 16,
                                minlength: 16,
                            },
                            tgl_lahir: {
                                required: true,
                            },
                            jenis_kelamin: {
                                required: true,
                            },
                            aktif: {
                                required: true,
                            },
                            photo: {
                                required: false,
                            },
                            telpno: {
                                required: true,
                            },
                            alamat: {
                                required: false,
                            },
                            wajib_absen: {
                                required: true,
                            },
                            spotid: {
                                required: false,
                            },
                            email: {
                                required: true,
                                email: true,
                            },
                            password: {
                                required: true,
                            },
                            password_confirmation: {
                                required: true,
                                equalTo: "#password"
                            },
                            roleid: {
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
                        let url = apiUrl + "/user";
                        ajaxSave(url, data, onDataSaved)
                    });
                }

                var onDataSaved = function(){
                    location.href = "{{ route('pengaturan.personil') }}"
                }

                // Public methods
                return {
                    init: function() {
                        disabledWilControl();
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
