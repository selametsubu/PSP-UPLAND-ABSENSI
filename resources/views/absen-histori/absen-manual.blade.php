<x-app-full-layout>
    <x-slot name="page_title">Absen Manual</x-slot>
    <x-slot name="hide_sidebar">Timesheet</x-slot>

    <div class="card border min-h-300px">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-4 mb-1">
                    <x-app-select id="filter-user">
                        <option value="">Semua Personil</option>
                    </x-app-select>
                </div>

                <div class="col-lg-4 mb-1">
                    <x-app-input-text id="filter-tanggal"></x-app-input-text>
                </div>
                <div class="col-lg-3 mb-1">
                    <x-app-input-text id="filter-global" placeholder="Cari..."></x-app-input-text>
                </div>
                <div class="col-lg-1">
                    <a href="javascript:void(0)" class="btn btn-success" id="btn-filter">
                        Filter
                    </a>
                </div>
            </div>

            <table class="table align-middle table-row-dashed border-top-dashed fs-6 gy-5 table-striped-" id="app-dt">
                <thead class="text-start text-dark fw-bold fs-7 text-uppercase gs-0">

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

                    $.ajax({
                        type: "get",
                        beforeSend: function() {
                            blockUI.block();
                        },
                        url: apiUrl + "/absen-manual/dt",
                        data: {
                            userid: userid,
                            p_userid: $("#filter-user").val(),
                            p_date_from: p_date_from,
                            p_date_to: p_date_to,
                        },
                        dataType: "json",
                        success: function(response) {
                            initTable(response);

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
                            <th>Tanggal</th>
                            <th class="border-end">Hari</th>
                            <th>Keterangan</th>
                            <th>Datang</th>
                            <th>Pulang</th>
                            <th>Spot Datang</th>
                            <th>Spot Pulang</th>
                            <th>Lokasi Datang</th>
                            <th>Lokasi Pulang</th>
                            <th>Aktifitas/Catatan</th>
                        </tr>
                    `;

                    $("#app-dt thead").append(tmpHeader);

                    let tmpbody = "";
                    data.forEach(row => {

                        tmpbody += `<tr>`;
                        tmpbody += `
                            <td width="150px" style="color:${row.tgl_hari_color}">
                                <div class="w-100px"><a href="absen-manual/${row.userid}/${row.tgl}/edit">${dateFormat(row.tgl)}</a></div>
                            </td>
                            <td style="color:${row.tgl_hari_color}" class="border-end">${row.hari}</td>
                            <td style="color:${row.keterangan_color}">${row.keterangan ?? ''}</td>
                            <td>${row.absen_datang ?? ''}</td>
                            <td>${row.absen_pulang ?? ''}</td>
                            <td style="color:${row.datang_status_spot_color}"><a target="_blank" href="https://www.google.com/maps/place/${row.lat_datang},${row.lng_datang}">${row.datang_status_spot ?? ''}</a></td>
                            <td style="color:${row.pulang_status_spot_color}"><a target="_blank" href="https://www.google.com/maps/place/${row.lat_pulang},${row.lng_pulang}">${row.pulang_status_spot ?? ''}</a></td>
                            <td><div class="w-100px">${row.datang_lokasi ?? ''}</div></td>
                            <td><div class="w-100px">${row.pulang_lokasi ?? ''}</div></td>
                            <td>${row.aktifitas ?? ''}</td>
                        `;
                        tmpbody += `</tr>`;
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
                        }
                    }, function(start, end) {
                        $("#filter-date").html(start.format("MMMM D, YYYY") + " - " + end.format(
                            "MMMM D, YYYY"));
                    });

                    $(".daterangepicker li:contains('Custom Range')").html("Pilih Tanggal")

                    $("#filter-user").select2({
                        allowClear: true,
                        placeholder: 'Pilih Personil',
                        templateResult: filterOptionFormat
                    });

                    $("#filter-bulan, #filter-tahun").select2();
                }

                var handleControl = function() {
                    $("#btn-filter").click(function(e) {
                        e.preventDefault();

                        loadLaporan();

                        if (table) {
                            table.search($(this).val())
                                .draw();
                        }
                    });
                }

                // Public methods
                return {
                    init: function() {
                        loadUser();
                        initFilter();

                        loadLaporan();
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
