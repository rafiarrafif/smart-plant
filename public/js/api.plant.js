var IntervalAPI;

$(document).ready(function () {
    startAPI();
});

function startAPI() {
    triggerGetAPI();
    IntervalAPI = setInterval(function () {
        triggerGetAPI();
    }, 1200);
}

function stopAPI() {
    clearInterval(IntervalAPI);
}

function triggerGetAPI() {
    var url = $("#metadata").data("url");
    var csrf = $("#metadata").data("csrf");

    $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: csrf,
        },
        success: function (data) {
            $("#mainHighlight").html(data.plant.celcius + "<sup>°</sup>");
            $("#airHighlight").text("%" + data.plant.air);
            $("#tempHighlight").text(data.plant.fahrenheit + "°F");
            $("#soilHighlight").text("%" + data.plant.soilPercent);

            $("#connection").html(data.plant.connection);
            $("#airMeasure").html(data.plant.air + "%");
            $("#soilMeasurePercent").html(data.plant.soilPercent + "%");
            $("#soilMeasure").html(data.plant.soil);
            $("#tempCelcius").html(data.plant.celcius + " °C");
            $("#tempFahrenheit").html(data.plant.fahrenheit + " °F");
            $("#tempReamur").html(data.plant.reamur + " °Ré");
            $("#tempKelvin").html(data.plant.kelvin + " K");
            $("#lastUpdated").html(data.plant.lastUpdated);

            if (data.plant.connection == "Terputus") {
                $(".shower-card").removeClass("active");
                $(".disconnect").addClass("active");
            } else if (
                (data.plant.trigger_shower == true &&
                    data.plant.callback_shower == false) ||
                (data.plant.trigger_shower == false &&
                    data.plant.callback_shower == true)
            ) {
                $(".shower-card").removeClass("active");
                $(".loading").addClass("active");
            } else if (
                data.plant.trigger_shower == true &&
                data.plant.callback_shower == true
            ) {
                $(".shower-card").removeClass("active");
                $(".turn-off").addClass("active");
            } else if (
                data.plant.trigger_shower == false &&
                data.plant.callback_shower == false
            ) {
                $(".shower-card").removeClass("active");
                $(".turn-on").addClass("active");
            }
        },
        error: function (data) {
            console.log(data);
        },
    });
}
