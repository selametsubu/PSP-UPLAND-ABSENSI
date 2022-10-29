<x-app-full-layout>
    <x-slot name="page_title">Pengaturan Umum</x-slot>

    <x-app-card>
        <x-slot name="title">

        </x-slot>
        <x-slot name="toolbar">
            <x-app-btn-add id="btn-create"></x-app-btn-add>
        </x-slot>

        <x-app-dt id="app-dt">
        </x-app-dt>
    </x-app-card>

    <x-app-modal class="modal-lg" id="app-modal" size="xl">
        <x-slot name="title">Form Pengaturan Umum</x-slot>
        <form id="app-form">
            @include('pengaturan.umum.form')
        </form>

        <x-slot name="footer">
            <div class="w-100">
                <x-app-btn-delete id="btn-destroy" class="float-start">
                </x-app-btn-delete>
                <x-app-btn-save id="btn-save" class="float-end"></x-app-btn-save>
            </div>
        </x-slot>
    </x-app-modal>

    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/sr-1.1.1/datatables.min.css"/>
    </x-slot>
    <x-slot name="scripts">
        <script>
            "use strict";

            var moduleControl = function() {
                var dt;
                var varname;
                var state;

                // Private functions
                var initDatatable = function() {
                    let configs = myDtConfigs();

                    configs.ajax.url = apiUrl + "/globalvar/dt";
                    configs.order = [0, 'desc'];
                    configs.columns = [{
                            title: "Modified at",
                            data: 'modified_at',
                            visible: false,
                        },
                        {
                            title: "Pengaturan",
                            data: 'display_name',
                            render: function(data, type, row) {
                                return `
                                        <a href="#" class="text-decoration-underline text-orange fw-bold">
                                            ${data}
                                        </a>
                                    `;
                            },
                        },
                        {
                            title: "Deskripsi",
                            data: 'vardesc'
                        },
                        {
                            title: "Nilai",
                            data: 'val'
                        },
                    ];
                    dt = $("#app-dt").DataTable(configs);
                }

                var handleControl = function() {
                    $("#btn-create").click(function(e) {
                        e.preventDefault();
                        varname = "";
                        state = "create";
                        $("#btn-destroy").hide();
                        $("#app-form").trigger("reset");
                        $("#varname").prop("disabled", false);
                        $("#guide").prop("disabled", false)
                        $("#app-modal").modal("show");
                    });

                    $('#app-dt').on('click', 'a', function(e) {
                        e.preventDefault();
                        var data = dt.row($(this).parents('tr')).data();
                        varname = data.varname;
                        state = "edit";

                        $("#btn-destroy").show();

                        $("#varname").prop("disabled", true).val(data.varname);
                        $("#display_name").val(data.display_name);
                        $("#vardesc").val(data.vardesc);
                        $("#val").val(data.val);
                        $("#guide").prop("disabled", true).val(data.guide);

                        $("#app-modal").modal('show');
                    });

                    $("#btn-save").click(function(e) {
                        e.preventDefault();

                        validatorConfigs.rules = {
                            varname: {
                                required: true,
                                maxlength: 50,
                            },
                            display_name: {
                                required: true,
                                maxlength: 100,
                            },
                            vardesc: {
                                required: true,
                                maxlength: 1000,
                            },
                            val: {
                                required: true,
                                maxlength: 500,
                            },
                        };

                        let form = $("#app-form");
                        let validator = form.validate(validatorConfigs);

                        if (!form.valid()) {
                            validator.focusInvalid();
                            return;
                        }
                        let data = new FormData(form[0]);
                        let url = apiUrl + "/globalvar";
                        if (state === "edit") {
                            url = apiUrl + "/globalvar/" + varname;
                            data.append('_method', 'put');
                        }
                        ajaxSave(url, data, onDataSaved)
                    });

                    $("#btn-destroy").click(function(e) {
                        e.preventDefault();
                        ajaxDelete(apiUrl + "/globalvar/" + varname, onDataSaved);
                    });
                }


                var onDataSaved = function() {
                    dt.draw();
                    $("#app-modal").modal("hide");
                }

                // Public methods
                return {
                    init: function() {
                        initDatatable();
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
