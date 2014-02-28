
var callback = function(editor, answer, value){
    editor.insertText(value);
};


var ckeditor_texttemplate_command = {
    exec:function(editor){
        var itemselector = new pimcore.plugin.textTemplates.insertDialog(this.callback.bind(this, editor));
    },
    callback: function(editor, data) {
        editor.insertText(data);
    }
};


var ckeditor_texttemplatevariable_command = {
    exec:function(editor){
        var dialog = new pimcore.plugin.textTemplates.selectVariableDialog(editor.pimcoreObject, this.callback.bind(this, editor));
    },
    callback: function(editor, data) {
        editor.insertText('#{' + data + '}#');
    }
};



// add texttemplate button plugin
var ckeditor_texttemplate_button ='texttemplate';
var ckeditor_texttemplatevariable_button ='texttemplatevariable';
CKEDITOR.plugins.add(ckeditor_texttemplate_button,{
    init:function(editor){
        editor.addCommand(ckeditor_texttemplate_button,ckeditor_texttemplate_command);
        editor.ui.addButton("texttemplate",{
            label:t('texttemplate'),
            icon: "/pimcore/static/img/icon/report_add.png",
            command:ckeditor_texttemplate_button
        });

        editor.addCommand(ckeditor_texttemplatevariable_button,ckeditor_texttemplatevariable_command);
        editor.ui.addButton("texttemplatevariable",{
            label:t('texttemplatevariable'),
            icon: "/pimcore/static/img/icon/package_add.png",
            command:ckeditor_texttemplatevariable_button
        });

    }
});
