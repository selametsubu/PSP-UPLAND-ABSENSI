<x-app-full-layout>
    <x-slot name="page_title">Rekap Kehadiran</x-slot>


    <div class="card border" class="min-h-300px">
        <div class="card-header">
            <div class="card-title"></div>
            <div class="card-toolbar">
                <a href="javascript:void(0)" class="btn btn-orange w-100" id="btn-download">
                    <i class="fas fa-download text-light"></i> Export Excel
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-7">
                    <x-app-select id="filter-user" multiple="multiple">
                    </x-app-select>
                </div>
                <div class="col-lg-4">
                    <x-app-input-text id="filter-tanggal"></x-app-input-text>
                </div>
                <div class="col-lg-1">
                    <x-app-btn-filter id="btn-filter"></x-app-btn-filter>
                </div>
            </div>

            <x-app-input-text id="filter-global" placeholder="Pencarian Umum ..." class="mb-2"></x-app-input-text>


            <table class="table align-middle table-row-dashed border-top-dashed fs-6 gy-5 table-striped-"
                id="app-dt">
                <thead class="text-start text-dark fw-bold fs-7 text-uppercase gs-0">
                    <tr>

                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <x-slot name="styles">

    </x-slot>

    <x-slot name="scripts">
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/fc-4.1.0/fh-3.2.4/datatables.min.js">
        </script>
        <script>
            "use strict";

            var moduleControl = function() {

                var userid = "{{ auth()->id() }}"
                var table;
                var statusAbsenBgColor = @json(config('ref.absen_status_bgcolor'));


                var loadLaporan = function() {
                    let filterTanggal = $("#filter-tanggal").val().split(" - ");
                    let p_date_from = filterTanggal[0];
                    let p_date_to = filterTanggal[1];

                    let p_userid = $("#filter-user").val() ?? null;

                    if (p_userid.length > 0) {
                        if (p_userid[0] == '') {
                            p_userid = null
                        }
                    }

                    $.ajax({
                        type: "get",
                        beforeSend: function() {
                            blockUI.block();
                        },
                        url: apiUrl + "/laporan/rekap-kehadiran",
                        data: {
                            userid: userid,
                            p_userid: p_userid,
                            p_date_from: p_date_from,
                            p_date_to: p_date_to,
                        },
                        dataType: "json",
                        success: function(response) {
                            blockUI.release();
                            initTable(response);
                        },
                        complete: function() {
                            blockUI.release();
                        },
                        error: function(xhr) {
                            alertError('Terjadi Kesalahan. Hubungi Administrator anda')
                        }
                    });
                }

                var initTable = function(data) {
                    if (table) {
                        table.destroy();
                    }

                    $("#app-dt thead").empty();
                    $("#app-dt tbody").empty();

                    let tmpHeader = `
                        <tr>
                            <th>Personil</th>
                            <th class="border-end">Peran</th>
                            <th class="text-end">Hari Kehadiran</th>
                            <th class="text-end">Jam Kehadiran</th>
                            <th class="text-end">Total Hari Kerja</th>
                            <th class="text-end">Total Jam Kerja</th>
                            <th class="text-end">(-+) Hari Kerja</th>
                            <th class="text-end">(-+) Jam Kerja</th>
                            <th class="text-end">(%) Hari Kehadiran</th>
                            <th class="text-end">(%) Jam Kehadiran</th>
                            <th class="text-end">Tidak Absen Pulang</th>
                            <th class="text-end">Telat Hari</th>
                            <th class="text-end">Telat Jam</th>
                            <th class="text-end">Total Hari Izin & Cuti</th>
                            <th class="text-end">Total Hari Alpa</th>
                        </tr>
                    `;

                    $("#app-dt thead").append(tmpHeader);

                    let tmpbody = "";
                    data.forEach(row => {
                        tmpbody += `
                            <tr>
                                <td class="fw-bold">${row.nama}</td>
                                <td class="border-end">${row.peran}</td>
                                <td class="text-end">${row.hari_kehadiran ?? ''}</td>
                                <td class="text-end">${row.jam_kehadiran ?? ''}</td>
                                <td class="text-end">${row.total_hari_kerja ?? ''}</td>
                                <td class="text-end">${row.total_jam_kerja ?? ''}</td>
                                <td class="text-end">${row.kurleb_hari_kerja ?? ''}</td>
                                <td class="text-end">${row.kurleb_jam_kerja ?? ''}</td>
                                <td class="text-end">${row.persen_hari_kehadiran ?? ''}</td>
                                <td class="text-end">${row.persen_jam_kehadiran ?? ''}</td>
                                <td class="text-end">${row.tidak_absen_pulang ?? ''}</td>
                                <td class="text-end">${row.total_hari_telat ?? ''}</td>
                                <td class="text-end">${row.total_jam_telat ?? ''}</td>
                                <td class="text-end">${row.total_hari_izin_cuti ?? ''}</td>
                                <td class="text-end">${row.total_hari_alpa ?? ''}</td>
                            </tr>
                        `;
                    });
                    $("#app-dt tbody").append(tmpbody);

                    let tableHeight = $(window).height() - 350;

                    table = $('#app-dt').DataTable({
                        dom: 'lrt',
                        order: [],
                        scrollY: tableHeight,
                        scrollX: true,
                        scrollCollapse: true,
                        paging: false,
                        fixedColumns: {
                            left: 2,
                        },
                        select: true,
                        order: [0, 'asc']
                    });
                }

                var loadUser = function() {
                    $.ajax({
                        type: "get",
                        async: false,
                        url: apiUrl + "/user",
                        data: {
                            userid: userid,
                        },
                        dataType: "json",
                        success: function(response) {
                            let selected = '';
                            if (response.length == 1) {
                                selected = 'selected';
                            }
                            let tmp = ``;
                            response.forEach(row => {
                                tmp += `
                                <option data-email="${row.email}" value="${row.userid}" ${selected}>
                                    ${row.fullname}
                                </option>
                                `;
                            });
                            $("#filter-user").append(tmp);
                        }
                    });
                }

                var filterOptionFormat = function(item) {
                    if (!item.id) {
                        return item.text;
                    }

                    var span = document.createElement('span');
                    var template = '';

                    template += '<div class="d-flex align-items-center">';
                    template += '<div class="d-flex flex-column">'
                    template += '<span class="fw-bold lh-1">' + item.text + '</span>';
                    template += '<span class="text-muted">' + item.element.getAttribute('data-email') + '</span>';
                    template += '</div>';
                    template += '</div>';

                    span.innerHTML = template;

                    return $(span);
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
                        },
                    }, function(start, end) {
                        $("#filter-date").html(start.format("MMMM D, YYYY") + " - " + end.format(
                            "MMMM D, YYYY"));
                    });

                    $(".daterangepicker li:contains('Custom Range')").html("Pilih Tanggal")

                    $("#filter-user").select2({
                        allowClear: true,
                        placeholder: 'Semua Personil',
                        templateResult: filterOptionFormat
                    });

                    $("#filter-bulan, #filter-tahun").select2();
                }

                var handleFilter = function() {
                    // $("#filter-tanggal").change(function(e) {
                    //     e.preventDefault();

                    //     loadLaporan();
                    // });

                    // $("#filter-user").on("select2:select", function() {
                    //     loadLaporan();
                    // });

                    // $("#filter-user").on("select2:unselect", function() {
                    //     loadLaporan();
                    // });

                    $("#filter-global").change(function(e) {
                        e.preventDefault();

                        if (table) {
                            table.search($(this).val())
                                .draw();
                        }
                    });

                    $("#btn-filter").click(function (e) {
                        e.preventDefault();
                        loadLaporan();
                    });
                }

                var handleControl = function() {
                    $("#btn-download").click(function(e) {
                        e.preventDefault();
                        let filterTanggal = $("#filter-tanggal").val().split(" - ");
                        let p_date_from = filterTanggal[0];
                        let p_date_to = filterTanggal[1];

                        let p_userid = $("#filter-user").val() ?? null;

                        if (p_userid.length > 0) {
                            if (p_userid[0] == '') {
                                p_userid = null
                            }
                        }

                        let p_user_name = [];
                        $("#filter-user option:selected").each(function() {
                            p_user_name.push($(this).text().trim());
                        });


                        let param = {
                            p_userid: p_userid,
                            p_date_from: p_date_from,
                            p_date_to: p_date_to,
                            p_user_name: p_user_name,
                        }

                        let url = appUrl + "/laporan/rekap-kehadiran/export?" + $.param(param);;
                        window.open(url);
                    });
                }

                // Public methods
                return {
                    init: function() {
                        loadUser();
                        initFilter();

                        loadLaporan();
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
