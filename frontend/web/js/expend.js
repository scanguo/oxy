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
    $("#expend-size").on("keyup", function () {
        count();
    });
    $("#expend-unit").on("keyup", function () {
        count();
    });
});

function count() {
    var sum = $("#expend-size").val() * $("#expend-unit").val();
    $("#expend-sum").val(sum);
}

function create() {
    var contact = $("#expend-contact").val();
    var type = $("#expend-type").val();
    var size = $("#expend-size").val();
    var unit = $("#expend-unit").val();
    var sum = $("#expend-sum").val();
    var time = $("#expend-time").val();
    if (contact) {
        $.ajax({
            url: "/expend/create",
            type: "POST",
            dataType: "json",
            data: {
                "contact": contact,
                "type": type,
                "size": size,
                "unit": unit,
                "sum": sum,
                "time": time
            },
            success: function () {
                $("#expend-size").val("");
                $("#expend-unit").val("");
                $("#expend-sum").val("");
            }
        });
    } else {

    }
}

function load() {
    var contact = $("#expend-contact").val();
    var type = $("#expend-type").val();
    $.ajax({
        url: "/expend/load",
        type: "POST",
        dataType: "json",
        data: {
            "contact": contact,
            "type": type
        },
        success: function (data) {
            $("#common-table").html(data.html);
        }
    });
}