function turnOnShower() {
    stopAPI();
    $("#turn-on-popup").fadeIn().css("display", "flex");
}

function cancelTurnOnShower() {
    $("#turn-on-popup").fadeOut();
    startAPI();
}

function confirmTurnOnShower(plant) {
    $("#turn-on-popup").fadeOut();
    $(".turn-on").removeClass("active");
    $(".loading").addClass("active");

    var url = $("#metadata").data("trigger");
    var csrf = $("#metadata").data("csrf");
    $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: csrf,
            name: plant,
            action: "turn-on",
        },
        success: function (data) {
            console.log(data.status);
            startAPI();
        },
        error: function (data) {
            console.log(data.error);
        },
    });
}

function turnOffShower() {
    stopAPI();
    $("#turn-off-popup").fadeIn().css("display", "flex");
}

function cancelTurnOffShower() {
    $("#turn-off-popup").fadeOut();
    startAPI();
}

function confirmTurnOffShower(plant) {
    $("#turn-off-popup").fadeOut();
    $(".turn-off").removeClass("active");
    $(".loading").addClass("active");

    var url = $("#metadata").data("trigger");
    var csrf = $("#metadata").data("csrf");
    $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: csrf,
            name: plant,
            action: "turn-off",
        },
        success: function (data) {
            console.log(data.status);
            startAPI();
        },
        error: function (data) {
            console.log(data.error);
        },
    });
}
