<x-app-full-layout>
    <x-slot name="page_title">
        <h3>Selamat Datang, {{ auth()->user()->fullname }}</h3>
        <div>Hari ini: <b class="text-orange">{{ $tanggal }}</b> </div>
    </x-slot>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border">
                <div class="card-body">
                    <h3>Sebaran Keterangan Kehadiran</h3>
                    <small>Keterangan Kehadiran Semua Personil Wajib Absen Bulan Ini</small>

                    <div class="mt-5 row">
                        <div class="col-lg-7">
                            <div id="chart-sebaran-kehadiran"></div>
                        </div>
                        <div class="col-lg-5">
                            <table class="table align-middle table-row-dashed border-top-dashed fs-7 gy-1"
                                id="table-sebaran-kehadiran">

                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card border mt-5">
                <div class="card-body">
                    <h3>Rata-rata Absen Datang</h3>

                    <div class="mt-5">
                        <div id="chart-rata-absen-datang"></div>
                    </div>
                </div>
            </div>

            <div class="card border mt-5 mb-5">
                <div class="card-body">
                    <h3>Rata-rata Absen Pulang</h3>

                    <div class="mt-5">
                        <div id="chart-rata-absen-pulang"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="bg-warning p-5 rounded">
                <h1 class="mb-0">Prestasi Anda</h1>
                <small>Performance Kehadiran Anda Bulan Ini</small>

                <div class="card border mt-5">
                    <div class="card-body">
                        <h3>Hari Kehadiran</h3>

                        <div>
                            <div id="chart-user-hari-kehadiran"></div>

                            <table class="table align-middle table-row-dashed border-top-dashed fs-7 gy-1"
                                id="table-user-hari-kehadiran">

                            </table>
                        </div>
                    </div>
                </div>

                <div class="card border mt-5">
                    <div class="card-body">
                        <h3>Jam Kehadiran</h3>

                        <div>
                            <div id="chart-user-jam-kehadiran"></div>

                            <table class="table align-middle table-row-dashed border-top-dashed fs-7 gy-1"
                                id="table-user-jam-kehadiran">

                            </table>
                        </div>
                    </div>
                </div>

                <div class="card border mt-5">
                    <div class="card-body">
                        <table id="table-user-harian"
                            class="table align-middle table-row-dashed border-top-dashed fs-7 gy-1">

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <x-slot name="scripts">
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>
            "use strict";

            var moduleControl = function() {
                var url = apiUrl + "/laporan/dashboard-all";
                var customApexChartColors = @json(config('ref.customApexChartColors'));
                var initChartSebaranKehadiran = function() {
                    $.ajax({
                        type: "get",
                        url: url,
                        data: {
                            p_cat: "sebaran_kehadiran"
                        },
                        dataType: "json",
                        success: function(response) {
                            let series = [];
                            let labels = [];
                            let tmp = ``;
                            response.forEach(row => {
                                series.push(row.total);
                                labels.push(row.jenis_kehadiran);
                                tmp += `
                                    <tr>
                                        <td>${row.jenis_kehadiran}</td>
                                        <td class="text-end fw-bold">${row.total}</td>
                                    </tr>
                                `;
                            });

                            $("#table-sebaran-kehadiran").empty().append(tmp);

                            var options = {
                                series: series,
                                chart: {
                                    type: 'pie',
                                },
                                colors: customApexChartColors,
                                labels: labels,
                                legend: {
                                    show: false,
                                },
                                responsive: [{
                                    breakpoint: 480,
                                    options: {
                                        chart: {

                                        },
                                        legend: {
                                            show: false,
                                            position: 'bottom'
                                        }
                                    }
                                }]
                            };

                            var chart = new ApexCharts(document.querySelector("#chart-sebaran-kehadiran"),
                                options);
                            chart.render();
                        }
                    });
                }

                var initChartRataAbsenDatang = function() {
                    $.ajax({
                        type: "get",
                        url: url,
                        data: {
                            p_cat: "rata2_absen_datang"
                        },
                        dataType: "json",
                        success: function(response) {
                            let data = [];
                            let categories = [];

                            response.forEach(row => {
                                data.push(row.rata_waktu);
                                categories.push(row.tgl_no);
                            });

                            var options = {
                                series: [{
                                    name: "Rata-rata",
                                    data: data
                                }],
                                chart: {
                                    height: 200,
                                    type: 'line',
                                    zoom: {
                                        enabled: false
                                    },
                                    toolbar: {
                                        show: false,
                                    }
                                },
                                colors: customApexChartColors,
                                tooltip: {
                                    y: {
                                        formatter: function(val) {
                                            return val
                                        }
                                    }
                                },
                                markers: {
                                    size: 0,
                                    hover: {
                                        sizeOffset: 6
                                    }
                                },
                                xaxis: {
                                    categories: categories,
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#chart-rata-absen-datang"),
                                options);
                            chart.render();
                        }
                    });


                }

                var initChartRataAbsenPulang = function() {
                    $.ajax({
                        type: "get",
                        url: url,
                        data: {
                            p_cat: "rata2_absen_pulang"
                        },
                        dataType: "json",
                        success: function(response) {
                            let data = [];
                            let categories = [];

                            response.forEach(row => {
                                data.push(row.rata_waktu);
                                categories.push(row.tgl_no);
                            });

                            var options = {
                                series: [{
                                    name: "Rata-rata",
                                    data: data
                                }],
                                chart: {
                                    height: 200,
                                    type: 'line',
                                    zoom: {
                                        enabled: false
                                    },
                                    toolbar: {
                                        show: false,
                                    }
                                },
                                colors: customApexChartColors,
                                dataLabels: {
                                    enabled: false
                                },
                                tooltip: {
                                    y: {
                                        formatter: function(val) {
                                            return val
                                        }
                                    }
                                },
                                markers: {
                                    size: 0,
                                    hover: {
                                        sizeOffset: 6
                                    }
                                },
                                xaxis: {
                                    categories: categories,
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#chart-rata-absen-pulang"),
                                options);
                            chart.render();
                        }
                    });


                }

                var loadDataUser = function() {
                    $.ajax({
                        type: "get",
                        url: apiUrl + "/laporan/dashboard-user",
                        data: {
                            p_userid: {{ auth()->id() }}
                        },
                        dataType: "json",
                        success: function(data) {
                            initTableHarian(data);
                            initChartHariKehadiran(data);
                            initTableHariKehadiran(data);

                            initChartJamKehadiran(data);
                            initTableJamKehadiran(data);
                        }
                    });

                }

                var initTableHarian = function(data) {
                    let tmp = `
                        <tr>
                            <td>Tidak Absen Pulang</td>
                            <td class="text-end fw-bold">${data.tidak_absen_pulang ?? ''}</td>
                        </tr>
                        <tr>
                            <td>Telat Hari</td>
                            <td class="text-end fw-bold">${data.telat_hari ?? ''}</td>
                        </tr>
                        <tr>
                            <td>Telat Jam</td>
                            <td class="text-end fw-bold">${data.telat_jam ?? ''}</td>
                        </tr>
                        <tr>
                            <td>Total Hari Izin dan Cuti</td>
                            <td class="text-end fw-bold">${data.total_hari_izin_cuti ?? ''}</td>
                        </tr>
                        <tr>
                            <td>Total Alpa</td>
                            <td class="text-end fw-bold">${data.total_alpa ?? ''}</td>
                        </tr>
                    `;

                    $("#table-user-harian").empty().append(tmp);
                }

                var initChartHariKehadiran = function(data) {
                    var options = {
                        series: [parseFloat(data.persen_hari_kehadiran ?? 0)],
                        chart: {
                            type: 'radialBar',
                            offsetY: -20,
                            sparkline: {
                                enabled: true
                            },
                            height: 250,
                        },
                        colors: customApexChartColors,
                        plotOptions: {
                            radialBar: {
                                startAngle: -90,
                                endAngle: 90,
                                dataLabels: {
                                    name: {
                                        show: false
                                    },
                                    value: {
                                        offsetY: -2,
                                        fontSize: '22px'
                                    }
                                }
                            }
                        },
                        grid: {
                            padding: {
                                top: -10
                            }
                        },
                        labels: ['Average Results'],
                    };

                    var chart = new ApexCharts(document.querySelector("#chart-user-hari-kehadiran"), options);
                    chart.render();
                }

                var initTableHariKehadiran = function(data) {
                    let tmp = `
                        <tr>
                            <td>Total Hari Kerja</td>
                            <td class="text-end fw-bold">${data.total_hari_kerja ?? ''} / ${data.total_hari_kerja_saat_ini ?? ''}</td>
                        </tr>
                        <tr>
                            <td>-+ Hari Kerja</td>
                            <td class="text-end fw-bold">${data.kurleb_hari_kerja ?? ''}</td>
                        </tr>
                    `;

                    $("#table-user-hari-kehadiran").empty().append(tmp);
                }

                var initChartJamKehadiran = function(data) {
                    var options = {
                        series: [parseFloat(data.persen_jam_kehadiran ?? 0)],
                        chart: {
                            type: 'radialBar',
                            offsetY: -20,
                            sparkline: {
                                enabled: true
                            },
                            height: 250,
                        },
                        colors: customApexChartColors,
                        plotOptions: {
                            radialBar: {
                                startAngle: -90,
                                endAngle: 90,
                                dataLabels: {
                                    name: {
                                        show: false
                                    },
                                    value: {
                                        offsetY: -2,
                                        fontSize: '22px'
                                    }
                                }
                            }
                        },
                        grid: {
                            padding: {
                                top: -10
                            }
                        },
                        labels: ['Average Results'],
                    };

                    var chart = new ApexCharts(document.querySelector("#chart-user-jam-kehadiran"), options);
                    chart.render();
                }

                var initTableJamKehadiran = function(data) {
                    let tmp = `
                        <tr>
                            <td>Total Hari Kerja</td>
                            <td class="text-end fw-bold">${data.total_jam_kerja ?? ''} / ${data.total_jam_kerja_saat_ini ?? ''}</td>
                        </tr>
                        <tr>
                            <td>-+ Hari Kerja</td>
                            <td class="text-end fw-bold">${data.kurleb_jam_kerja ?? ''}</td>
                        </tr>
                    `;

                    $("#table-user-jam-kehadiran").empty().append(tmp);
                }

                // Public methods
                return {
                    init: function() {
                        initChartSebaranKehadiran();
                        initChartRataAbsenDatang();
                        initChartRataAbsenPulang();
                        loadDataUser();
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
