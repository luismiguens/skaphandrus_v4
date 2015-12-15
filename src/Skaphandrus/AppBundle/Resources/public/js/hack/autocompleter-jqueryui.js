(function ($) {
    'use strict';
    $.fn.autocompleter = function (options) {
        var settings = {
            url_list: '',
            url_get: ''
        };
        return this.each(function () {
            if (options) {
                $.extend(settings, options);
            }
            var $this = $(this), $fakeInput = $('<input type="text" class="form-control" name="fake' + $this.attr('name') + '">');
            $this.hide().after($fakeInput);
            $fakeInput.autocomplete({
                minLength: 4,
                source: settings.url_list,
                select: function (event, ui) {
                    $this.val(ui.item.id);
                }
            });
            if ($this.val() !== '') {
                $.ajax({
                    url: settings.url_get + $this.val(),
                    success: function (name) {
                        $fakeInput.val(name);
                    }
                });
            }
        });
    };
})(jQuery);

(function ($) {
    'use strict';
    $.fn.autocompleterMultiple = function (options) {
        var settings = {
            url_list: '',
            url_get: '',
            form_name: '',
            field_name: '',
        };
        return this.each(function () {
            if (options) {
                $.extend(settings, options);
            }
            var $this = $(this), $fakeInput = $('<input type="text" class="form-control" name="fake' + $this.attr('name') + '">');
            $this.hide().after($fakeInput);
            $fakeInput.autocomplete({
                minLength: 4,
                source: settings.url_list,
                select: function (event, ui) {
                    //alert("selected");
                    //alert(ui.item.id);
                    //$this.val(ui.item.id);

                    var field_id = settings.form_name + '_' + settings.field_name + '_' + ui.item.id;
                    var field_name = settings.form_name + '[' + settings.field_name + '][]';
                    var div_checkboxes = $('#' + settings.form_name + '_' + settings.field_name);

                    $(div_checkboxes).append('<div class="checkbox"><label for="' + field_id + '" >\n\<input checked id="' + field_id + '" name="' + field_name + '" value="' + ui.item.id + '" type="checkbox">' + ui.item.name + '</label></div>');

                    this.value = "";
                    return false;

                }
            });
//            if ($this.val() !== '') {
//                $.ajax({
//                    url:     settings.url_get + $this.val(),
//                    success: function (name) {
//                        $fakeInput.val(name);
//                    }
//                });
//            }
        });
    };
})(jQuery);
