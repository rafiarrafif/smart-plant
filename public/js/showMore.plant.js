$(document).ready(function () {});

function isDesktop() {
    return window.innerWidth > 768;
}

// Functional Feature - Sesuaikan dengan manifest
function closeShowMore() {
    $(".show-more-content").fadeOut();
    $("#show-less-trigger").hide();
    $("#show-more-trigger").show();

    setTimeout(function () {
        $(".show-more-btn .icon").css({
            rotate: "45deg",
            marginTop: "-2px",
        });
    }, 400);
}

function openShowMore() {
    $(".show-more-content").fadeIn();
    $("#show-less-trigger").show();
    $("#show-more-trigger").hide();

    setTimeout(function () {
        $(".show-more-btn .icon").css({
            rotate: "225deg",
            marginTop: "3px",
        });
    }, 200);
}

function RedirectPage(loc) {
    window.location.href = loc;
}
