<x-app-full-layout>
    <x-slot name="page_title">Spot Kehadiran</x-slot>

    <x-app-card>
        <x-slot name="title">

        </x-slot>
        <x-slot name="toolbar">
            <x-app-btn-add id="btn-create"></x-app-btn-add>
        </x-slot>

        <x-app-dt id="app-dt">
        </x-app-dt>
    </x-app-card>
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/sr-1.1.1/datatables.min.css"/>
    </x-slot>
    <x-slot name="scripts">
        <script>
            "use strict";

            var moduleControl = function() {
                var dt;

                // Private functions
                var initDatatable = function() {
                    let configs = myDtConfigs();

                    configs.ajax.url = apiUrl + "/spot/dt";
                    configs.order = [0, 'desc'];
                    configs.columns = [{
                            title: "Modified at",
                            data: 'modified_at',
                            visible: false,
                        },
                        {
                            title: "Nama Spot",
                            data: 'spot',
                            render: function(data, type, row) {
                                return `
                                        <a href="${appUrl}/pengaturan/spot/${row.spotid}/edit" class="text-decoration-underline text-orange fw-bold">
                                            ${data}
                                        </a>
                                    `;
                            },
                        },
                        {
                            title: "Alamat",
                            data: 'alamat'
                        },
                        {
                            class: "dt-right",
                            title: "Total Personil",
                            data: 'total_personil',
                            render: function(data, type, row) {
                                return customNumberFormat(data, 0);
                            },
                        },
                        {
                            class: "dt-right",
                            title: "Radius (m)",
                            data: 'radius',
                            render: function(data, type, row) {
                                return customNumberFormat(data, 0);
                            },
                        },
                    ];
                    dt = $("#app-dt").DataTable(configs);
                }

                var handleControl = function() {
                    $("#btn-create").click(function(e) {
                        e.preventDefault();
                        location.href = appUrl + "/pengaturan/spot/create";
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
