pimcore.registerNS("sitemap.comp.type.objectfield");
sitemap.comp.type.objectfield = Class.create(sitemap.comp.type.base,{

    type: "objectfield",


    getTypeName: function () {
        return t("objectfield");
    },

    getIconClass: function () {
        return "sitemap_icon_objectfield";
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

        var ch_cssDef = Ext.getCmp("ch_css_define");
        var ch_cssProp= Ext.getCmp("ch_css_property");
        var ch_cssType = Ext.getCmp("ch_cssType");

       

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

        


        var thisNode = new Ext.form.FieldSet({
            id:"thisnode",
            title: t("This node"),
            collapsible: true,
            defaultType: 'textfield',
            items :[{
                fieldLabel: t('objectfield name'),
                name: 'objectfield',
                allowBlank:false,
                anchor: "100%"
            },
            {
                xtype: "checkbox",
                name: "allowchild",
                checked:true,
                fieldLabel: t("Allow childs"),
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