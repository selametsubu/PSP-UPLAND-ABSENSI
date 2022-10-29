const datePickerConfig = {
    autoUpdateInput: false,
    locale: {
        format: "DD-MM-YYYY",
    },
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format("YYYY"), 10),
};

const validatorConfigs = {
    errorElement: "span",
    errorPlacement: function (error, element) {
        error.addClass("text-danger");
        element.closest(".fv-row").append(error);
    },
};

let tinyMceConfigs = {
    height: 400,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor autosave",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table paste imagetools wordcount",
    ],
    toolbar:
        "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    setup: function (editor) {
        editor.on("change", function () {
            editor.save();
        });
    },
};
