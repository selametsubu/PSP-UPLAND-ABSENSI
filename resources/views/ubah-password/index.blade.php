<x-app-full-layout>
    <x-slot name="page_title">Ganti Password</x-slot>
    <x-app-card class="pt-5">
        <form id="app-form" enctype="multipart/form-data">
            <input type="hidden" name="modified_by" value="{{ auth()->id() }}">

            <div class="row mb-5">
                <x-app-label class="required col-lg-4">Password Lama</x-app-label>
                <div class="col-lg-8 fv-row">
                    <x-app-input-password name="old_password" id="old_password"></x-app-input-password>
                </div>
            </div>

            <div class="row mb-5">
                <x-app-label class="required col-lg-4">Password Baru</x-app-label>
                <div class="col-lg-8 fv-row">
                    <x-app-input-password name="password" id="password"></x-app-input-password>
                </div>

            </div>

            <div class="row mb-5">
                <x-app-label class="required col-lg-4">Ulangi Password Baru</x-app-label>
                <div class="col-lg-8 fv-row">
                    <x-app-input-password name="password_confirmation" id="password_confirmation"></x-app-input-password>
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
                var id = "{{ auth()->id() }}";


                var handleControl = function() {
                    $("#btn-update").click(function(e) {
                        e.preventDefault();

                        validatorConfigs.rules = {
                            old_password: {
                                required: true,
                            },
                            password: {
                                required: true,
                                minlength: 8
                            },
                            password_confirmation: {
                                required: true,
                                equalTo: "#password"
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
                        let url = apiUrl + "/user/" + id + "/update-password";
                        ajaxSave(url, data, onSubmited)
                    });
                }


                var onSubmited = function() {
                    location.href = "{{ route('ubah-password') }}";
                }

                // Public methods
                return {
                    init: function() {
                        $.get(apiUrl + "/user/" + id,
                            function(data) {
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
