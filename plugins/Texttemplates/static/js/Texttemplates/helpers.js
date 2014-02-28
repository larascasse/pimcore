// some global helper functions
pimcore.registerNS("pimcore.plugin.texttemplate.helpers.x");


pimcore.plugin.texttemplate.helpers.openTexttemplate = function (name) {
    if (pimcore.globalmanager.exists("texttemplates.texttemplate_" + name) == false) {
        pimcore.globalmanager.add("texttemplates.texttemplate_" + name, new pimcore.plugin.textTemplates.texttemplateEditor(name));
    }
    else {
        pimcore.globalmanager.get("texttemplates.texttemplate_" + name).activate();
    }
}

pimcore.plugin.texttemplate.helpers.closeTexttemplate = function (name) {
    var tabPanel = Ext.getCmp("pimcore_panel_tabs");
    tabPanel.remove("texttemplates.texttemplate_" + name);
    pimcore.globalmanager.remove("texttemplates.texttemplate_" + this.name);
}



pimcore.plugin.texttemplate.helpers.initCkEditor = function (layoutConf, editableDivId, object) {

    var toolbar_Full =
            [
                ['Cut','Copy','Paste','PasteText','PasteFromWord','-', 'SpellChecker', 'Scayt'],
                ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
                '/',
                ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
                ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
                ['Link','Unlink','Anchor'],
                ['Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak'],
                '/',
                ['Styles','Format','Font','FontSize'],
                ['TextColor','BGColor'],
                ['Maximize', 'ShowBlocks','Source',"texttemplate", "texttemplatevariable", "DestroyPimcore"]
            ];

    var eConfig = {
        uiColor: "#f2f2f2",
        toolbar: toolbar_Full,
        width: 500,
        height: 300,
        resize_enabled: false
    };

    eConfig.extraPlugins = "texttemplate";
    eConfig.tabSpaces = 4;
    eConfig.removePlugins = 'about,placeholder,flash,smiley,scayt,save,print,preview,newpage,maximize,forms,filebrowser,templates,autogrow,divarea,magicline';

    if (parseInt(layoutConf.width) > 1) {
        eConfig.width = layoutConf.width;
    }
    if (parseInt(layoutConf.height) > 1) {
        eConfig.height = layoutConf.height;
    }

    eConfig.specialChars = [
 		'!','"','#','$','%','&',"'",'(',')','*','+','-','.','/',
 		'0','1','2','3','4','5','6','7','8','9',':',';',
 		'<','=','>','?','@',
 		'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O',
 		'P','Q','R','S','T','U','V','W','X','Y','Z',
 		'[',']','^','_','`',
 		'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p',
 		'q','r','s','t','u','v','w','x','y','z',
 		'{','|','}','~',
 		"€", "‘", "’", "“", "”", "–", "—", "¡", "¢", "£", "¤", "¥", "¦", "§", "¨", "©", "ª", "«", "¬", "®", "¯", "°", "²", "³", "´", "µ", "¶", "·", "¸",
        "¹", "º", "»", "¼", "½", "¾", "¿", "À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï", "Ð", "Ñ", "Ò", "Ó", "Ô", "Õ",
        "Ö", "×", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "Þ", "ß", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ð", "ñ", "ò",
        "ó", "ô", "õ", "ö", "÷", "ø", "ù", "ú", "û", "ü", "ý", "þ", "ÿ", "Œ", "œ", "Ŵ", "Ŷ", "ŵ", "ŷ", "‚", "‛", "„", "…", "™", "►", "•", "→", "⇒",
        "⇔", "♦", "≈", "&Omega;"
 	];

    var ckeditor = CKEDITOR.replace(Ext.get(editableDivId).dom, eConfig);
    ckeditor.pimcoreObject = object;

    if (layoutConf.height) {
        Ext.get(editableDivId).setStyle({
            height: layoutConf.height + "px"
        });
    }
    if (layoutConf.width) {
        Ext.get(editableDivId).setStyle({
            width: layoutConf.width + "px"
        });
    }

    if (Ext.get(editableDivId).getHeight() < 10) {
        Ext.get(editableDivId).setStyle({
            minHeight: "300px"
        });
    }
    ckeditor.resetDirty();
    
    return ckeditor;
}
