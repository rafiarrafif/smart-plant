$(document).ready(function () {
    // Jangan matikan lazy loading agar tidak menyebabkan Huge proses
    setTimeout(function () {
        getShowerHistory();
    }, 800);
});

function getShowerHistory() {
    var csrf = $("#metadata").data("csrf");
    var url = $("#metadata").data("shower-history");

    $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: csrf,
        },
        success: function (data) {
            $("#card-history").empty().append(data);
            $(".history-container .head .refresh")
                .removeClass("active")
                .prop("disabled", false);
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function refreshShowerHistory() {
    $(".history-container .head .refresh")
        .addClass("active")
        .prop("disabled", true);
    getShowerHistory();
}
