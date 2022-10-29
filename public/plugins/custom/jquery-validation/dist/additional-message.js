jQuery.extend(jQuery.validator.messages, {
    required: "Bagian ini harus diisi.",
    remote: "Bagian ini tidak sesuai.",
    email: "Email tidak valid.",
    url: "URL tidak valid.",
    date: "Tanggal tidak valid.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Angka tidak valid.",
    digits: "Bagian ini harus angka.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Nilai tidak sama.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Bagian ini maksimal {0} karakter."),
    minlength: jQuery.validator.format("Bagian ini minimal {0} karakter."),
    rangelength: jQuery.validator.format("Bagian ini antara {0} dan {1} karakter."),
    range: jQuery.validator.format("Bagian ini harus berisi nilai antara {0} dan {1}."),
    max: jQuery.validator.format("Bagian ini maksimal {0}."),
    min: jQuery.validator.format("bagian ini minimal {0}.")
});
