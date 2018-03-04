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
    var type = $("#contact-type").val();
    var name = $("#contact-name").val();
    var phone = $("#contact-phone").val();
    var remark = $("#contact-remark").val();
    if (name && phone) {
        $.ajax({
            url: "/contact/create",
            type: "POST",
            dataType: "json",
            data: {
                "name": name,
                "phone": phone,
                "remark": remark,
                "type": type
            },
            success: function () {
                $("#contact-name").val("");
                $("#contact-phone").val("");
                $("#contact-remark").val("");
            }
        });
    } else {

    }
}

function load() {
    var type = $("#contact-type").val();
    $.ajax({
        url: "/contact/load",
        type: "POST",
        dataType: "json",
        data: {
            "type": type
        },
        success: function (data) {
            $("#common-table").html(data.html);
            set();
        }
    });
}