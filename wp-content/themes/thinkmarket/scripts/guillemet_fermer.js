(function() {
    tinymce.create('tinymce.plugins.guillemet_fermer', {
        init : function(editor, url) {
            editor.addButton('guillemet_fermer', {
                title: 'Ajout guillemet fermer',
                image : url + '/icon/quotation-close.png',
                onclick: function () {
                    editor.execCommand('mceInsertContent', false, "<span class='g_close'>&nbsp;</span>");
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('guillemet_fermer', tinymce.plugins.guillemet_fermer);
})(jQuery);