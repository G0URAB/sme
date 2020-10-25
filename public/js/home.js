$(document).ready(function () {
    window.quill.enable(false);
    $(".ql-toolbar.ql-snow").css("display", "none");
    $(".ql-container.ql-snow").css("border", "0px solid white");
    $("#save_cancel_buttons").css("display", "none");

    $("#edit_delta").click(function () {

        var quill_options = {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions,
                imageResize: true,
            },
        };
        window.quill = new Quill('#editor', quill_options);

        $("#save_cancel_buttons").css("display", "block");
        $(this).css("display", "none");
        $(".ql-editor").focus();
        $(".ql-toolbar.ql-snow").css("display", "block");
        $(".ql-container.ql-snow").css("border", "1px solid white");

        var toolbar = quill.getModule('toolbar');
        toolbar.addHandler('image', imageHandler);
        window.quill.enable(true);
    });

    $("#save_delta").click(function () {
        $("#edit_delta").css("display", "block");
        $(".ql-toolbar.ql-snow").css("display", "none");
        $(".ql-container.ql-snow").css("border", "0px solid white");
        $("#save_cancel_buttons").css("display", "none");
        quill.enable(false);
        var new_delta = JSON.stringify(quill.getContents());
        console.log($("#delta-container").attr("data-actionPath"));
        $.ajax({
            type: 'POST',
            url: $("#delta-container").attr("data-actionPath"),
            dataType: "json",
            async: true,
            data: {
                content: new_delta,
                files: image_files,
                type: 'new_delta',
                id: $("#delta-container").attr("data-userId")
            },
            success: function (response) {
                location.reload();
            }
        });

    });

    $("#cancel_delta").click(function () {

        $(".ql-toolbar.ql-snow").css("display", "none");
        $(".ql-container.ql-snow").css("border", "0px solid white");
        $("#save_cancel_buttons").css("display", "none");
        window.quill.enable(false);

        $.ajax({
            type: 'POST',
            url: $("#delta-container").data("actionPath"),
            data: {
                type: 'cancel_delta',
                files: image_files
            },
            success: function (response) {
                location.reload();
            }
        });

    });

    $(".navbar-toggler").on("click",function () {
        let navBar = $("#navbarText");
        if(!navBar.is(':visible'))
          navBar.css({"display":"block"});
        else
          navBar.css({"display":"none"});
    });

});
