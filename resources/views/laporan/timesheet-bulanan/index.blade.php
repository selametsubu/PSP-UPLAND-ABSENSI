<x-app-full-layout>
    <x-slot name="page_title">Timesheet Bulanan</x-slot>

    <div class="card border" class="min-h-300px">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-lg-4">
                    <x-app-select id="filter-user" multiple="multiple">

                    </x-app-select>
                </div>
                <div class="col-lg-2">
                    <x-app-select id="filter-bulan">
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </x-app-select>
                </div>
                <div class="col-lg-2">
                    <x-app-select id="filter-tahun">
                    </x-app-select>
                </div>
                <div class="col">
                    <x-app-input-text id="filter-global" placeholder="Cari..."></x-app-input-text>
                </div>
                <div class="col-lg-1">
                    <a href="javascript:void(0)" class="btn btn-orange w-100" id="btn-download">
                        <i class="fas fa-download text-light"></i>
                    </a>
                </div>
            </div>
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
                    let p_userid = $("#filter-user").val() ?? null;

                    if (p_userid.length > 0) {
                        if (p_userid[0] == '') {
                            p_userid = null
                        }
                    }

                    let tahun_bulan = $("#filter-tahun").val() + $("#filter-bulan").val();
                    $.ajax({
                        type: "get",
                        beforeSend: function() {
                            blockUI.block();
                        },
                        url: apiUrl + "/laporan/timesheet-bulanan",
                        data: {
                            userid: userid,
                            p_userid: p_userid,
                            p_tahun_bulan: tahun_bulan,
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
                    data.sort();
                    if (table) {
                        table.destroy();
                    }
                    $("#app-dt thead tr").empty();
                    $("#app-dt tbody").empty();

                    let endOfDate = moment($("#filter-tahun").val() + '-' + $("#filter-bulan").val() + '-01').endOf(
                        "month").date();
                    let tmpHdr = "";

                    tmpHdr += `
                        <th>Personil</th>
                        <th class="border-end">Peran</th>
                    `;
                    for (let i = 0; i < endOfDate; i++) {
                        tmpHdr += `<th>${i+1}</th>`;
                    }
                    tmpHdr += `
                        <th class="text-end"><span>Total Hari Kehadiran<span></th>
                        <th class="text-end">Total Hari Izin & Cuti</th>
                        <th class="text-end">Total Alpa</th>
                    `;
                    $("#app-dt thead tr").append(tmpHdr);
                    let tmpbody = "";
                    data.forEach(row => {

                        tmpbody += `<tr>`;
                        tmpbody += `
                            <td class="fw-bold">${row.nama}</td>
                            <td class="border-end">${row.peran}</td>
                        `;

                        for (let i = 0; i < endOfDate; i++) {
                            let val = row[i + 1];
                            let css = statusAbsenBgColor[val];
                            tmpbody += `<td class="${css}">${val ?? ''}</td>`;
                        }
                        tmpbody += `
                            <td class="text-end"><b>${row.total_hari_kehadiran}</b></td>
                            <td class="text-end"><b>${row.total_hari_izin_cuti}</b></td>
                            <td class="text-end"><b>${row.total_hari_alpa}</b></td>
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
                            right: 3,
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

                var loadTahun = function() {
                    $.ajax({
                        type: "get",
                        async: false,
                        url: apiUrl + "/laporan/tahun",
                        dataType: "json",
                        success: function(response) {
                            let selected = '';
                            if (response.length == 1) {
                                selected = 'selected';
                            }
                            let tmp = ``;
                            response.forEach(row => {
                                tmp += `
                                <option value="${row.tahun}" ${selected}>
                                    ${row.tahun}
                                </option>
                                `;
                            });
                            $("#filter-tahun").append(tmp);
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
                    $("#filter-date").daterangepicker({
                        locale: {
                            format: "DD-MM-YYYY",
                        },
                        startDate: moment().startOf("month"),
                        endDate: moment().endOf("month"),
                        ranges: {
                            "This Month": [moment().startOf("month"), moment().endOf("month")],
                            "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1,
                                    "month")
                                .endOf("month")
                            ]
                        }
                    }, function(start, end) {
                        $("#filter-date").html(start.format("MMMM D, YYYY") + " - " + end.format(
                            "MMMM D, YYYY"));
                    });

                    $("#filter-user").select2({
                        allowClear: true,
                        placeholder: 'Semua Personil',
                        templateResult: filterOptionFormat
                    });

                    let monthValue = moment().month() + 1;
                    $("#filter-bulan").val(monthValue < 10 ? "0" + monthValue : monthValue)
                    $("#filter-bulan, #filter-tahun").select2();
                }

                var handleFilter = function() {
                    $("#filter-tahun, #filter-bulan").change(function(e) {
                        e.preventDefault();

                        loadLaporan();
                    });

                    $("#filter-user").on("select2:select", function() {
                        loadLaporan();
                    });

                    $("#filter-user").on("select2:unselect", function() {
                        $("#filter-user").trigger('select2:clear');
                    });

                    $("#filter-user").on("select2:clear", function() {
                        loadLaporan();
                    });

                    $("#filter-global").change(function(e) {
                        e.preventDefault();

                        if (table) {
                            table.search($(this).val())
                                .draw();
                        }
                    });
                }

                var handleControl = function() {
                    $("#btn-download").click(function(e) {
                        e.preventDefault();

                        let p_userid = $("#filter-user").val() ?? null;

                        if (p_userid.length > 0) {
                            if (p_userid[0] == '') {
                                p_userid = null
                            }
                        }

                        let p_tahun_bulan = $("#filter-tahun").val() + $("#filter-bulan").val();

                        let p_user_name = [];
                        $("#filter-user option:selected").each(function() {
                            p_user_name.push($(this).text().trim());
                        });

                        let p_bulan_name = $("#filter-bulan option:selected").text().trim()
                        p_bulan_name += " " + $("#filter-tahun option:selected").text().trim()

                        let param = {
                            p_userid: p_userid,
                            p_tahun_bulan: p_tahun_bulan,
                            p_user_name: p_user_name,
                            p_bulan_name: p_bulan_name,
                        }

                        let url = appUrl + "/laporan/timesheet-bulanan/export?" + $.param(param);;
                        window.open(url);
                    });
                }

                // Public methods
                return {
                    init: function() {
                        loadUser();
                        loadTahun();
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
