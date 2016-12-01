(function() {
    tinymce.create('tinymce.plugins.guillemet_ouvert', {
        init : function(editor, url) {
            editor.addButton('guillemet_ouvert', {
                title: 'Ajout guillemet ouvert',
                image : url + '/icon/quotation-op.png',
                onclick: function () {
                    editor.execCommand('mceInsertContent', false, "<span class='g_open'>&nbsp;</span>");
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('guillemet_ouvert', tinymce.plugins.guillemet_ouvert);
})(jQuery);