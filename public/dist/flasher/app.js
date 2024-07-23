(function (window, document, $, undefined) {
    "use strict";

    // With vanilla JavaScript
    document.addEventListener(
        "DOMContentLoaded",
        function () {
            window.FlashMessage.addCustomVerbs("forbidden", "disabled");

            // Add flash behavior on existing DOM element
            Flash.create(".js-msg");

            // Create a flash bag and attach messages into it

            document
                .getElementById("flash-btn")
                .addEventListener("click", function () {
                    new window.FlashMessage(
                        this.dataset.message,
                        this.dataset.type,
                        {
                            timeout: this.dataset.timeout,
                            progress: true,
                            // thumb: 'https://pbs.twimg.com/profile_images/659436766420672512/-pS2Bgfl.jpg'
                        }
                    );
                });
        },
        false
    );

    // OR

    // With a jQuery plugin
    $("document").ready(function () {
        $(".jq-msg").flashjs();
    });
})(window, document, jQuery);
