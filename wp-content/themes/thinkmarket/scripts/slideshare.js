(function() {
    tinymce.create('tinymce.plugins.slideshare', {
        init : function(editor, url) {
            editor.addButton('slideshare', {
                title: 'Ajout image avec Legende',
                image : url + '/icon/slideshare.png',
                onclick: function () {
                    editor.windowManager.open({
                        title: 'Insert Media',
                        body: [
                           
                            {   type: 'textbox',
                                size: 100,
                                name: 'shortcode',
                                label: 'Shortcode slideshare',
                                classes : 'slideshare-code'
                            },
                           
                        ],
                        buttons: [
                            {
                                text: 'Insert',
                                onclick: function (e) {
                                    var shortcode = jQuery('.mce-slideshare-code').val();
                                    editor.execCommand('mceInsertContent', false, shortcode);
                                    editor.windowManager.close();
                                }
                            },
                            {
                                text: 'Cancel',
                                onclick: 'close'
                            }
                        ]
                    });
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('slideshare', tinymce.plugins.slideshare);
})(jQuery);