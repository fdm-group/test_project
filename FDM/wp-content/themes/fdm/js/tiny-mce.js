
(function(){
  tinymce.create('tinymce.plugins.MyPluginName', {
    init: function(ed, url){
      ed.addButton('myblockquotebtn', {
        title: 'FDM Button',
        cmd: 'myBlockquoteBtnCmd',
        image: url + '/../images/centre-marker.png'
      });
      ed.addCommand('myBlockquoteBtnCmd', function(){
        var selectedText = ed.selection.getContent({format: 'html'});
        var win = ed.windowManager.open({
          title: 'FDM Button',
          body: [
            {
                        type: 'listbox', 
                        name: 'style', 
                        label: 'Style', 
                        'values': [
                            {text: 'Black background', value: 'black'},
                            {text: 'White Background', value: 'white'}
                        ]
             },
            {
              type: 'textbox',
              name: 'link',
              label: 'URL',
              minWidth: 500,
              value: ''
            },
             {
              type: 'textbox',
              name: 'content',
              label: 'Text',
              minWidth: 500,
              value: selectedText
            }
          ],
          buttons: [
            {
              text: "Ok",
              subtype: "primary",
              onclick: function() {
                win.submit();
              }
            },
            {
              text: "Cancel",
              onclick: function() {
                win.close();
              }
            }
          ],
          onsubmit: function(e){
            var params = [];
            var paramsString = '';
            if( e.data.style.length > 0 ) {
              params.push('class="sweep-to-right ' + e.data.style + '"');
            }
          
            if( e.data.link.length > 0 ) {
              params.push('link="' + e.data.link + '"');
            }
            if( params.length > 0 ) {
              paramsString = ' ' + params.join(' ');
            }
            var returnText = '<a href="' + e.data.link + '" '+paramsString+' >'+e.data.content+' <i class="fa fa-angle-right"></i></a>';
            ed.execCommand('mceInsertContent', 0, returnText);
          }
        });
      });
    },
    getInfo: function() {
      return {
        longname : 'My Custom Buttons',
        author : 'Plugin Author',
        authorurl : 'https://www.axosoft.com',
        version : "1.0"
      };
    }
  });
  tinymce.PluginManager.add( 'mytinymceplugin', tinymce.plugins.MyPluginName );
})();