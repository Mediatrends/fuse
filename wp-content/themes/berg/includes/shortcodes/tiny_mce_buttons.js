var umb_active_tiny_mce;

(function() {

 /*Accordion*/
    tinymce.PluginManager.add('accordion_btn', function( editor, url ) {
            editor.addButton('accordion_btn', {
                title : 'Accordion',
                image : url+'/img/toggle.png',
                onclick : function() {
                    umb_active_tiny_mce = editor;
                    tb_show('Accordion', 'admin-ajax.php?action=umb_tabs_wizard&shortcode1=accordiongroup&shortcode2=accordion');
                }
            });
        });
    /*Accordion*/
    
    /*Toggle*/
    
    tinymce.PluginManager.add('toggle_btn', function( editor, url ) {
            editor.addButton('toggle_btn', {
                title : 'Toggle',
                image : url+'/img/toggle.png',
                onclick : function() {
                    umb_active_tiny_mce = editor;
                    tb_show('Toggle', 'admin-ajax.php?action=umb_tabs_wizard&shortcode1=togglegroup&shortcode2=toggle');
                }
            });
    });
    /*Toggle*/

    /*Tabs*/
    
        tinymce.PluginManager.add('tab_btn', function( editor, url ) {
            editor.addButton('tab_btn', {
                title : 'Tabs',
                image : url+'/img/tab.png',
                onclick : function() {
                    umb_active_tiny_mce = editor;
                    tb_show('Tabs', 'admin-ajax.php?action=umb_tabs_wizard&shortcode1=tabgroup&shortcode2=tab');
                }
            });
        });
        
    /*Tabs*/

    /*Notification*/
    
        tinymce.PluginManager.add('alert_btn', function( editor, url ) {
            editor.addButton('alert_btn', {
                title : 'Notification',
                image : url+'/img/notification.png',
                onclick : function() {
                    umb_active_tiny_mce = editor;
                    tb_show('Notification', 'admin-ajax.php?action=umb_notification_wizard');
                }
            });
        });

    /*Notificaion*/

   

    /*Highlights*/
    
        tinymce.PluginManager.add('highlight_btn', function( editor, url ) {
            editor.addButton('highlight_btn', {
                title : 'Highlight',
                image : url+'/img/dropcap.png',
                onclick : function() {
                    umb_active_tiny_mce = editor;
                    umb_active_tiny_mce.selection.setContent('[highlight]'+editor.selection.getContent()+'[/highlight]');           
                }
            });
        });

    /*Highlights*/

  
    /*Buttons*/
    
        tinymce.PluginManager.add('button_btn', function( editor, url ) {
            editor.addButton('button_btn', {
                title : 'Button',
                image : url+'/img/buttons.png',
                onclick : function() {
                    umb_active_tiny_mce = editor;
                    tb_show('Buttons', 'admin-ajax.php?action=umb_buttons_wizard');
                }
            });
        });

    /*Buttons*/

    /*Video*/
    
    tinymce.PluginManager.add('video_btn', function( editor, url ) {
            editor.addButton('video_btn', {
                title : 'Video',
                image : url+'/img/video.png',
                onclick : function() {
                    umb_active_tiny_mce = editor;
                    tb_show('Video', 'admin-ajax.php?action=umb_video_wizard');
                }
            });
        });
    
  
    /*Video*/

    
    /*Layout*/
    
    
      tinymce.PluginManager.add('layout_btn', function( editor, url ) {
        editor.addButton( 'layout_btn', {
            title: 'Layout',
            type: 'menubutton',
            icon: ' fa fa-th',
            menu: [
                {
                    text: 'Full Width',
                    value: "[layout_btn][layout_group][full_width][/full_width][/layout_group][/layout_btn]",
                    onclick: function() {
                        editor.insertContent(this.value());
                    }
                },
                {
                    text: 'Half Width',
                    value: '[layout_btn][layout_group][half_width][/half_width][half_width][/half_width][/layout_group][/layout_btn]',
                    onclick: function() {
                        editor.insertContent(this.value());
                    }
                },
                {
                    text: 'One Third',
                    value: '[layout_btn][layout_group][one_third][/one_third][one_third][/one_third][one_third][/one_third][/layout_group][/layout_btn]',
                    onclick: function() {
                        editor.insertContent(this.value());
                    }
                },
                 {
                    text: 'One Fourth',
                    value: '[layout_btn][layout_group][one_fourth][/one_fourth][one_fourth][/one_fourth][one_fourth][/one_fourth][one_fourth][/one_fourth][/layout_group][/layout_btn]',
                    onclick: function() {
                        editor.insertContent(this.value());
                    }  
                },
                 {
                    text: 'One Sixth',
                    value: '[layout_btn][layout_group][one_sixth][/one_sixth][one_sixth][/one_sixth][one_sixth][/one_sixth][one_sixth][/one_sixth][one_sixth][/one_sixth][one_sixth][/one_sixth][/layout_group][/layout_btn]',
                    onclick: function() {
                        editor.insertContent(this.value());
                    }
                }
                
           ]
        });
    });
   
})();