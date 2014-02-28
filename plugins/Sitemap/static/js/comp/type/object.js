pimcore.registerNS("sitemap.comp.type.object");
sitemap.comp.type.object = Class.create(sitemap.comp.type.base,{

    type: "object",


    getTypeName: function () {
        return t("object");
    },

    getIconClass: function () {
        return "sitemap_icon_object";
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
        var labelF = Ext.getCmp("field_label");
        var propF = Ext.getCmp("property_label");
        var onlyChilds = Ext.getCmp("onlyChilds");
        var linkSelect = Ext.getCmp('linkSelect');
        var customLink = Ext.getCmp('custom_link');
        var allowChilds = Ext.getCmp('allowChilds');
        var childsFS = Ext.getCmp('childsFS');
        var routeSelect = Ext.getCmp('routeSelect');
        var ch_cssDef = Ext.getCmp("ch_css_define");
        var ch_cssProp= Ext.getCmp("ch_css_property");
        var ch_cssType = Ext.getCmp("ch_cssType");
        var cssDef = Ext.getCmp("css_define");
        var cssProp= Ext.getCmp("css_property");
        var cssType = Ext.getCmp("cssType");

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

        if(linkSelect.getValue()=='custom'){
            customLink.show();
        }else{
            customLink.hide();
        }

        switch (linkSelect.getValue()){
            case "custom":
                customLink.show();
                routeSelect.hide();
                for(var i=0;i<this.arrRouteFS.length;i++){
                    this.arrRouteFS[i].hide();
                }
                break;
            case "route":
                customLink.hide();
                routeSelect.show();
                for(var i=0;i<this.arrRouteFS.length;i++){
                    this.arrRouteFS[i].hide();
                }
                var routeName = routeSelect.getValue();
                Ext.getCmp('routeFS_'+ routeName).show();
                break;
            default :
                routeSelect.hide();
                customLink.hide();
                for(var i=0;i<this.arrRouteFS.length;i++){
                    this.arrRouteFS[i].hide();
                }
                break;
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
                itemCls:"indent_field_2",
                //layout:"form",
                msgTarget: 'under',
                fieldLabel: arrVar[i],
                anchor:"100%",
                items:[
                {
                    name: "variable",                    
                    xtype:'textfield',
                    flex:1
                },{
                    xtype:"displayfield",
                    value:t('is field key'),
                    width:100
                },{
                    name:"const",
                    xtype:"checkbox",
                    checked:true,
                    width:30
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
                fieldLabel: t("Ignore folder"),
                hidden:true
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
            }
            ,
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
        
        
        this.arrRouteFS = this.getRouteForm("");


        var labelStore = new Ext.data.ArrayStore({
            fields: ['id', 'label'],
            data : [['field','Object field'],['property','Custom property'],['label','Define label'],['key','Object key']]
        });

        var linkStore = new Ext.data.ArrayStore({
            fields: ['id', 'link'],
            data : [['route','Static route'],['nolink','No link'],['child','First child'],['custom','Custom link']]
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
                fieldLabel: t('object'),
                name: 'object',
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
                                if (data.node.attributes.type == "object") {
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
                        var label = Ext.getCmp("label");
                        var labelF = Ext.getCmp("field_label");
                        var propF = Ext.getCmp("property_label");
                        var linkSelect = Ext.getCmp('linkSelect');
                        var customLink = Ext.getCmp('custom_link');
                        var allowChilds = Ext.getCmp('allowChilds');
                        var routeSel = Ext.getCmp('routeSelect');
                        if(check == true){
                            select.disable();
                            routeSel.disable();
                            label.disable();
                            labelF.disable();
                            propF.disable();
                            linkSelect.disable();
                            customLink.disable();
                            allowChilds.setValue(true);
                            allowChilds.hide();
                            for(var i=0;i<this.arrRouteFS.length;i++){
                                    this.arrRouteFS[i].hide();
                                }
                        }else{
                            select.enable();
                            routeSel.enable();
                            label.enable();
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
                        var routeF = Ext.getCmp("routeSelect");
                        switch (record.data.id){
                            case "custom":
                                linkF.show();
                                routeF.hide();
                                for(var i=0;i<this.arrRouteFS.length;i++){
                                    this.arrRouteFS[i].hide();
                                }
                                break;
                            case "route":
                                routeF.show();
                                linkF.hide();
                                break;
                            default :
                                linkF.hide();
                                routeF.hide();
                                for(var i=0;i<this.arrRouteFS.length;i++){
                                    this.arrRouteFS[i].hide();
                                }
                                break;
                        }
                    }
                }
            },
            {
                id:"routeSelect",
                fieldLabel: t('select route'),
                itemCls:"indent_field",
                name: "routeselect",
                queryDelay: 0,
                xtype: "combo",
                displayField:'name',
                valueField: "name",
                mode: 'local',
                store: pimcore.globalmanager.get("sitemap.routesStore"),
                editable: false,
                triggerAction: 'all',
                anchor:"100%",
                hidden:true,
                listeners:{
                    scope:this,
                    'select':function(combo,record,index){
                        var linkF = Ext.getCmp("custom_link");
                        for(var i=0;i<this.arrRouteFS.length;i++){
                            this.arrRouteFS[i].hide();                            
                        }
                        Ext.getCmp('routeFS_'+record.data.name).show();                        
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
            },this.arrRouteFS
            ]
        });
        
        this.form.add(thisNode);
        this.form.add(this.getChildFs());
        this.form.add(this.getSitemapFs());
        return this.form;
    }

});