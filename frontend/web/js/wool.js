/*
 * created by scan
 */

$(document).ready(function () {
    load();
    $(".wool-select select").on("change", function () {
        load();
    });
    $("#wool-submit").on("click", function () {
        create();
        load();
    });
});

function create() {
    var pid = $("#woolcount-pid").val();
    var aid = $("#woolcount-aid").val();
    var date = $("#woolcount-date").val();
    var $in = $("#woolcount-in").val();
    if (pid && aid && $in) {
        $.ajax({
            url: "/wool/create",
            type: "POST",
            dataType: "json",
            data: {
                "pid": pid,
                "aid": aid,
                "date": date,
                "in": $in
            },
            success: function () {
                $("#woolcount-date").val("");
                $("#woolcount-cash").val("");
            }
        });
    } else {

    }
}

function load() {
    var pid = $("#woolcount-pid").val();
    var aid = $("#woolcount-aid").val();
    $.ajax({
        url: "/wool/load",
        type: "POST",
        dataType: "json",
        data: {
            "pid": pid,
            "aid": aid
        },
        success: function (data) {
            $("#wool-table").html(data.html);
            set();
        }
    });
}

function set() {
    $(".set-data").on("click", function () {
        var _this = $(this);
        var key = _this.attr("key");
        var ac = _this.attr("ac");
        var val = _this.parent().find("input").val();
        var back = _this.closest("tr").find("span").text();
        if (!confirm(_this.text() + "了" + val + "？")) {
            return false;
        }
        $.ajax({
            url: "/wool/set",
            type: "POST",
            dataType: "json",
            data: {
                "key": key,
                "ac": ac,
                "val": val
            },
            success: function (data) {
                if (ac == "0" || ac == "1") {
                    _this.closest("tr").find("span").text(val * 1 + back * 1);
                }
                if (ac == "0") {
                    _this.parent().find("input").val("");
                } else {
                    _this.parent().html(data);
                }
            }
        });
        return false;
    });

}