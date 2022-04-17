$(function() {
    setTimeout(function() {
        $(".loaderDiv").addClass("hide");
    }, 1000);

    // console.log(moment().subtract(18, "y").format("DD-MM-YYYY"));
    $("#dob").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        startDate: moment().subtract(18, "y").format("DD-MM-YYYY"),
        maxDate: moment().subtract(18, "y").format("DD-MM-YYYY"),
        locale: {
            format: "DD-MM-YYYY",
        },
    });

    $("#dob").val("");
    $("#dob").attr("placeholder", "D.O.B*");

    $("#eventDate").daterangepicker({
        showDropdowns: true,
        startDate: moment(),
        minDate: moment(),
        locale: {
            format: "DD-MM-YYYY",
        },
    });

    $("#eventDateFilter").daterangepicker({
        showDropdowns: true,
        startDate: moment(),
        minDate: moment(),
        locale: {
            format: "DD-MM-YYYY",
        },
    });

    $("#eventDateFilter").val("");
    $("#eventDateFilter").attr("placeholder", "Filter By Date");

    // Image gallery And Preview start
    $(".image").change(function(e) {
        let reader = new FileReader();
        let previewTag = $(this)
            .parentsUntil(".imageSection")
            .siblings(".previewBox")
            .children();

        reader.onload = (e) => {
            $(previewTag).attr("src", e.target.result);
        };
        reader.readAsDataURL(this.files[0]);
    });

    function multiTaskOperation(task, $this) {
        var selected = new Array();
        $("#example1 input.recordcheckbox:checked").each(function() {
            selected.push($(this).val());
        });
        if (selected.length == 0) {
            $("#alert_message_div").modal("show");
            $("#alert_message_div")
                .find("#alert_message_div_header")
                .text("Oh!");
            $("#alert_message_div")
                .find("#alert_message_div_message")
                .text("Please select at least one record");
        } else {
            var taskurl = $($this).attr("data-taskurl");
            showConfirmDialogTableMultiple(task, taskurl);
        }
    }

    //Show Confirm Dialog Popup
    function showConfirmDialogTableMultiple(task, taskurl) {
        $("#alert_confirm_div").modal("show");
        $("#alert_confirm_div")
            .find("#confirm_alert_message_header")
            .text("Please Confirm");
        $("#alert_confirm_div")
            .find("#confirm_alert_message_body")
            .text(
                "Are you sure you want to " + task + " the selected records ?"
            );

        if (task == "Delete")
            $("#alert_confirm_div").find(".confirm_btn").addClass("btn-danger");

        $("#alert_confirm_div")
            .find("#DeleteMultipleForm")
            .attr("action", taskurl);

        var selected = new Array();
        $("#example1 input.recordcheckbox:checked").each(function() {
            selected.push($(this).val());
        });
        $("#alert_confirm_div").find("#multiple_Ids").val(selected);
        $("#alert_confirm_div").find("#task").val(task);
    }
    $(document).on("change", "#example1 .group-checkable", function() {
        var set = $(this).attr("data-set");
        var checked = $(this).is(":checked");
        $(set).each(function() {
            if (checked) {
                $(this).attr("checked", true);
            } else {
                $(this).attr("checked", false);
            }
        });
        $.uniform.update(set);
    });
});

function multiTaskOperation(task, $this) {
    var selected = new Array();
    $("#example1 input.recordcheckbox:checked").each(function() {
        selected.push($(this).val());
    });
    if (selected.length == 0) {
        $("#alert_message_div").modal("show");
        $("#alert_message_div").find("#alert_message_div_header").text("Oh!");
        $("#alert_message_div")
            .find("#alert_message_div_message")
            .text("Please select at least one record");
    } else {
        var taskurl = $($this).attr("data-taskurl");
        showConfirmDialogTableMultiple(task, taskurl);
    }
}

//Show Confirm Dialog Popup
function showConfirmDialogTableMultiple(task, taskurl) {
    $("#alert_confirm_div").modal("show");
    $("#alert_confirm_div")
        .find("#confirm_alert_message_header")
        .text("Please Confirm");
    $("#alert_confirm_div")
        .find("#confirm_alert_message_body")
        .text("Are you sure you want to " + task + " the selected records ?");

    if (task == "Delete")
        $("#alert_confirm_div").find(".confirm_btn").addClass("btn-danger");

    $("#alert_confirm_div").find("#DeleteMultipleForm").attr("action", taskurl);

    var selected = new Array();
    $("#example1 input.recordcheckbox:checked").each(function() {
        selected.push($(this).val());
    });
    $("#alert_confirm_div").find("#multiple_Ids").val(selected);
    $("#alert_confirm_div").find("#task").val(task);
}

$(document).on("change", "#example1 .group-checkable", function() {
    var set = $(this).attr("data-set");
    var checked = $(this).is(":checked");
    $(set).each(function() {
        if (checked) {
            $(this).attr("checked", true);
        } else {
            $(this).attr("checked", false);
        }
    });
    $.uniform.update(set);
});