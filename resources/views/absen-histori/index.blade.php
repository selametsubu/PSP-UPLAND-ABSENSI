<x-app-full-layout>
    <x-slot name="page_title">Histori Absen </x-slot>

    <div class="card border">

        <div class="card-body py-4">
            <x-app-dt id="app-dt">
            </x-app-dt>
        </div>

    </div>


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

                    configs.ajax.url = apiUrl + "/absen-hadir/dt";
                    configs.ajax.data = function(d){
                        d.userid = {{ auth()->id() }}
                    }
                    configs.order = [0, 'desc'];
                    configs.columns = [{
                            title: "Modified at",
                            data: 'created_at',
                            visible: false,
                        },
                        {
                            title: "Nama",
                            data: 'fullname',
                            render: function(data, type, row) {
                                return `
                                        <span class="text-decoration-underline- text-orange fw-bold">
                                            ${data}
                                        </span>
                                    `;
                            },
                        },
                        {
                            title: "Status",
                            data: 'status_absen',
                        },
                        {
                            title: "Waktu",
                            data: 'waktu_text',
                        },
                        {
                            title: "Lokasi",
                            data: 'lokasi',
                        },
                        {
                            title: "Koordinat (Lat, Lng)",
                            data: 'koordinat_text',
                            render: function(data, type, row) {
                                let url = `https://www.google.com/maps/place/${row.lat},${row.lng}`;
                                return `<a href="${url}" target="blank">
                                    ${data}
                                </a>`;
                            },
                        },
                        {
                            title: "Regional (Desa, Kec, Kab, Prov)",
                            data: 'region_text',
                        },
                        {
                            title: "Catatan",
                            data: 'catatan',
                        },
                        {
                            title: "Foto",
                            data: 'swafoto_thumb',
                            render: function(data, type, row) {
                                return `
                                    <a href="${appUrl}/download_file?path=${row.swafoto_ori}" target="blank">
                                        <img src="${appUrl}/download_file?path=${data}" class="img-fluid" />
                                    </a>
                                    `;
                            },
                        },
                    ];
                    dt = $("#app-dt").DataTable(configs);
                }



                // Public methods
                return {
                    init: function() {
                        initDatatable();
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
