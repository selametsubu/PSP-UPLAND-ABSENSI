<x-app-register-layout>
    <div class="fv-row fw-semibold mb-5">
        Sudah terdaftar ? Ayo  <a href="{{ route('login') }}" class="text-orange">Login disini</a>
    </div>
    <div class="card shadow-sm text-dark mb-10" data-theme="light">
        <div class="card-header">
            <div class="card-title h1">
                <h1 class="h1 text-orange text-uppercase">Pendaftaran Absensi</h1>
            </div>
            <div class="card-toolbar">
                <img src="{{ asset('media/logos/upland.png') }}" alt="" style="height: 75px">
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}" id="form-register" enctype="multipart/form-data">
                @csrf



                <section id="section-biodata">

                    <x-app-form-title>Biodata</x-app-form-title>

                    <div class="bg-light-warning p-3 fs-5">
                        Masukkan biodata anda dengan lengkap pada isian yang tersedia di bawah ini. Pastikan email dan
                        nomor
                        handphone yang anda masukkan aktif
                    </div>

                    <div class="row mt-10">
                        <div class="col-lg-6">
                            <x-app-form-group>
                                <x-app-label required="true">Nama Lengkap</x-app-label>
                                <x-app-input-text name="fullname"></x-app-input-text>
                            </x-app-form-group>

                            <x-app-form-group>
                                <x-app-label required="true">Nama Singkat</x-app-label>
                                <x-app-input-text name="nickname"></x-app-input-text>
                            </x-app-form-group>
                        </div>
                        <div class="col-lg-6">

                            <!--begin::Image input-->
                            <div class="fv-row">
                                <x-app-label required="true" class="w-100">Foto Profile</x-app-label>
                                <div class="d-block">
                                    <div class="image-input image-input-outline" data-kt-image-input="true"
                                        style="background-image: url("{{ asset('media/svg/avatars/blank.svg') }}")">
                                        <!--begin::Preview existing avatar-->
                                        <div
                                            class="image-input-wrapper w-125px h-125px border-1 border-secondary form-control">
                                        </div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                            title="Change avatar">
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
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            title="Cancel avatar">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <!--end::Cancel-->
                                    </div>
                                </div>

                            </div>
                            <!--end::Image input-->
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <x-app-form-group>
                                <x-app-label required="true">NIK</x-app-label>
                                <x-app-input-text name="nik" maxlength="16" minlength="16"></x-app-input-text>
                            </x-app-form-group>
                        </div>
                        <div class="col-lg-6">
                            <x-app-form-group>
                                <x-app-label required="true">Nomor HP/Telp</x-app-label>
                                <span></span>
                                <x-app-input-text name="telpno"></x-app-input-text>
                                <div class="text-muted">(Direkomendasikan memiliki aplikasi WhatsApp)</div>
                            </x-app-form-group>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <x-app-form-group>
                                <x-app-label required="true">Tanggal Lahir</x-app-label>
                                <x-app-input-date name="tgl_lahir" id="tgl_lahir"></x-app-input-date>
                            </x-app-form-group>
                        </div>
                        <div class="col-lg-6">
                            <x-app-form-group>
                                <x-app-label required="true">Tanggal Join di Upland</x-app-label>
                                <x-app-input-date name="tgl_join" id="tgl_join"></x-app-input-date>
                            </x-app-form-group>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <x-app-form-group>
                                <x-app-label required="true">Jenis Kelamin</x-app-label>
                                <x-app-select name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="">Pilih Opsi</option>
                                </x-app-select>
                            </x-app-form-group>
                        </div>
                        <div class="col-lg-6">
                            <x-app-form-group>
                                <x-app-label required="true">Alamat</x-app-label>
                                <x-app-textarea name="alamat"></x-app-textarea>
                            </x-app-form-group>
                        </div>
                    </div>
                </section>

                <div class="row">
                    <div class="col-lg-6">
                        <section id="section-peran-lokasi-penugasan">
                            <x-app-form-title>Peran & Lokasi Penugasan</x-app-form-title>

                            <x-app-form-group>
                                <x-app-label required="true">Peran</x-app-label>
                                <x-app-select name="roleid" id="roleid">
                                    <option value="">Pilih Opsi</option>
                                </x-app-select>
                            </x-app-form-group>

                            <x-app-form-group>
                                <x-app-label>Kabupaten</x-app-label>
                                <x-app-select name="kdkab" id="kdkab" disabled>
                                    <option value="">Pilih Opsi</option>
                                </x-app-select>
                            </x-app-form-group>
                            <x-app-form-group>
                                <x-app-label>Kecamatan</x-app-label>
                                <x-app-select name="kdkec" id="kdkec" disabled>
                                    <option value="">Pilih Opsi</option>
                                </x-app-select>
                            </x-app-form-group>
                            <x-app-form-group>
                                <x-app-label>Desa</x-app-label>
                                <x-app-select name="kddesa" id="kddesa" disabled>
                                    <option value="">Pilih Opsi</option>
                                </x-app-select>
                            </x-app-form-group>
                        </section>
                    </div>
                    <div class="col-lg-6">
                        <section id="section-email-password">
                            <x-app-form-title>Email & Password</x-app-form-title>
                            <x-app-form-group>
                                <x-app-label required="true">Email</x-app-label>
                                <x-app-input-text name="email"></x-app-input-text>
                            </x-app-form-group>
                            <x-app-form-group>
                                <x-app-label required="true">Password</x-app-label>
                                <x-app-input-password name="password"  id="password">
                                </x-app-input-password>
                            </x-app-form-group>
                            <x-app-form-group>
                                <x-app-label required="true">Konfirmasi Password</x-app-label>
                                <x-app-input-password name="password_confirmation" id="password_confirmation">
                                </x-app-input-password>
                            </x-app-form-group>
                        </section>
                    </div>
                </div>


                <div class="row">
                    <x-app-label required="true" class="col-lg-12">Kode Kemanan</x-app-label>
                    <div class="col-lg-2">
                        <div id="captha-content">

                        </div>
                    </div>
                    <div class="col-lg-4 fv-row">
                        <x-app-input-text name="captcha"></x-app-input-text>
                        <div class="text-muted">Inputkan nilai hasil perhitungan pada kode keamanan</div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-10">

                </div>
                <div class="col-lg-2 d-grid">
                    <x-app-btn-save id="btn-save" />
                </div>
            </div>

        </div>
    </div>

    <x-slot name="scripts">
        <script>
            var moduleControl = (function() {
                let loadCaptha = function() {
                    $.ajax({
                        type: "get",
                        url: "{{ route('register.data_captha') }}",
                        dataType: "json",
                        success: function(response) {
                            let tmp = `<img src="${response.url}" alt="${response.url}"
                                class="img w-100 border border-secondary p-1">`;
                            $("#captha-content").empty().html(tmp);
                        }
                    });
                }

                let initForm = function() {
                    // begin::jenis kelamin
                    let jenisKelamin = {!! $jenis_kelamin !!};
                    jenisKelamin.forEach(element => {
                        let options =
                            `<option value="${element.jenis_kelamin}">${element.jenis_kelamin}</option>`;
                        $("#jenis_kelamin").append(options);
                    });
                    // end::jenis kelamin

                    // begin::peran
                    let peran = {!! $peran !!};
                    peran.forEach(element => {
                        let options =
                            `<option value="${element.roleid}"
                                data-kab="${element.kab ?? ''}"
                                data-kec="${element.kec ?? ''}"
                                data-desa="${element.desa ?? ''}"
                            >
                                ${element.rolename}
                            </option>`;
                        $("#roleid").append(options);
                    });

                    $("#roleid").change(function(e) {
                        e.preventDefault();

                        let kab = $(this).find(":selected").attr('data-kab');
                        let kec = $(this).find(":selected").attr('data-kec');
                        let desa = $(this).find(":selected").attr('data-desa');

                        $("#kdkab, #kdkec, #kddesa").attr("disabled", "disabled");
                        $('#kdkab, #kdkec, #kddesa').val(null).trigger('change');

                        if (kab) {
                            $("#kdkab").removeAttr("disabled");
                        }
                        if (kec) {
                            $("#kdkec").removeAttr("disabled");
                        }
                        if (desa) {
                            $("#kddesa").removeAttr("disabled");
                        }
                    });
                    // end::peran

                    //begin::kabupaten
                    $('#kdkab').select2({
                        width: "100%",
                        placeholder: 'Pilih Opsi',
                        ajax: {
                            url: "{{ route('register.data_kab') }}",
                            dataType: 'json',
                        }
                    });
                    //end::kabupaten

                    //begin::kecamatan
                    $('#kdkec').select2({
                        placeholder: 'Pilih Opsi',
                        ajax: {
                            url: "{{ route('register.data_kec') }}",
                            dataType: 'json',
                            data: function(params) {
                                var query = {
                                    q: params.term,
                                    kdkab: $("#kdkab").val()
                                }
                                return query;
                            }
                        }
                    });
                    //end::kecamatan

                    //begin::desa
                    $('#kddesa').select2({
                        placeholder: 'Pilih Opsi',
                        ajax: {
                            url: "{{ route('register.data_desa') }}",
                            dataType: 'json',
                            data: function(params) {
                                var query = {
                                    q: params.term,
                                    kdkec: $("#kdkec").val()
                                }
                                return query;
                            }
                        }
                    });
                    //end::desa

                    //begin::save
                    $("#btn-save").click(function(e) {
                        e.preventDefault();
                        saveRegister();
                    });
                    //end::save
                }

                let saveRegister = function() {
                    let form = $("#form-register");

                    validatorConfigs.rules = {
                        fullname: {
                            required: true,
                        },
                        nickname: {
                            required: true,
                        },
                        nik: {
                            required: true,
                            minlength: 16,
                            maxlength: 16,
                        },
                        tgl_lahir: {
                            required: true,
                        },
                        jenis_kelamin: {
                            required: true,
                        },
                        photo: {
                            required: true,
                            extension: "jpg|png|jpeg"
                        },
                        telpno: {
                            required: true,
                        },
                        tgl_join: {
                            required: true,
                        },
                        alamat: {
                            required: true,
                            maxlength: 4000,
                        },
                        roleid: {
                            required: true,
                        },
                        email: {
                            required: true,
                            email: true,
                        },
                        password: {
                            required: true,
                            minlength: 8
                        },
                        password_confirmation: {
                            required: true,
                            equalTo: "#password"
                        },
                        captcha: {
                            required: true,
                        }
                    };
                    let validator = form.validate(validatorConfigs);

                    if (!form.valid()) {
                        validator.focusInvalid();
                        return false;
                    }

                    //ajaxFormSaveCallback(form, onRegisterSuccess);
                    $.ajax({
                        url: form.attr("action"),
                        type: form.attr("method"),
                        data: new FormData(form[0]),
                        dataType: "JSON",
                        processData: false,
                        contentType: false,
                        beforeSend: function(body) {
                            blockUI.block();
                        },
                        success: function(res) {
                            blockUI.release();
                            alertSavedCallback(res.message, onRegisterSuccess);
                        },
                        error: function(xhr) {
                            alertError(JSON.stringify(xhr.responseJSON.errors));
                            loadCaptha();
                        },
                        complete: function() {
                            blockUI.release();
                        },
                    });
                }

                let onRegisterSuccess = function() {
                    let url = "{{ route('login') }}";
                    location.href = url;
                }

                return {
                    //main function to initiate the module
                    init: function() {
                        initForm();
                        loadCaptha();
                    }
                };
            })();
            jQuery(document).ready(function() {
                moduleControl.init();
            });
        </script>
    </x-slot>

</x-app-register-layout>
