pimcore.registerNS("sitemap.comp.type.document");
sitemap.comp.type.document = Class.create(sitemap.comp.type.base,{

    type: "document",


    getTypeName: function () {
        return t("document");
    },

    getIconClass: function () {
        return "sitemap_icon_document";
    },

    getChildFs: function() {

        var labelStore = new Ext.data.ArrayStore({
            fields: ['id', 'label'],
            data : [['name','Document name'],['title','Document title'],['property','Custom property'],['key','Document key'],['field','Document field']]
        });

        var cssStore = new Ext.data.ArrayStore({
            fields: ['id', 'label'],
            data : [['nocss','No Css class'],['define','Define Css classe'],['property','Custom property']]
        });
        

        var childsFs = new Ext.form.FieldSet({
            id:'childsFS',
            title: t("Childs nodes"),
            collapsible: true,            
            defaultType: 'textfield',
            items :[
            {
                id:'ch_labelselect',
                fieldLabel: t('label variable'),
                name: "ch_labelselect",
                queryDelay: 0,
                xtype: "combo",
                displayField:'label',
                valueField: "id",
                mode: 'local',
                store: labelStore,
                editable: false,
                triggerAction: 'all',
                anchor:"100%",
                value:"title",
                listeners:{
                    scope:this,
                    'select': function(combo,record,index){
                        var propF = Ext.getCmp('ch_property_label');
                        var fieldF = Ext.getCmp('ch_field_label');
                        
                        switch(record.data.id){
                            case "property" :
                                propF.show();
                                fieldF.hide();
                                break;
                            case "field" :
                                fieldF.show();
                                propF.hide();
                                break;
                            default:
                                propF.hide();
                                fieldF.hide();
                                break;
                        }

                    }
                }
            },
            {
                id:"ch_property_label",
                itemCls:"indent_field",
                name:"ch_proplabel",
                anchor:"100%",
                fieldLabel:t('Label property'),
                hidden:true
            },
            {
                id:"ch_field_label",
                itemCls:"indent_field",
                name:"ch_fieldlabel",
                anchor:"100%",
                fieldLabel:t('Field key'),
                hidden:true
            },
            {
                xtype: "checkbox",
                name: "ch_folder",
                checked:false,
                fieldLabel: t("Ignore folder")
            },
            {
                xtype: "numberfield",
                fieldLabel: t("max death"),
                allowDecimals:false,
                name: "ch_death",
                id:"death",
                anchor: "100%"
            },
            {
                xtype: 'superboxselect',
                allowBlank:true,
                queryDelay: 0,
                triggerAction: 'all',
                resizable: true,
                mode: 'local',
                anchor:'100%',
                minChars: 1,
                removeValuesFromStore:false,
                fieldLabel: t("not allowed doctype"),
                emptyText: t('Choose the doctype'),
                name: "ch_doctype",
                store: pimcore.globalmanager.get("document_types_store"),
                displayField: 'name',
                valueField: 'id'
            },
            {
                fieldLabel: t('bool property'),
                name: "ch_property",
                anchor:"100%"
            },
            {
                id:"ch_cssType",
                fieldLabel: t('css variable'),
                name: "ch_cssType",
                queryDelay: 0,
                xtype: "combo",
                displayField:'label',
                valueField: "id",
                mode: 'local',
                store: cssStore,
                editable: false,
                triggerAction: 'all',
                anchor:"100%",
                value:"nocss",
                listeners:{
                    scope:this,
                    'select':function(combo,record,index){
                        var cssDef = Ext.getCmp("ch_css_define");
                        var cssProp= Ext.getCmp("ch_css_property");
                        switch (record.data.id){
                            case "define":
                                cssDef.show();
                                cssProp.hide();
                                break;
                            case "property" :
                                cssProp.show();
                                cssDef.hide();
                                break;
                            default :
                                cssProp.hide();
                                cssDef.hide();
                                break;
                        }
                    }
                }
            },
            {
                id:"ch_css_define",
                name:"ch_css_define",
                itemCls:"indent_field",
                anchor:"100%",
                fieldLabel:t('Define Css class'),
                hidden:true
            },
            {
                id:"ch_css_property",
                name:"ch_css_property",
                itemCls:"indent_field",
                anchor:"100%",
                fieldLabel:t('Css class property'),
                hidden:true
            }
            ]
        });

        return childsFs;
    },

    onAfterPopulate: function(){
        var select = Ext.getCmp("labelSelect");
        var labelF = Ext.getCmp("label_field");
        var propF = Ext.getCmp("property_label");
        var fieldF = Ext.getCmp("field_label");
        var onlyChilds = Ext.getCmp("onlyChilds");
        var linkSelect = Ext.getCmp('linkSelect');
        var customLink = Ext.getCmp('custom_link');
        var allowChilds = Ext.getCmp('allowChilds');
        var childsFS = Ext.getCmp('childsFS');
        var ch_cssDef = Ext.getCmp("ch_css_define");
        var ch_cssProp= Ext.getCmp("ch_css_property");
        var ch_cssType = Ext.getCmp("ch_cssType");
        var cssDef = Ext.getCmp("css_define");
        var cssProp= Ext.getCmp("css_property");
        var cssType = Ext.getCmp("cssType");

        switch (select.getValue()){
            case "label":
                propF.hide();
                labelF.show();
                fieldF.hide();
                break;
            case "property" :
                propF.show();
                labelF.hide();
                fieldF.hide();
                break;
            case "field":
                propF.hide();
                labelF.hide();
                fieldF.show();
                break;
            default :
                propF.hide();
                labelF.hide();
                fieldF.hide();
                break;
        }

        if(onlyChilds.getValue() == true){
            select.disable();
            labelF.disable();
            propF.disable();
            linkSelect.disable();
            customLink.disable();
        }else{
            select.enable();
            labelF.enable();
            propF.enable();
            linkSelect.enable();
            customLink.enable();
        }

        var chPropF = Ext.getCmp('ch_property_label');
        var chFieldF = Ext.getCmp('ch_field_label');

        var chLabelSel = Ext.getCmp('ch_labelselect');
        switch(chLabelSel.getValue()){
                            case "property" :
                                chPropF.show();
                                chFieldF.hide();
                                break;
                            case "field" :
                                chFieldF.show();
                                chPropF.hide();
                                break;
                            default:
                                chPropF.hide();
                                chFieldF.hide();
                                break;
                        }
        

        
        if(linkSelect.getValue()=='custom'){
            customLink.show();
        }else{
            customLink.hide();
        }

        if(allowChilds.getValue() == true){
            childsFS.enable();
        }else{
            childsFS.disable();
        }


        switch (ch_cssType.getValue()){
            case "define":
                ch_cssDef.show();
                ch_cssProp.hide();
                break;
            case "property" :
                ch_cssProp.show();
                ch_cssDef.hide();
                break;
            default :
                ch_cssProp.hide();
                ch_cssDef.hide();
                break;
        }

        switch (cssType.getValue()){
            case "define":
                cssDef.show();
                cssProp.hide();
                break;
            case "property" :
                cssProp.show();
                cssDef.hide();
                break;
            default :
                cssProp.hide();
                cssDef.hide();
                break;
        }
    },


    getForm: function($super){
        $super();
        var labelStore = new Ext.data.ArrayStore({
            fields: ['id', 'label'],
            data : [['name','Document name'],['title','Document title'],['property','Custom property'],['label','Define label'],['key','Document key'],['field','Document field']]
        });

        var linkStore = new Ext.data.ArrayStore({
            fields: ['id', 'link'],
            data : [['doc','Document url'],['nolink','No link'],['child','First child'],['custom','Custom link']]
        });

        var cssStore = new Ext.data.ArrayStore({
            fields: ['id', 'label'],
            data : [['nocss','No Css class'],['define','Define Css classe'],['property','Custom property']]
        });


        var thisNode = new Ext.form.FieldSet({
            title: t("This node"),
            collapsible: true,
            defaultType: 'textfield',
            items :[{
                fieldLabel: t('document'),
                name: 'Document',
                allowBlank:false,
                cls: "input_drop_target",
                anchor: "100%",
                listeners: {
                    "render": function (el) {
                        new Ext.dd.DropZone(el.getEl(), {
                            reference: this,
                            ddGroup: "element",
                            getTargetFromEvent: function(e) {
                                return this.getEl();
                            }.bind(el),

                            onNodeOver : function(target, dd, e, data) {
                                return Ext.dd.DropZone.prototype.dropAllowed;
                            },

                            onNodeDrop : function (target, dd, e, data) {
                                if (data.node.attributes.type == "page") {
                                    this.setValue(data.node.attributes.id);
                                    return true;
                                }
                                return false;
                            }.bind(el)
                        });
                    }
                }
            },
            {
                id:'onlyChilds',
                xtype: "checkbox",
                name: "onlychild",
                checked:false,
                fieldLabel: t("Only childs"),
                listeners:{
                    scope:this,
                    'check':function(checkbox,check){
                        var select = Ext.getCmp('labelSelect');
                        var labelF = Ext.getCmp("label_field");
                        var propF = Ext.getCmp("property_label");
                        var linkSelect = Ext.getCmp('linkSelect');
                        var customLink = Ext.getCmp('custom_link');
                        var allowChilds = Ext.getCmp('allowChilds');
                        if(check == true){
                            select.disable();
                            labelF.disable();
                            propF.disable();
                            linkSelect.disable();
                            customLink.disable();
                            allowChilds.setValue(true);
                            allowChilds.hide();
                        }else{
                            select.enable();
                            labelF.enable();
                            propF.enable();
                            linkSelect.enable();
                            customLink.enable();
                            allowChilds.show();
                        }
                    }
                }
            },
            {
                id:'allowChilds',
                xtype: "checkbox",
                name: "allowchild",
                checked:false,
                fieldLabel: t("Allow childs"),
                listeners:{
                    scope:this,
                    'check':function(checkbox,check){
                        var childsFS = Ext.getCmp('childsFS');                        
                        if(check == true){
                            childsFS.enable();
                        }else{
                            childsFS.disable();                            
                        }
                    }
                }
            },
            {
                id:"labelSelect",
                fieldLabel: t('label variable'),
                name: "labelType",
                queryDelay: 0,
                xtype: "combo",
                displayField:'label',
                valueField: "id",
                mode: 'local',
                store: labelStore,
                editable: false,
                triggerAction: 'all',
                anchor:"100%",
                value:"title",
                listeners:{
                    scope:this,
                    'select':function(combo,record,index){
                        var labelF = Ext.getCmp("label_field");
                        var propF = Ext.getCmp("property_label");
                        var fieldF = Ext.getCmp("field_label");
                        switch (record.data.id){
                            case "label":
                                propF.hide();
                                labelF.show();
                                fieldF.hide();
                                break;
                            case "property" :
                                propF.show();
                                labelF.hide();
                                fieldF.hide();
                                break;
                            case "field":
                                propF.hide();
                                labelF.hide();
                                fieldF.show();
                                break;
                            default :
                                propF.hide();
                                labelF.hide();
                                fieldF.hide();
                                break;
                        }
                    }
                }
            },            
            {
                id:"label_field",
                name:"label",
                itemCls:"indent_field",
                anchor:"100%",
                fieldLabel:t('Label'),
                hidden:true
            },
            {
                id:"property_label",
                name:"proplabel",
                itemCls:"indent_field",
                anchor:"100%",
                fieldLabel:t('Label property'),
                hidden:true
            },
            {
                id:"field_label",
                name:"fieldlabel",
                itemCls:"indent_field",
                anchor:"100%",
                fieldLabel:t('Field key'),
                hidden:true
            },
            {
                id:"linkSelect",
                fieldLabel: t('Link type'),
                name: "linkType",
                queryDelay: 0,
                xtype: "combo",
                displayField:'link',
                valueField: "id",
                mode: 'local',
                store: linkStore,
                editable: false,
                triggerAction: 'all',
                anchor:"100%",
                value:"doc",
                listeners:{
                    scope:this,
                    'select':function(combo,record,index){
                        var labelF = Ext.getCmp("custom_link");
                        if(record.data.id == 'custom'){
                            labelF.show();
                        }else{
                            labelF.hide();
                        }
                    }
                }
            },
            {
                id:"custom_link",
                itemCls:"indent_field",
                name:"customlink",
                anchor:"100%",
                fieldLabel:t('Custom link'),
                hidden:true
            },
            {
                id:"cssType",
                fieldLabel: t('css variable'),
                name: "cssType",
                queryDelay: 0,
                xtype: "combo",
                displayField:'label',
                valueField: "id",
                mode: 'local',
                store: cssStore,
                editable: false,
                triggerAction: 'all',
                anchor:"100%",
                value:"nocss",
                listeners:{
                    scope:this,
                    'select':function(combo,record,index){
                        var cssDef = Ext.getCmp("css_define");
                        var cssProp= Ext.getCmp("css_property");
                        switch (record.data.id){
                            case "define":
                                cssDef.show();
                                cssProp.hide();
                                break;
                            case "property" :
                                cssProp.show();
                                cssDef.hide();
                                break;
                            default :
                                cssProp.hide();
                                cssDef.hide();
                                break;
                        }
                    }
                }
            },
            {
                id:"css_define",
                name:"css_define",
                itemCls:"indent_field",
                anchor:"100%",
                fieldLabel:t('Define Css class'),
                hidden:true
            },
            {
                id:"css_property",
                name:"css_property",
                itemCls:"indent_field",
                anchor:"100%",
                fieldLabel:t('Css class property'),
                hidden:true
            }
            ]
        });
        
        this.form.add(thisNode);
        this.form.add(this.getChildFs());
        this.form.add(this.getSitemapFs());
        return this.form;
    }

});