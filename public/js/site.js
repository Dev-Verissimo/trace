$(document).ready(function () {
    $("#inputFilter").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#tableFilter tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

