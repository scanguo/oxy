/*
 * created by scan
 */

$(document).ready(function () {
    load();
    $(".common-select select").on("change", function () {
        load();
    });
    $("#common-submit").on("click", function () {
        create();
        load();
    });
});

function create() {
    var contact = $("#project-contact").val();
    var time = $("#project-time").val();
    if (contact) {
        $.ajax({
            url: "/project/create",
            type: "POST",
            dataType: "json",
            data: {
                "contact": contact,
                "time": time
            },
            success: function () {
                $("#project-time").val("");
            }
        });
    } else {

    }
}

function load() {
    var contact = $("#project-contact").val();
    $.ajax({
        url: "/project/load",
        type: "POST",
        dataType: "json",
        data: {
            "contact": contact
        },
        success: function (data) {
            $("#common-table").html(data.html);
            set();
        }
    });
}