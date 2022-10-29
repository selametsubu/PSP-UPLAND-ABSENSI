// const blockUI = new KTBlockUI(document.querySelector("#kt_body"));

const blockUI = new KTBlockUI(document.querySelector("#kt_content"), {
    zIndex: 1500,
    message:
        '<div class="blockui-message"><span class="spinner-border text-primary"></span> Loading...</div>',
    overlayClass: "bg-secondary bg-opacity-25",
});

const alertSaved = function (message, url) {
    if (url) {
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: message,
            showConfirmButton: false,
            timer: 1500,
        }).then((result) => {
            location.href = url;
        });
    } else {
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: message,
            showConfirmButton: false,
            timer: 1500,
        });
    }
};

const alertSavedCallback = function (message, callback) {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: message,
        showConfirmButton: false,
        timer: 1500,
    }).then((result) => {
        if (result) {
            callback();
        }
    });
};

const alertError = function (message) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        html: message,
    });
};

const alertWarning = function (message) {
    Swal.fire({
        icon: "warning",
        title: "Oops...",
        html: message,
    });
};

const ajaxFormSave = function (form) {
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: new FormData(form[0]),
        dataType: "JSON",
        processData: false,
        contentType: false,
        beforeSend: function (body) {
            blockUI.block();
        },
        success: function (res) {
            blockUI.release();
            alertSaved(res.message, res.redirect_url);
        },
        error: function (xhr) {
            alertError(JSON.stringify(xhr.responseJSON.errors));
        },
        complete: function () {
            blockUI.release();
        },
    });
};

const ajaxFormSaveCallback = function (form, callback) {
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: new FormData(form[0]),
        dataType: "JSON",
        processData: false,
        contentType: false,
        beforeSend: function (body) {
            blockUI.block();
        },
        success: function (res) {
            blockUI.release();
            alertSavedCallback(res.message, callback);
        },
        error: function (xhr) {
            alertError(JSON.stringify(xhr.responseJSON.errors));
        },
        complete: function () {
            blockUI.release();
        },
    });
};

const ajaxLoadContent = function (url, data, target, callback) {
    $.ajax({
        url: url,
        type: "get",
        data: data,
        dataType: "html",
        beforeSend: function (body) {
            $(target).empty();
            blockUI.block();
        },
        success: function (res) {
            $(target).html(res);

            if (callback) {
                callback();
            }
        },
        error: function (xhr) {
            alertError("error");
        },
        complete: function () {
            blockUI.release();
        },
    });
};

const ajaxFormDelete = function (form) {
    Swal.fire({
        title: "Yakin hapus data ini?",
        text: "Data yang terhapus tidak bisa dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
        reverseButtons: true,
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: new FormData(form[0]),
                dataType: "JSON",
                processData: false,
                contentType: false,
                beforeSend: function (body) {
                    blockUI.block();
                },
                success: function (res) {
                    blockUI.release();
                    alertSaved(res.message, res.redirect_url);
                },
                error: function (xhr) {
                    alertError(JSON.stringify(xhr.responseJSON.errors));
                },
                complete: function () {
                    blockUI.release();
                },
            });
        }
    });
};

const ajaxFormDeleteCallback = function (form, callback) {
    Swal.fire({
        title: "Yakin hapus data ini?",
        text: "Data yang terhapus tidak bisa dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
        reverseButtons: true,
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: form.attr("action"),
                type: form.attr("method"),
                data: new FormData(form[0]),
                dataType: "JSON",
                processData: false,
                contentType: false,
                beforeSend: function (body) {
                    blockUI.block();
                },
                success: function (res) {
                    blockUI.release();
                    alertSavedCallback(res.message, callback);
                },
                error: function (xhr) {
                    alertError(JSON.stringify(xhr.responseJSON.errors));
                },
                complete: function () {
                    blockUI.release();
                },
            });
        }
    });
};

const ajaxSave = function (url, data, callback) {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url,
        type: "post",
        data: data,
        dataType: "JSON",
        processData: false,
        contentType: false,
        beforeSend: function (body) {
            blockUI.block();
        },
        success: function (res) {
            blockUI.release();
            alertSavedCallback(res.message, callback);
        },
        error: function (xhr) {
            alertError(JSON.stringify(xhr.responseJSON.errors));
        },
        complete: function () {
            blockUI.release();
        },
    });
};

const ajaxDelete = function (url, callback) {
    Swal.fire({
        title: "Yakin hapus data ini?",
        text: "Data yang terhapus tidak bisa dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Iya",
        cancelButtonText: "Tidak",
        reverseButtons: true,
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: url,
                type: "post",
                data: {
                    _method: "delete",
                },
                dataType: "JSON",
                beforeSend: function (body) {
                    blockUI.block();
                },
                success: function (res) {
                    blockUI.release();
                    alertSavedCallback(res.message, callback);
                },
                error: function (xhr) {
                    alertError(JSON.stringify(xhr.responseJSON.errors));
                },
                complete: function () {
                    blockUI.release();
                },
            });
        }
    });
};

const customNumberFormat = function (number, decimal = 2) {
    console.log(
        number.toLocaleString(undefined, {
            maximumFractionDigits: decimal,
            minimumFractionDigits: decimal,
        })
    );
    return number.toLocaleString(undefined, {
        maximumFractionDigits: decimal,
        minimumFractionDigits: decimal,
    });
};

const dateTimeFormat = function (data) {
    return data ? moment(data).format("DD-MM-YYYY hh:mm:ss") : "";
};
const dateFormat = function (data) {
    return data ? moment(data).format("DD-MM-YYYY") : "";
};

const getCurrentDateTime = function () {
    var date = new Date();
    var tahun = date.getFullYear();
    var bulan = date.getMonth();
    var tanggal = date.getDate();
    var hari = date.getDay();
    var jam = date.getHours();
    var menit = date.getMinutes();
    var detik = date.getSeconds();
    switch (hari) {
        case 0:
            hari = "Minggu";
            break;
        case 1:
            hari = "Senin";
            break;
        case 2:
            hari = "Selasa";
            break;
        case 3:
            hari = "Rabu";
            break;
        case 4:
            hari = "Kamis";
            break;
        case 5:
            hari = "Jum'at";
            break;
        case 6:
            hari = "Sabtu";
            break;
    }
    switch (bulan) {
        case 0:
            bulan = "Januari";
            break;
        case 1:
            bulan = "Februari";
            break;
        case 2:
            bulan = "Maret";
            break;
        case 3:
            bulan = "April";
            break;
        case 4:
            bulan = "Mei";
            break;
        case 5:
            bulan = "Juni";
            break;
        case 6:
            bulan = "Juli";
            break;
        case 7:
            bulan = "Agustus";
            break;
        case 8:
            bulan = "September";
            break;
        case 9:
            bulan = "Oktober";
            break;
        case 10:
            bulan = "November";
            break;
        case 11:
            bulan = "Desember";
            break;
    }
    var tanggal = hari + ", " + tanggal + " " + bulan + " " + tahun;
    var waktu = jam + ":" + menit + ":" + detik;
    return [tanggal, waktu];
};

const getTimeZone = function (lat, lng) {
    return (moment().toString().split(' '))[5];
};
