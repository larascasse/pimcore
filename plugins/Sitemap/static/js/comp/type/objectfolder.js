pimcore.registerNS("sitemap.comp.type.objectfolder");
sitemap.comp.type.objectfolder = Class.create(sitemap.comp.type.base,{

    type: "objectfolder",


    getTypeName: function () {
        return t("objectfolder");
    },

    getIconClass: function () {
        return "sitemap_icon_objectfolder";
    },

    applyData: function ($super) {
        $super();
        var dd = {};
        for (var key in this.datax){
            if(!key.match("[\[\]]")){
                dd[key]=this.datax[key];
            }
        }


        this.datax = dd;
    },

    onAfterPopulate: function(){
        var select = Ext.getCmp("labelSelect");
        var label = Ext.getCmp("label");        
        var propF = Ext.getCmp("property_label");
        var onlyChilds = Ext.getCmp("onlyChilds");
        var linkSelect = Ext.getCmp('linkSelect');
        var customLink = Ext.getCmp('custom_link');        
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
                label.show();
                break;
            case "property" :
                propF.show();
                label.hide();
                break;
            default :
                propF.hide();                
                label.hide();
                break;
        }
        if(onlyChilds.getValue() == true){
            select.disable();
            label.disable();
            propF.disable();
            linkSelect.disable();
            customLink.disable();
        }else{
            select.enable();
            label.enable();
            propF.enable();
            linkSelect.enable();
            customLink.enable();
        }

        if(linkSelect.getValue()=='custom'){
            customLink.show();
        }else{
            customLink.hide();
        }

        switch (linkSelect.getValue()){
            case "custom":
                customLink.show();                
                break;
            
            default :
                customLink.hide();
                break;
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

       getChildFs: function() {

           var orderStore = new Ext.data.ArrayStore({
            fields: ['id', 'label'],
            data : [['asc','ASC'],['desc','DESC']]
        });

           var cssStore = new Ext.data.ArrayStore({
            fields: ['id', 'label'],
            data : [['nocss','No Css class'],['define','Define Css classe'],['property','Custom property']]
        });

        var childsFs = new Ext.form.FieldSet({
            id:'childsFS',
            title: t("Childs nodes"),
            collapsible: true,
            html:"<h3 style='color:#ff0000;'>Don't forget to add route mapping under this tree node, to complete this operation</h3>",
            defaultType: 'textfield',
            items :[
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
                fieldLabel: t('bool property'),
                name: "ch_property",
                anchor:"100%"
            },
            {
                name:"ch_orderkey",
                anchor:"100%",
                fieldLabel:t('Ordering key')
            },
            {
                id:"ch_orderSens",
                fieldLabel: t('order direction'),
                name: "ch_ordersens",
                queryDelay: 0,
                xtype: "combo",
                displayField:'label',
                valueField: "id",
                mode: 'local',
                store: orderStore,
                editable: false,
                triggerAction: 'all',
                anchor:"100%",
                value:"ASC"
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



    getForm: function($super){
        $super();
        
        var labelStore = new Ext.data.ArrayStore({
            fields: ['id', 'label'],
            data : [['property','Custom property'],['label','Define label'],['key','Folder key']]
        });

        var linkStore = new Ext.data.ArrayStore({
            fields: ['id', 'link'],
            data : [['nolink','No link'],['child','First child'],['custom','Custom link']]
        });

        var cssStore = new Ext.data.ArrayStore({
            fields: ['id', 'label'],
            data : [['nocss','No Css class'],['define','Define Css classe'],['property','Custom property']]
        });


        var thisNode = new Ext.form.FieldSet({
            id:"thisnode",
            title: t("This node"),
            collapsible: true,
            defaultType: 'textfield',            
            items :[{
                fieldLabel: t('objectfolder'),
                name: 'objectfolder',
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
                                if (data.node.attributes.type == "folder" && data.node.attributes.elementType=='object') {
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
                xtype: "checkbox",
                name: "allowchild",
                checked:true,
                fieldLabel: t("Allow childs"),
                hidden:true
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
                        var label = Ext.getCmp("label");                        
                        var propF = Ext.getCmp("property_label");
                        var linkSelect = Ext.getCmp('linkSelect');
                        var customLink = Ext.getCmp('custom_link');
                        if(check == true){
                            select.disable();
                            label.disable();                            
                            propF.disable();
                            linkSelect.disable();
                            customLink.disable();                            
                        }else{
                            select.enable();
                            label.enable();                            
                            propF.enable();
                            linkSelect.enable();
                            customLink.enable();                            
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
                        var labelF = Ext.getCmp("label");
                        var propF = Ext.getCmp("property_label");                        
                        switch (record.data.id){
                            case "label":
                                propF.hide();
                                
                                labelF.show();
                                break;
                            case "property" :
                                propF.show();
                                
                                labelF.hide();
                                break;                            
                            default :
                                propF.hide();
                                labelF.hide();                                
                                break;
                        }
                    }
                }
            },            
            {
                id:"label",
                name:"label",
                anchor:"100%",
                itemCls:"indent_field",
                fieldLabel:t('Label'),
                hidden:true
            },
            {
                id:"property_label",
                name:"proplabel",
                anchor:"100%",
                itemCls:"indent_field",
                fieldLabel:t('Label property'),
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
                value:"custom",
                listeners:{
                    scope:this,
                    'select':function(combo,record,index){
                        var linkF = Ext.getCmp("custom_link");                        
                        switch (record.data.id){
                            case "custom":
                                linkF.show(); 
                                break;                            
                            default :
                                linkF.hide();   
                                break;
                        }
                    }
                }
            },
            {
                id:"custom_link",
                name:"customlink",
                itemCls:"indent_field",
                anchor:"100%",
                fieldLabel:t('Custom link'),
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