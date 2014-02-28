pimcore.registerNS("sitemap.comp.type.base");
sitemap.comp.type.base = Class.create({

    type: "base",
    rulable: false,

    initialize: function (treeNode, initData, parent) {

        var rulable = {
                root: [],
                document: ["document","docfolder"],
                docfolder: ["document","docfolder"],
                object:["object","objectfolder"],
                objectfolder:["object","objectfolder"],
                routemap:[]
            };


        if(parent.attributes.object){
            var parentType = parent.attributes.object.type;
            if(in_array(this.type,rulable[parentType])){
                this.rulable = true;
            }
        }

        this.treeNode = treeNode;        
        this.initData(initData);
    },

    getTypeName: function () {
        return t("base");
    },

    getIconClass: function () {
        return "sitemap_icon_base";
    },

    initData: function (d) {
        this.valid = true;

        this.datax = {
            name: t("layout"),
            fieldtype: this.getType()
        };

        if(d){
            try{
                this.datax = d                
            }
            catch(e){
                    
            }
        }
    },

    getType: function () {
        return this.type;
    },

    getLayout: function () {



        this.layout = new Ext.Panel({
            title: t("Node type ") + this.getTypeName(),
            closable:false,
            items: [this.getForm()]

        });


        this.layout.on("render", this.layoutRendered.bind(this));

        return this.layout;
    },

    onAfterPopulate: function(){
        return true;
    },

    layoutRendered: function () {
        var form = this.form.getForm();
//This is for the SuperField bug
        form.items.each(function(item,index,length){
            var name = item.getName();
            if(!(item instanceof Ext.ux.form.SuperField) && !(item instanceof Ext.form.DisplayField)){

            if(item.ownerCt.layout != "hbox"){
            item.setValue(this.datax[name]);
            }
            }
        },this
        );

        if(this.rulable == true){
            var isRuleF = Ext.getCmp("isRule");
            isRuleF.show();
        }
        this.onAfterPopulate();

        for (var i = 0; i < form.items.items.length; i++) {
            if (form.items.items[i].name == "name") {
                form.items.items[i].on("keyup", this.updateName.bind(this));
                break;
            }
        }


    },

    updateName: function () {

        var form = this.form.getForm();        
        
        
        for (var i = 0; i < form.items.items.length; i++) {
            if (form.items.items[i].name == "name") {
                this.treeNode.setText(form.items.items[i].getValue());
                break;
            }
        }
        
        
           
    },

    getData: function () {
        return this.datax;
    },

    isValid: function(){
        return this.valid;
    },

    applyData: function () {

            this.valid = this.form.getForm().isValid();
        

        if(this.valid == true){
            this.treeNode.getUI().removeClass("tree_node_error");
        }else{
            this.treeNode.getUI().addClass("tree_node_error");
        }

        var data = {};
        
        this.form.getForm().items.each(function(item,index,length){
            var name = item.getName();
            if(!(item instanceof Ext.ux.form.SuperField) && !(item instanceof Ext.form.DisplayField)){

            if(item.ownerCt.layout != "hbox"){
            data[name]=item.getValue();
            }
            }
        },this
        );

        //var data = this.form.getForm().getFieldValues();
        data.fieldtype = this.getType();
        
        this.datax = data;
            

        this.datax.fieldtype = this.getType();        
    },

    getForm: function(){
        this.form = new Ext.FormPanel({
            bodyStyle:'padding:5px 5px 0',
            labelWidth: 150,
            defaultType: 'textfield',
            items: [ {
                xtype:'fieldset',
                title: t('base settings'),
                collapsible: true,
                autoHeight:true,                
                defaultType: 'textfield',
                items:[{
                    xtype: "textfield",
                    fieldLabel: t("name"),
                    name: "name",
                    allowBlank:false,
                    anchor: "100%",
                    enableKeyEvents: true
                },{
                    id:"isRule",
                    xtype:"checkbox",
                    name:"isRule",
                    checked:false,
                    fieldLabel:t("Is a rule"),
                    hidden:true,
                    listeners:{
                        scope:this,
                        'check': function(ckeck,value){
                            if(value == true){
                                this.treeNode.setIconCls(this.getIconClass() + "_r");
                            }else{
                                this.treeNode.setIconCls(this.getIconClass());
                            }
                        }
                }
                }]

            }]
        });
        return this.form;
    },

    getSitemapFs: function() {


        var freqStore = new Ext.data.ArrayStore({
            fields: ['id', 'label'],
            data : [['always','Always'],['hourly','Hourly'],['daily','Daily'],['weekly','Weekly'],['monthly','Monthly'],['yearly','Yearly'],['never','Never']]
        });


        var sitemapFs = new Ext.form.FieldSet({
            id:'sitemapFS',
            title: t("Sitemap settings"),
            collapsible: true,
            defaultType: 'textfield',
            items :[
            {
                id:'sm_def_freq',
                fieldLabel: t('Default changing frequency'),
                name: "sm_def_freq",
                queryDelay: 0,
                xtype: "combo",
                displayField:'label',
                valueField: "id",
                mode: 'local',
                store: freqStore,
                editable: false,
                triggerAction: 'all',
                anchor:"100%",
                value:"daily"
            },
            {
                id:"sm_def_priority",
                xtype: "numberfield",
                allowDecimals:true,
                minValue:0,
                maxValue:1,
                decimalSeparator:".",
                decimalPrecision:1,
                name:"sm_def_priority",
                anchor:"100%",
                fieldLabel:t('Default priority')
            },
            {
                id:"sm_prop_freq",
                name:"sm_prop_freq",
                anchor:"100%",
                fieldLabel:t('Changing frequency Property')
            },
            {
                id:"sm_prop_priority",
                name:"sm_prop_priority",
                anchor:"100%",
                fieldLabel:t('Priority Property')
            }
            ]
        });

        return sitemapFs;
    }

});