/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
       
    // Define changes to default configuration here. For example:
    config.language = 'zh-cn';
    //config.toolbar = 'Basic';
    config.toolbar_Full= [['Styles', 'Bold', 'Italic', 'Underline', 'SpellChecker', 'Scayt', '-', 'NumberedList', 'BulletedList'],
    ['Link', 'Unlink'], ['Undo', 'Redo', '-', 'SelectAll']];
    config.linkShowAdvancedTab =false;
// config.uiColor = '#AADC6E';
};
CKEDITOR.on('instanceReady', function(){ 
    //CKEDITOR.instances.code.on('contentDom', function() {
            CKEDITOR.instances.code.document.on('keyup', function(event) {
                event.preventDefault();
                var text =this.getBody().getHtml();
                $('#preview code').html(text);
                prettyPrint();
            });
      //  });
    });
CKEDITOR.on( 'dialogDefinition', function( ev )
{
    // Take the dialog name and its definition from the event
    // data.
    var dialogName = ev.data.name;
    var dialogDefinition = ev.data.definition;

    // Check if the definition is from the dialog we're
    // interested on (the "Link" dialog).
    if ( dialogName == 'link' )
    {
        // Get a reference to the "Link Info" tab.
        //var dd = dialogDefinition;
        //infoTab.remove( 'linkType' );
        dialogDefinition.removeContents('advanced');
        dialogDefinition.removeContents('target');
 
        tabInfo = dialogDefinition.getContents('info');
        tabInfo.remove('url');
        tabInfo.remove('linkType');
        tabInfo.remove('browse');
        tabInfo.remove('protocol');
 
        tabInfo.add({
            type : 'text',
            id : 'urlNew',
            label : 'URL',
            setup : function(data)
            {
                if (typeof(data.url) !== 'undefined')
                {
                    this.setValue(data.url.url);
                }
            },
            commit : function(data)
            {
                data.url = {
                    url: this.getValue()
                };
            }
        });
 
        tabInfo.add({
            type : 'checkbox',
            id : 'newPage',
            label : 'Open link in a new page',
            commit : function(data)
            {
                if (this.getValue())
                {
                    data.target = '_blank';
                }
                return data;
            }
        });
       // var linktypeField = infoTab.get( 'linkType' );
        /* Remove it from the array of items */
       // linktypeField['items'].splice(1, 1);
    }
});