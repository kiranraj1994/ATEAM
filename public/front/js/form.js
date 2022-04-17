$(function() {
    $("#eventForm").on("submit", function(e) {
        e.preventDefault();
        let data = new FormData(this);
        $(".error-text").empty();
        $(".error-icon").removeClass("fa fa-close");
        $(this).find(":submit").attr("disabled", true);
        let actionUrl = $(this).attr("action");
        $.ajax({
            url: actionUrl,
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                if (data.status == 200) {
                    window.location.href = data.redirectUrl;
                } else {
                    $("#eventForm").find(":submit").attr("disabled", false);
                    Toast.fire({
                        icon: "error",
                        title: data.message,
                    });
                    if (data.error) {
                        printErrorMsg(data.error);
                    }
                }
            },
        });
    });

    $("#DeleteMultipleForm").on("submit", function(e) {
        e.preventDefault();
        let data = new FormData(this);
        let actionUrl = $(this).attr("action");
        $.ajax({
            url: actionUrl,
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                if (data.status == 200) {
                    $("#alert_confirm_div").modal("hide");
                    $("#example1").DataTable().ajax.reload();
                }
            },
        });
    });
});

function printErrorMsg(msg) {
    $.each(msg, function(key, value) {
        $("." + key + "_err").text(value);

        var inventoryErrorFirstTabId = $("." + key + "_err")
            .closest(".tab-pane")
            .attr("id");
        $("#" + inventoryErrorFirstTabId + "-tab > .error-icon").addClass(
            "fa fa-close"
        );
    });

    $("html, body").animate({
            scrollTop: $("." + Object.keys(msg)[0] + "_err")
                .parent()
                .offset().top - 80,
        },
        1500
    );
}