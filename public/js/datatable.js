let myDtConfigs = function () {
    return {
        language: {
            sProcessing:
                '<i class="spinner spinner-success spinner-sm pr-6"></i> Memproses...',
            lengthMenu: "_MENU_ Data per halaman",
            zeroRecords: "Tidak Ada Data",
            info: "_START_ - _END_ dari _TOTAL_ data",
            infoEmpty: "Tidak Ada data",
            emptyTable: "Tidak Ada data",
            infoFiltered: "(difilter dari _MAX_ total data)",
            sSearch: "Cari:",
            // oPaginate: {
            //     sFirst: "Pertama",
            //     sLast: "Terakhir",
            //     sNext: "Selanjutnya",
            //     sPrevious: "Sebelumnya",
            // },
        },
        responsive: true,
        orderCellsTop: true,
        retrieve: true,
        pagingType: "full_numbers",
        // dom: `<'row'<'col-sm-12'tr>>
        //         <'row'<'col-sm-12 col-md-5'p><'col-sm-12 col-md-7 dataTables_pager'li>>`,
        paging: true,
        processing: true,
        serverSide: true,
        stateSave: true,
        order: [],
        ajax: {
            url: "",
            type: "get",
            // headers: {
            //     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            // },
            data: function (d) {},
        },
        columns: [],
        initComplete: function (settings, json) {
            var table = settings.oInstance.api();
            var thisTable = this;
            var rowFilter = $('<tr class="filter"></tr>').appendTo(
                $(table.table().header())
            );
            var columns = this.api().columns();

            columns.every(function () {
                var column = this;
                var input;

                if (column.visible()) {
                    input = $(
                        `<input type="search" class="form-filter form-control form-control-sm"
                            data-col-index="${column.index()}"
                        "/>`
                    );

                    $(input).appendTo($("<th>").appendTo(rowFilter));
                }
            });

            // hide search column for responsive table
            var hideSearchColumnResponsive = function () {
                thisTable
                    .api()
                    .columns()
                    .every(function () {
                        var column = this;
                        if (column.responsiveHidden()) {
                            $("tr.filter").find("th").eq(column.index()).show();
                        } else {
                            $("tr.filter").find("th").eq(column.index()).hide();
                        }
                    });
            };
            // init on datatable load
            hideSearchColumnResponsive();
            // recheck on window resize
            window.onresize = hideSearchColumnResponsive;

            //begin::filter
            $(table.table().header()).on("input", ".form-filter", function (e) {
                e.preventDefault();
                var params = {};
                $(table.table().header())
                    .find(".form-filter")
                    .each(function () {
                        var i = $(this).data("col-index");
                        if (params[i]) {
                            params[i] += "|" + $(this).val();
                        } else {
                            params[i] = $(this).val();
                        }
                    });
                $.each(params, function (i, val) {
                    // apply search params to datatable
                    table.column(i).search(val ? val : "", false, false);
                });
                table.table().draw();
            });

            let state = table.state.loaded();
            if (state) {
                table
                    .columns()
                    .eq(0)
                    .each(function (colIdx) {
                        var colSearch = state.columns[colIdx].search;
                        //console.log(colSearch.search);
                        if (colSearch.search) {
                            console.log(colIdx);
                            $(table.table().header())
                                .find(
                                    ".form-filter[data-col-index='" +
                                        colIdx +
                                        "']"
                                )
                                .val(colSearch.search);
                        }
                    });
            }
            //end::filter
        },
    };
};
