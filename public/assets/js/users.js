(function ($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajaxModal = function (selector, url, title = '', size = 'md') {

        $("#commanModel .modal-dialog").addClass('modal-' + size)
        var uModal = new bootstrap.Modal(document.getElementById(selector.replace('#', '')));
        uModal.show();
        $(selector).find('.modal-title').html(title);
        $(selector).find('.modal-dialog').removeClass('modal-lg').removeClass('modal-md').removeClass('modal-sm').addClass('modal-' + size);
        $(selector).find('.modal-dialog').addClass('modal-' + size);
        $(selector).find('.modal-body').html('Loading...');
        $(selector).find('.modal-footer').html('<button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>');

        $(document).trigger("ajaxPageLoad");

        // Call onload method if it was passed in function call
        if (typeof onLoad != "undefined") {
            onLoad();
        }
        $.ajax({
            url: url,
            success: function (data) {
                $(selector).find('.modal-body').html(data);
            },
            error: function (data) {
                data = data.responseJSON;
            }
        });
        // Reset modal when it hides
        $(selector).on('hidden.bs.modal', function () {
            $(this).find('.modal-body').html('Loading...');
            $(this).find('.modal-footer').html('<button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>');
            $(this).data('bs.modal', null);
        });
    };
    $.showErrors = function (object) {
        console.log('heelo');

        var keys = Object.keys(object);

        $(".has-error").find(".invalid-feedback").remove();
        $(".has-error").removeClass("has-error");

        for (var i = 0; i < keys.length; i++) {
            var ele = $("[name='" + keys[i] + "']");
            if (ele.length == 0) {
                ele = $("#" + keys[i]);
            }
            var grp = ele.closest(".form-group");
            $(grp).find(".invalid-feedback").remove();
            var helpBlockContainer = $(grp).find("div:first");

            if (helpBlockContainer.length == 0) {
                helpBlockContainer = $(grp);
            }

            helpBlockContainer.append('<div class="invalid-feedback">' + object[keys[i]] + '</div>');
            $(grp).addClass("has-error");
        }
    }
})(jQuery);
