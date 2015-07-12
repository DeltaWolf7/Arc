(function (factory) {
    /* global define */
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else {
        // Browser globals: jQuery
        factory(window.jQuery);
    }
}(function ($) {
    // template, editor
    var tmpl = $.summernote.renderer.getTemplate();

    // add plugin
    $.summernote.addPlugin({
        name: 'special chars', // name of plugin
        buttons: {// buttons
            charsDropdown: function () {
                var list = '<li><a data-event="charsDropdown" href="#" data-value="sqr">&radic; Square Root</a></li>';
                list += '<li><a data-event="charsDropdown" href="#" data-value="deg">&deg; Degree</a></li>';
                list += '<li><a data-event="charsDropdown" href="#" data-value="plusmin">&plusmn; Plus/Minus</a></li>';
                list += '<li><a data-event="charsDropdown" href="#" data-value="div">&divide; Divide</a></li>';
                list += '<li><a data-event="charsDropdown" href="#" data-value="pi">&pi; Pi</a></li>';
                list += '<li><a data-event="charsDropdown" href="#" data-value="sig">Σ Sigma</a></li>';
                var dropdown = '<ul class="dropdown-menu">' + list + '</ul>';

                return tmpl.iconButton('fa fa-header', {
                    title: 'Special Characters',
                    hide: true,
                    dropdown: dropdown
                });
            }
        },
        events: {// events
            charsDropdown: function (event, editor, layoutInfo, value) {
                // Get current editable node
                var $editable = layoutInfo.editable();
                var html;
                switch (value) {
                    case "sqr":
                        html = '√';
                        break;
                    case "deg":
                        html = '°';
                        break;
                    case "plusmin":
                        html = '±';
                        break;
                    case "div":
                        html = '÷';
                        break;
                    case "pi":
                        html = 'Π';
                        break;
                    case "sig":
                        html = 'Σ';
                        break;
                }
                editor.insertText($editable, html);
            }
        }
    });
}));
