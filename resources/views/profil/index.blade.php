<x-app-full-layout>
    <x-slot name="page_title">Profil Saya</x-slot>
    <x-app-card class="pt-5">
        <form id="app-form" enctype="multipart/form-data">
            <input type="hidden" name="modified_by" value="{{ auth()->id() }}">
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
                        <x-app-select name="aktif" id="aktif" disabled>
                            <option value="">Pilih Opsi</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </x-app-select>
                        <span class="text-muted">Jika tidak Aktif maka tidak bisa login ke dalam semua aplikasi
                            UPLAND</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-5">
                        <x-app-label class="w-100">Foto Profile</x-app-label>
                        <div class="d-block">
                            <div class="image-input image-input-outline" data-kt-image-input="true">
                                <!--begin::Preview existing avatar-->
                                <div id="display-photo"
                                    class="image-input-wrapper w-125px h-125px border-1 border-secondary form-control">
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
                        <span class="text-muted">Direkomendasikan memiliki aplikasi WhatsApp</span>
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
                    <x-app-select name="wajib_absen" id="wajib_absen" disabled>
                        <option value="">Pilih Opsi</option>
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </x-app-select>
                </div>
                <div class="col-lg-6 fv-row">
                    <x-app-label>Spot Kehadiran</x-app-label>
                    <x-app-select name="spotid" id="spotid" disabled>
                        <option value="">Pilih Opsi</option>
                    </x-app-select>
                </div>
            </div>

            <x-app-form-title>Email</x-app-form-title>
            <div class="row">
                <div class="col-lg-12 fv-row">
                    <x-app-label class="required">Email</x-app-label>
                    <x-app-input-text name="email" id="email"></x-app-input-text>
                </div>
            </div>

            <x-app-form-title>Peran & Lokasi Penugasan</x-app-form-title>
            <div class="row">
                <div class="col-lg-6 fv-row">
                    <x-app-label class="required">Peran</x-app-label>
                    <x-app-select name="roleid" id="roleid" disabled>
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
            <x-app-btn-save id="btn-update" class="float-end"></x-app-btn-save>
        </x-slot>
    </x-app-card>

    <x-slot name="scripts">
        <script>
            "use strict";

            var moduleControl = function() {
                var data = null;
                var id = "{{ $id }}";

                var initData = function(data) {
                    $("#fullname").val(data.fullname);
                    $("#nickname").val(data.nickname);
                    $("#nik").val(data.nik);
                    $("#tgl_lahir").val(dateFormat(data.tgl_lahir));

                    $("#jenis_kelamin").val(data.jenis_kelamin);
                    $("#aktif").val(data.aktif);
                    $("#telpno").val(data.telpno);
                    $("#alamat").val(data.alamat);

                    if (data.photo) {
                        $('#display-photo').css('background-image', `url(${storageUrl}/${data.photo})`)
                        $(".image-input").addClass('image-input-changed');
                    }


                    //Absensi & Spot
                    $("#wajib_absen").val(data.wajib_absen);
                    if (data.spotid) {
                        let tmp = `<option value="${data.spotid}" selected>${data.spot.spot}<option>`;
                        $('#spotid').append(tmp);
                    }

                    //Email & Password
                    $("#email").val(data.email);


                    //Peran & Lokasi Penugasan
                    disabledWilControl();
                    if (data.roleid) {
                        let tmp = `<option value="${data.roleid}" selected>${data.role.rolename}<option>`;
                        $('#roleid').append(tmp);
                    }

                    if (data.kdkab) {
                        let tmp = `<option value="${data.kdkab}" selected>${data.kab.nmkab}<option>`;
                        $('#kdkab').append(tmp);
                        initKab(false);
                    }

                    if (data.kdkec) {
                        let tmp = `<option value="${data.kdkec}" selected>${data.kec.nmkec}<option>`;
                        $('#kdkec').append(tmp);
                        initKec(false);
                    }

                    if (data.kddesa) {
                        let tmp = `<option value="${data.kddesa}" selected>${data.desa.nmdesa}<option>`;
                        $('#kddesa').append(tmp);
                        initDesa(false);
                    }
                }

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
                            initKab(false);
                        }
                        if (data.kec == 1) {
                            initKec(false);
                        }
                        if (data.desa == 1) {
                            initDesa(false);
                        }
                    });

                    $("#kdkab").on('select2:select', function(e) {
                        $("#kdkec").val("").trigger("change");
                        $("#kddesa").val("").trigger("change");
                    })
                    $("#kdkec").on('select2:select', function(e) {
                        $("#kddesa").val("").trigger("change");
                    })


                    $("#btn-update").click(function(e) {
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
                            email: {
                                required: true,
                                email: true,
                            },
                        };

                        let form = $("#app-form");
                        let validator = form.validate(validatorConfigs);

                        if (!form.valid()) {
                            validator.focusInvalid();
                            return;
                        }
                        let data = new FormData(form[0]);
                        data.append('_method', 'put');
                        let url = apiUrl + "/user/" + id + "/update-profil";
                        ajaxSave(url, data, onSubmited)
                    });
                }

                var initKab = function(disabled) {
                    $("#kdkab").select2({
                        placeholder: "Pilih Opsi",
                        disabled: disabled,
                        ajax: {
                            url: apiUrl + '/kab/select2',
                            dataType: 'json'
                        }
                    })
                }

                var initKec = function(disabled) {
                    $("#kdkec").select2({
                        placeholder: "Pilih Opsi",
                        disabled: disabled,
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

                var initDesa = function(disabled) {
                    $("#kddesa").select2({
                        placeholder: "Pilih Opsi",
                        disabled: disabled,
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

                var onSubmited = function() {
                    location.href = "{{ route('profil-saya') }}";
                }

                // Public methods
                return {
                    init: function() {
                        $.get(apiUrl + "/user/" + id,
                            function(data) {
                                initData(data);
                                initControl();
                                handleControl();
                            },
                        );
                    }
                }
            }();

            KTUtil.onDOMContentLoaded(function() {
                moduleControl.init();
            });
        </script>
    </x-slot>
</x-app-full-layout>
