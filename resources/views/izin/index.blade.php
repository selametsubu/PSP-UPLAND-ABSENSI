<x-app-full-layout>
    <x-slot name="page_title">Izin & Cuti</x-slot>

    <x-app-card>
        <x-slot name="title">
            <x-app-input-text id="filter-tanggal"></x-app-input-text>
        </x-slot>
        <x-slot name="toolbar">
            <x-app-btn-add id="btn-create"></x-app-btn-add>
        </x-slot>

        <x-app-dt id="app-dt">
        </x-app-dt>
    </x-app-card>
    <x-slot name="styles">
        <link rel="stylesheet" type="text/css"
            href="https://cdn.datatables.net/v/bs5/dt-1.12.1/r-2.3.0/sr-1.1.1/datatables.min.css" />
    </x-slot>
    <x-slot name="scripts">
        <script>
            "use strict";

            var moduleControl = function() {
                var dt;
                var userid = "{{ auth()->id() }}";

                // Private functions
                var initDatatable = function() {


                    let configs = myDtConfigs();

                    configs.ajax.url = apiUrl + "/izin/dt";
                    configs.ajax.data = function(d) {

                        let filterTanggal = $("#filter-tanggal").val().split(" - ");
                        let tgl_dari = filterTanggal[0];
                        let tgl_sampai = filterTanggal[1];

                        d.userid = userid;
                        d.tgl_dari = tgl_dari;
                        d.tgl_sampai = tgl_sampai;
                    };
                    configs.order = [0, 'desc'];
                    configs.columns = [{
                            title: "Modified at",
                            data: 'modified_at',
                            visible: false,
                        },
                        {
                            title: "Personil",
                            data: 'fullname',
                            render: function(data, type, row) {
                                return `
                                        <a href="${appUrl}/izin-cuti/${row.izinid}/edit" class="text-decoration-underline text-orange fw-bold">
                                            ${data}
                                        </a>
                                    `;
                            },
                        },
                        {
                            title: "Jenis Izin",
                            data: 'jenis_izin'
                        },
                        {
                            title: "Aktifitas",
                            data: 'aktifitas'
                        },
                        {
                            title: "Tanggal",
                            data: 'tanggal_text'
                        },
                        {
                            class: 'dt-right',
                            title: "Durasi (Hari)",
                            data: 'durasi'
                        },
                        {
                            class: "dt-center",
                            title: "Dokumen",
                            data: 'dok_saved',
                            render: function(data, type, row) {
                                if (!data) {
                                    return '-';
                                }
                                return `<a href="${appUrl}/download_file?path=${data}" target="blank"><i class="fas fa-download"></i></a>`;
                            },
                        },
                    ];
                    dt = $("#app-dt").DataTable(configs);
                }

                var handleControl = function() {
                    $("#btn-create").click(function(e) {
                        e.preventDefault();
                        location.href = appUrl + "/izin-cuti/create";
                    });
                }

                var initFilter = function() {
                    $("#filter-tanggal").daterangepicker({
                        locale: {
                            format: "DD-MM-YYYY",
                        },
                        startDate: moment().startOf("month"),
                        endDate: moment().endOf("month"),
                        ranges: {
                            "Bulan ini": [moment().startOf("month"), moment().endOf("month")],
                            "Bulan lalu": [moment().subtract(1, "month").startOf("month"), moment().subtract(1,
                                    "month")
                                .endOf("month")
                            ]
                        }
                    }, function(start, end) {
                        $("#filter-date").html(start.format("MMMM D, YYYY") + " - " + end.format(
                            "MMMM D, YYYY"));
                    });

                    $(".daterangepicker li:contains('Custom Range')").html("Pilih Tanggal")
                }

                var handleFilter = function() {
                    $("#filter-tanggal").change(function(e) {
                        e.preventDefault();

                        dt.draw();
                    });
                }


                // Public methods
                return {
                    init: function() {
                        initFilter();
                        initDatatable();

                        handleFilter();
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
