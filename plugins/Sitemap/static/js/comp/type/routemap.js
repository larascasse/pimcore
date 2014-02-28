pimcore.registerNS("sitemap.comp.type.routemap");
sitemap.comp.type.routemap = Class.create(sitemap.comp.type.base,{

    type: "routemap",


    getTypeName: function () {
        return t("routemap");
    },

    getIconClass: function () {
        return "sitemap_icon_routemap";
    },

    
    onAfterPopulate: function(){
        var select = Ext.getCmp("labelSelect");
        var label = Ext.getCmp("label");
        var labelF = Ext.getCmp("field_label");
        var propF = Ext.getCmp("property_label");
        var routeSelect = Ext.getCmp('routeSelect');

        switch (select.getValue()){
            case "label":
                propF.hide();
                labelF.hide();
                label.show();
                break;
            case "property" :
                propF.show();
                labelF.hide();
                label.hide();
                break;
            case "field" :
                propF.hide();
                labelF.show();
                label.hide();
                break;
            default :
                propF.hide();
                labelF.hide();
                label.hide();
                break;
        }

        for(var i=0;i<this.arrRouteFS.length;i++){
                    this.arrRouteFS[i].hide();
                }
        var routeName = routeSelect.getValue();
        if (routeName != ""){
        Ext.getCmp('routeFS_'+ routeName).show();
        }
    
    },

    getRouteForm: function(prefix){
        var routeStore = pimcore.globalmanager.get('sitemap.routesStore');
        
        var truc = {};
        truc.arrRoute = new Array();
        truc.prefix = prefix;
        
        routeStore.each(function(record){
            var name = record.data.name;
            var variables = record.data.variables;
            var arrVar = variables.split(',');
            var fields = new Array();
            for (var i=0;i<arrVar.length;i++){


                var compos = new Ext.form.CompositeFieldExtended({
                name: name + "_" + arrVar[i],
                itemCls:"indent_field",
                layout:"form",
                fieldLabel: arrVar[i],
                anchor:"100%",
                items:[
                    {
                    xtype:"displayfield",
                    value:t('enable param')
                },{
                    name:"active",
                    xtype:"checkbox",
                    checked:true
                },
                {
                    name: "variable",                    
                    xtype:'textfield'
                },{
                    xtype:"displayfield",
                    value:t('is field key')
                },{
                    name:"const",
                    xtype:"checkbox",
                    checked:true                    
                }]
                });
                fields.push(compos);
            }

            var tempFS = new Ext.Container({
                id: this.prefix + 'routeFS_' + name,
                hidden:true,
                layout:"form",
                items :[fields]
            });
            this.arrRoute.push(tempFS);


        },truc);

        return truc.arrRoute;

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


    getForm: function($super){
        $super();
        
        this.arrRouteFS = this.getRouteForm("");

        var labelStore = new Ext.data.ArrayStore({
            fields: ['id', 'label'],
            data : [['field','Object field'],['property','Custom property'],['label','Define label'],['key','Object key']]
        });

        
        var thisNode = new Ext.form.FieldSet({
            id:"thisnode",
            title: t("Route mapping"),
            collapsible: true,
            defaultType: 'textfield',            
            items :[{
                xtype:"combo",
                fieldLabel: t("Choose the classe"),
                name: "classe",
                allowBlank:false,
                triggerAction: 'all',
                editable: false,
                store: new Ext.data.JsonStore({
                    url: '/admin/class/get-tree',
                    fields: ["text","id"]
                }),
                displayField: "text",
                anchor:"100%",
                valueField: "text"
            },
            {
                id:"labelSelect",
                fieldLabel: t('label variable'),
                name: "labelType",
                allowBlank:false,
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
                        var fieldF = Ext.getCmp("field_label");
                        switch (record.data.id){
                            case "label":
                                propF.hide();
                                fieldF.hide();
                                labelF.show();
                                break;
                            case "property" :
                                propF.show();
                                fieldF.hide();
                                labelF.hide();
                                break;
                            case "field":
                                propF.hide();
                                fieldF.show();
                                labelF.hide();
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
                id:"field_label",
                name:"fieldlabel",
                anchor:"100%",
                itemCls:"indent_field",
                fieldLabel:t('Label field'),
                hidden:true
            },            
            {
                id:"routeSelect",
                fieldLabel: t('select route'),
                name: "routeselect",
                allowBlank:false,
                queryDelay: 0,
                xtype: "combo",
                displayField:'name',
                valueField: "name",
                mode: 'local',
                store: pimcore.globalmanager.get("sitemap.routesStore"),
                editable: false,
                triggerAction: 'all',
                anchor:"100%",
                hidden:false,
                listeners:{
                    scope:this,
                    'select':function(combo,record,index){                        
                        for(var i=0;i<this.arrRouteFS.length;i++){
                            this.arrRouteFS[i].hide();                            
                        }
                        Ext.getCmp('routeFS_'+record.data.name).show();                        
                    }
                }
            },
            this.arrRouteFS
            ]
        });
        
        this.form.add(thisNode);
        return this.form;
    }

});