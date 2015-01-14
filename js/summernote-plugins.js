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
    var editor = $.summernote.eventHandler.getEditor();
    // add plugin
    $.summernote.addPlugin({
        name: 'special chars', // name of plugin
        buttons: {// buttons
            super: function () {
                return tmpl.iconButton('fa fa-superscript', {
                    event: 'super',
                    title: 'Superscript',
                    hide: true
                });
            },
            sub: function () {
                return tmpl.iconButton('fa fa-subscript', {
                    event: 'sub',
                    title: 'Subscript',
                    hide: true
                });
            }
        },
        events: {// events
            super: function (layoutInfo) {
                // Get current editable node
                var $editable = layoutInfo.editable();
                // Call insertText with 'hello'
                var html = $('<sup>Enter Text</sup>');
                editor.insertNode($editable, html[0], true);
            },
            sub: function (layoutInfo) {
                // Get current editable node
                var $editable = layoutInfo.editable();
                // Call insertText with 'hello'
                var html = $('<sub>Enter Text</sub>');
                editor.insertNode($editable, html[0], true);
            }
        }
    });
}));
