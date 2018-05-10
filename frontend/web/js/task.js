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
    var contact = $("#task-contact").val();
    var time = $("#task-time").val();
    if (contact) {
        $.ajax({
            url: "/task/create",
            type: "POST",
            dataType: "json",
            data: {
                "contact": contact,
                "time": time
            },
            success: function () {
                
            }
        });
    } else {

    }
}

function load() {
    var contact = $("#task-contact").val();
    $.ajax({
        url: "/task/load",
        type: "POST",
        dataType: "json",
        data: {
            "contact": contact
        },
        success: function (data) {
            $("#common-table").html(data.html);
        }
    });
}