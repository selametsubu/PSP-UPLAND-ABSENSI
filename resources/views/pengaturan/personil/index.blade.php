<x-app-full-layout>
    <x-slot name="page_title">Personil</x-slot>


    <x-app-card>
        <x-slot name="title">
            <x-app-select id="filter-personil">
                <option value="">Semua Personil</option>
                <option value="Ya">Personil Absen</option>
            </x-app-select>
        </x-slot>
        <x-slot name="toolbar">
            <x-app-btn-add id="btn-create" data-url="{{ route('pengaturan.personil.create') }}"></x-app-btn-add>
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
                var varname;
                var state;

                // Private functions
                var initDatatable = function() {
                    let configs = myDtConfigs();

                    configs.ajax.url = apiUrl + "/user/dt";
                    configs.order = [0, 'desc'];
                    configs.columns = [{
                            title: "Modified at",
                            data: 'modified_at',
                            visible: false,
                        },
                        {
                            title: "Nama Lengkap",
                            data: 'fullname',
                            render: function(data, type, row) {
                                return `
                                        <a href="${appUrl}/pengaturan/personil/${row.userid}/edit" class="text-decoration-underline text-orange fw-bold">
                                            ${data}
                                        </a>
                                    `;
                            },
                        },
                        {
                            title: "Email",
                            data: 'email'
                        },
                        {
                            title: "Peran",
                            data: 'peran'
                        },
                        {
                            title: "Kabupaten",
                            data: 'nmkab'
                        },
                        {
                            title: "Personil Absen",
                            data: 'wajib_absen_text'
                        },
                    ];
                    dt = $("#app-dt").DataTable(configs);
                }

                var initControl = function(){
                    let filterPersonil = localStorage.getItem('filterPersonil');
                    if(filterPersonil){
                        $("#filter-personil").val(filterPersonil);
                    }
                }

                var handleControl = function() {
                    $("#filter-personil").change(function (e) {
                        e.preventDefault();
                        let val = $(this).val();
                        dt.column(5).search(val ? val : "", false, false);
                        dt.table().draw();

                        localStorage.setItem('filterPersonil', val);
                    });

                    $("#btn-create").click(function(e) {
                        e.preventDefault();
                        let url = $(this).data("url");
                        location.href = url;
                    });
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
