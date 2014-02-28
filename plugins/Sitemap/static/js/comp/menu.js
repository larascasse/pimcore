
pimcore.registerNS("sitemap.comp.menu");
sitemap.comp.menu = Class.create({

    initialize: function (data, parentPanel) {
        this.parentPanel = parentPanel;
        this.data = data;

        this.addLayout();
        this.initLayoutFields();
    },

    addLayout: function () {

        this.editpanel = new Ext.Panel({
            region: "center",
            bodyStyle: "padding: 20px;",
            autoScroll: true
        });

        this.tree = new Ext.tree.TreePanel({
            xtype: "treepanel",
            region: "center",
            enableDD: true,
            useArrows:true,
            autoScroll: true,
            root: {
                id: "0",
                root: true,
                text: t("base"),
                reference: this,
                iconCls:"sitemap_icon_root",
                leaf: true,
                isTarget: true,
                listeners: this.getTreeNodeListeners()
            }
        });

        this.panel = new Ext.Panel({
            border: false,
            layout: "border",
            title: this.data.name + " ( ID: " + this.data.id + ")",
            items: [
                {
                    region: "west",
                    title: t("Menu tree"),
                    layout: "border",
                    width: 200,
                    split: true,
                    items: [this.tree]
                },
                this.editpanel
            ],
            buttons: [
                {
                    text: t("preview"),
                    iconCls: "pimcore_icon_tab_preview",
                    handler: this.preview.bind(this)
                },
                {
                    text: t("save"),
                    iconCls: "pimcore_icon_save",
                    handler: this.save.bind(this)
                }
                
            ]
        });


        this.parentPanel.getEditPanel().add(this.panel);

        this.editpanel.add(this.getRootPanel());
        this.setCurrentNode("root");

        pimcore.layout.refresh();
    },


    initLayoutFields: function () {

        if (this.data.menuDefinitions) {
            if (this.data.menuDefinitions.childs) {
                if(this.data.menuDefinitions.childs.length != null){
                for (var i = 0; i < this.data.menuDefinitions.childs.length; i++) {
                    this.tree.getRootNode().appendChild(this.recursiveAddNode(this.data.menuDefinitions.childs[i], this.tree.getRootNode()));
                }
                }else{
                    this.tree.getRootNode().appendChild(this.recursiveAddNode(this.data.menuDefinitions.childs, this.tree.getRootNode()));
                }
                this.tree.getRootNode().expand();
            }
        }
    },

    recursiveAddNode: function (con, scope) {

        var fn = null;
        var newNode = null;
        
            fn = this.addMenuChild.bind(scope, con.fieldtype, con);
            newNode = fn();

            if (con.childs) {
                if(con.childs.length != null){
                for (var i = 0; i < con.childs.length; i++) {
                    this.recursiveAddNode(con.childs[i], newNode);
                }
                }else{
                    this.recursiveAddNode(con.childs, newNode);
                }
            }
        

        return newNode;
    },


    getTreeNodeListeners: function () {

        var listeners = {
            "click" : this.onTreeNodeClick,
            "contextmenu": this.onTreeNodeContextmenu
        };
        return listeners;
    },



    onTreeNodeClick: function () {

        this.attributes.reference.saveCurrentNode();
        this.attributes.reference.editpanel.removeAll();

        if (this.attributes.object) {

            if (this.attributes.object.datax.locked) {
                return;
            }

            this.attributes.reference.editpanel.add(this.attributes.object.getLayout());
            this.attributes.reference.setCurrentNode(this.attributes.object);
        }

        if (this.attributes.root) {
            this.attributes.reference.editpanel.add(this.attributes.reference.getRootPanel());
            this.attributes.reference.setCurrentNode("root");
        }

        this.attributes.reference.editpanel.doLayout();
    },

    onTreeNodeContextmenu: function () {
        this.select();

        var menu = new Ext.menu.Menu();
        var childsAllowed = true;

        
        if(childsAllowed) {

            var parentType = "root";
            
            if (this.attributes.object) {
                parentType = this.attributes.object.type;
            }
            
            // specify which childs a layout can have
            // the child-type "data" is a placehoder for all data components 
            var allowedTypes = {                
                root: ["document","docfolder","object","objectfolder"],
                document: ["document","docfolder","object","objectfolder"],
                docfolder: ["document","docfolder","object","objectfolder"],
                object:["document","docfolder","object","objectfolder","objectfield"],
                objectfolder:["document","docfolder","object","objectfolder"],
                routemap:["objectfield"],
                objectfield:["document","docfolder","object","objectfolder"]
            };

            
            var layoutMenu = [];
            var layouts = Object.keys(sitemap.comp.type);

            for (var i = 0; i < layouts.length; i++) {
                if (layouts[i] != "layout") {
                    if (in_array(layouts[i], allowedTypes[parentType])) {
                        layoutMenu.push({
                            text: sitemap.comp.type[layouts[i]].prototype.getTypeName(),
                            iconCls: sitemap.comp.type[layouts[i]].prototype.getIconClass(),
                            handler: this.attributes.reference.addMenuChild.bind(this, layouts[i])
                        });
                    }

                }
            }

            if (this.id != 0 && (this.attributes.object.type == "object" || this.attributes.object.type == "objectfolder" || this.attributes.object.type == "objectfield")){
                menu.add(new Ext.menu.Item({
                text: t('Add route mapping'),
                iconCls: "sitemap_icon_routemap_add",
                handler: this.attributes.reference.addMenuChild.bind(this, "routemap")
            }));
            }

            if (this.id != 0 && (this.attributes.object.type == "document" || this.attributes.object.type == "docfolder")){
                menu.add(new Ext.menu.Item({
                text: t('Add doctype rule'),
                iconCls: "sitemap_icon_doctype_add",
                handler: this.attributes.reference.addMenuChild.bind(this, "doctype")
            }));
            }
            

            if (layoutMenu.length > 0) {
                menu.add(new Ext.menu.Item({
                    text: t('Add menu item'),
                    iconCls: "sitemap_icon_item_add",
                    hideOnClick: false,
                    menu: layoutMenu
                }));
            }
            
        }

        var deleteAllowed = true;

        if (this.attributes.object) {
            if (this.attributes.object.datax.locked) {
                deleteAllowed = false;
            }
        }

        if (this.id != 0 && deleteAllowed) {
            menu.add(new Ext.menu.Item({
                text: t('delete'),
                iconCls: "pimcore_icon_delete",
                handler: this.attributes.reference.removeChild.bind(this)
            }));
        }

        menu.show(this.ui.getAnchor());
    },

    setCurrentNode: function (cn) {
        this.currentNode = cn;
    },

    saveCurrentNode: function () {
        if (this.currentNode) {
            if (this.currentNode != "root") {
                this.currentNode.applyData();
            }
            else {
                // save root node data
                var items = this.rootPanel.findBy(function() {
                    return true;
                });

                for (var i = 0; i < items.length; i++) {
                    if (typeof items[i].getValue == "function") {
                        this.data[items[i].name] = items[i].getValue();
                    }
                }
            }
        }
    },

    getRootPanel: function () {

        this.rootPanel = new Ext.form.FormPanel({
            title: t("Menu configuration"),
            bodyStyle: "padding: 10px;",
            layout: "pimcoreform",
            items: [
                {
                    xtype: "textfield",
                    fieldLabel: t("name"),
                    name: "name",
                    width: 300,
                    value: this.data.name
                },
                {
                xtype: "numberfield",
                fieldLabel: t("max death"),
                allowDecimals:false,
                name: "max_death",
                value: this.data.max_death,
                anchor: "100%"
            }
            ]
        });

        return this.rootPanel;
    },

    addMenuChild: function (type, initData) {

        var nodeLabel = t(type);
        var rule = "";
        if (initData) {
            if (initData.name) {
                nodeLabel = initData.name;
            }
            if(initData.isRule == "1"){
                rule = "_r";
            }
        }



        var newNode = new Ext.tree.TreeNode({
            type: "layout",
            reference: this.attributes.reference,
            draggable: true,
            iconCls: "sitemap_icon_" + type + rule,
            text: nodeLabel,
            listeners: this.attributes.reference.getTreeNodeListeners()
        });
        newNode.attributes.object = new sitemap.comp.type[type](newNode, initData,this);

        this.appendChild(newNode);

        this.renderIndent();
        this.expand();

        return newNode;
    },

    removeChild: function () {
        if (this.id != 0) {
            if (this.attributes.reference.currentNode == this.attributes.object) {
                this.currentNode = null;
                var f = this.attributes.reference.onTreeNodeClick.bind(this.attributes.reference.tree.getRootNode());
                f();
            }
            this.remove();
        }
    },

    getNodeData: function (node) {

        var data = {};

        if (node.attributes.object) {
            if (typeof node.attributes.object.getData == "function") {
                data = node.attributes.object.getData();
                var valid = node.attributes.object.isValid();
                
                var regresult = data.name.match(/[a-zA-Z0-9_]+/);

                if (data.name.length > 2 && regresult == data.name && valid == true) {
                    node.getUI().removeClass("tree_node_error");
                }
                else {
                    node.getUI().addClass("tree_node_error");
                    pimcore.helpers.showNotification(t("error"), t("some_fields_cannot_be_saved"), "error");

                    this.getDataSuccess = false;
                    return false;
                }
            }
        }

        
        if (node.childNodes.length > 0) {
            data.childs = [];
            for (var i = 0; i < node.childNodes.length; i++) {
                data.childs.push(this.getNodeData(node.childNodes[i]));
            }
        }

        return data;
    },

    getData: function () {

        this.getDataSuccess = true;

        var rootNode = this.tree.getRootNode();
        var nodeData = this.getNodeData(rootNode);

        return nodeData;
    },

    save: function () {

        this.saveCurrentNode();

        var m = Ext.encode(this.getData());
        var n = Ext.encode(this.data);

        if (this.getDataSuccess) {
            Ext.Ajax.request({
                url: "/plugin/Sitemap/menu/save",
                method: "post",
                params: {
                    configuration: m,
                    values: n,
                    id: this.data.id
                },
                success: this.saveOnComplete.bind(this)
            });
        }
    },
    preview: function () {

        this.saveCurrentNode();

        var m = Ext.encode(this.getData());
        var n = Ext.encode(this.data);

        if (this.getDataSuccess) {
            Ext.Ajax.request({
                url: "/plugin/Sitemap/menu/preview",
                method: "post",
                params: {
                    configuration: m,
                    values: n
                },
                success: this.previewOnComplete.bind(this)
            });
        }
    },

    previewOnComplete: function (response) {

        var data = Ext.decode(response.responseText);

        this.win = new Ext.Window({
        title:t('preview'),
        layout:"fit",
        width:600,
        height:400,
        closeAction:'destroy',
        plain:true,
        modal:true,
        autoScroll:true,
        html:data.data

        
    });
            this.win.show(this);

    },

    saveOnComplete: function () {
        this.parentPanel.tree.getRootNode().reload();
        pimcore.globalmanager.get("object_types_store").reload();


        pimcore.helpers.showNotification(t("success"), t("navigation_saved_successfully"), "success");
    }
});