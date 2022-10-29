<x-app-full-layout>
    <x-slot name="page_title">Hari Libur </x-slot>

    <x-app-card>
        <x-slot name="title">

        </x-slot>
        <x-slot name="toolbar">
            <x-app-btn-add id="btn-create"></x-app-btn-add>
        </x-slot>

        <x-app-dt id="app-dt">
        </x-app-dt>
    </x-app-card>

    <x-app-modal id="app-modal" size="lg">
        <x-slot name="title">Form Hari Libur</x-slot>
        <form id="app-form">
            <div class="row">
                <div class="col-lg-6">
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Hari Libur</x-app-label>
                        <x-app-input-text name="harilibur" id="harilibur"></x-app-input-text>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Tanggal dari</x-app-label>
                        <x-app-input-text name="tgl_dari" id="tgl_dari"></x-app-input-text>
                    </div>
                    <div class="fv-row mb-5">
                        <x-app-label class="required">Tanggal sampai</x-app-label>
                        <x-app-input-text name="tgl_sampai" id="tgl_sampai"></x-app-input-text>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="fv-row mb-5">
                        <x-app-label class="required">catatan</x-app-label>
                        <x-app-textarea name="catatan" id="catatan" rows="10"></x-app-textarea>
                    </div>
                </div>
            </div>
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
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/sr-1.1.1/datatables.min.css" />
    </x-slot>
    <x-slot name="scripts">
        <script>
            "use strict";

            var moduleControl = function() {
                var dt;
                var hariliburid;
                var state;

                // Private functions
                var initDatatable = function() {
                    let configs = myDtConfigs();

                    configs.ajax.url = apiUrl + "/libur/dt";
                    configs.order = [0, 'desc'];
                    configs.columns = [{
                            title: "Modified at",
                            data: 'modified_at',
                            visible: false,
                        },
                        {
                            title: "Hari Libur",
                            data: 'harilibur',
                            render: function(data, type, row) {
                                return `
                                        <a href="#" class="text-decoration-underline text-orange fw-bold">
                                            ${data}
                                        </a>
                                    `;
                            },
                        },
                        {
                            title: "Tanggal Dari",
                            data: 'tgl_dari',
                            render: function(data, type, row) {
                                return dateFormat(data);
                            },
                        },
                        {
                            title: "Tanggal Sampai",
                            data: 'tgl_sampai',
                            render: function(data, type, row) {
                                return dateFormat(data);
                            },
                        },
                    ];
                    dt = $("#app-dt").DataTable(configs);
                }

                var initControl = function() {
                    let dConfig = {
                        ...datePickerConfig,
                        parentEl: "#app-modal .modal-body",
                    }
                    $("#tgl_dari").daterangepicker(dConfig);
                    $("#tgl_dari").on("apply.daterangepicker", function(ev, picker) {
                        $(this).val(picker.startDate.format("DD-MM-YYYY"));
                    });

                    $("#tgl_sampai").daterangepicker(dConfig);
                    $("#tgl_sampai").on("apply.daterangepicker", function(ev, picker) {
                        $(this).val(picker.startDate.format("DD-MM-YYYY"));
                    });
                }

                var handleControl = function() {
                    $("#btn-create").click(function(e) {
                        e.preventDefault();
                        hariliburid = "";
                        state = "create";
                        $("#btn-destroy").hide();
                        $("#app-form").trigger("reset");
                        $("#app-modal").modal("show");
                    });

                    $('#app-dt').on('click', 'a', function(e) {
                        e.preventDefault();
                        var data = dt.row($(this).parents('tr')).data();
                        hariliburid = data.hariliburid;
                        state = "edit";

                        $("#btn-destroy").show();

                        $("#harilibur").val(data.harilibur);
                        $("#tgl_dari").val(dateFormat(data.tgl_dari));
                        $("#tgl_sampai").val(dateFormat(data.tgl_sampai));
                        $("#catatan").val(data.catatan);

                        initControl();

                        $("#app-modal").modal('show');
                    });

                    $("#btn-save").click(function(e) {
                        e.preventDefault();

                        validatorConfigs.rules = {
                            harilibur: {
                                required: true,
                                maxlength: 100,
                            },
                            tgl_dari: {
                                required: true,
                            },
                            tgl_sampai: {
                                required: true,
                            },
                            catatan: {
                                required: true,
                                maxlength: 4000,
                            },
                        };

                        let form = $("#app-form");
                        let validator = form.validate(validatorConfigs);

                        if (!form.valid()) {
                            validator.focusInvalid();
                            return;
                        }
                        let data = new FormData(form[0]);
                        data.append('created_by', '{{ auth()->id() }}');
                        let url = apiUrl + "/libur";
                        if (state === "edit") {
                            url = apiUrl + "/libur/" + hariliburid;
                            data.append('_method', 'put');
                            data.append('updated_by', '{{ auth()->id() }}');
                        }
                        ajaxSave(url, data, onDataSaved)
                    });

                    $("#btn-destroy").click(function(e) {
                        e.preventDefault();
                        ajaxDelete(apiUrl + "/libur/" + hariliburid, onDataSaved);
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
