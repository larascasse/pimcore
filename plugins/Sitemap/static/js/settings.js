pimcore.registerNS("sitemap.settings");
sitemap.settings = Class.create({

    initialize: function () {

        this.getTabPanel();
        //this.getPredefinedProp();
        this.getRoutesStore();
    },

    getRoutesStore: function(){
      var proxy = new Ext.data.HttpProxy({
            url: '/admin/settings/staticroutes'
        });
        var reader = new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            root: 'data'
        }, [
            {name: 'id'},
            {name: 'name', allowBlank: true},
            {name: 'pattern', allowBlank: false},
            {name: 'reverse', allowBlank: true},
            {name: 'controller', allowBlank: true},
            {name: 'action', allowBlank: true},
            {name: 'variables', allowBlank: true},
            {name: 'defaults', allowBlank: true},
            {name: 'priority',type:'int',allowBlank: true}
        ]);

        var routesStore = new Ext.data.Store({
            id: 'staticroutes_store',
            restful: false,
            proxy: proxy,
            reader: reader
        });
        routesStore.on("load",function(store,rec,opt){
            pimcore.globalmanager.add("sitemap.routesStore",store);
        },this);
        routesStore.load();

    },

    getPredefinedProp: function(){

        var proxy = new Ext.data.HttpProxy({
            method: 'GET',
            url: '/plugin/Sitemap/admin/predefined' // see options parameter for Ext.Ajax.request
        });

        var predefinedProperiesDoc = new Ext.data.JsonStore({
            proxy: proxy,
            fields: ["id","name","key","type","data","config","inheritable"],
            root: "doc"
        });
        predefinedProperiesDoc.on("load",function(store,rec,opt){
            pimcore.globalmanager.add("sitemap.predefinedProp.doc",store);
        },this);
        predefinedProperiesDoc.load();

        var predefinedProperiesObj = new Ext.data.JsonStore({
            proxy: proxy,
            fields: ["id","name","key","type","data","config","inheritable"],
            root: "object"
        });
        predefinedProperiesObj.on("load",function(store,rec,opt){
            pimcore.globalmanager.add("sitemap.predefinedProp.object",store);
        },this);
        predefinedProperiesObj.load();
    },

    getTabPanel: function () {

        if (!this.panel) {
            this.panel = new Ext.Panel({
                id: "sitemap_settings",
                title: t("sitemap_settings"),
                border: false,
                iconCls:"sitemap_icon_root",
                layout: "border",
                closable:true,
                items: [this.getMenuTree(), this.getEditPanel()]
            });

            var tabPanel = Ext.getCmp("pimcore_panel_tabs");
            tabPanel.add(this.panel);
            tabPanel.activate("sitemap_settings");


            this.panel.on("destroy", function () {
                pimcore.globalmanager.remove("sitemap.predefinedProp.doc");
                pimcore.globalmanager.remove("sitemap.predefinedProp.object");
                pimcore.globalmanager.remove("sitemap.routesStore");
                pimcore.globalmanager.remove("sitemap");
                
            }.bind(this));

            pimcore.layout.refresh();
        }

        return this.panel;
    },

    getMenuTree: function () {
        if (!this.tree) {
            this.tree = new Ext.tree.TreePanel({
                id: "sitemap_panel_settings_tree",
                region: "west",
                useArrows:true,
                autoScroll:true,
                animate:true,
                containerScroll: true,
                border: true,
                width: 200,
                split: true,
                root: {
                    nodeType: 'async',
                    id: '0'
                },
                loader: new Ext.tree.TreeLoader({
                    dataUrl: '/plugin/Sitemap/menu/get-tree',
                    requestMethod: "GET",
                    baseAttrs: {
                        listeners: this.getTreeNodeListeners(),
                        reference: this,
                        allowDrop: false,
                        allowChildren: false,
                        isTarget: false,
                        iconCls: "sitemap_icon_root",
                        leaf: true
                    }
                }),
                rootVisible: false,
                tbar: {
                    items: [
                    {
                        text: t("add_menu"),
                        iconCls: "sitemap_icon_root_add",
                        handler: this.addMenu.bind(this)
                    }
                    ]
                }
            });

            this.tree.on("render", function () {
                this.getRootNode().expand();
            });
        }

        return this.tree;
    },

    getEditPanel: function () {
        if (!this.editPanel) {
            this.editPanel = new Ext.Panel({
                region: "center",
                layout: "fit"
            });
        }

        return this.editPanel;
    },

    getTreeNodeListeners: function () {
        var treeNodeListeners = {
            'click' : this.onTreeNodeClick,
            "contextmenu": this.onTreeNodeContextmenu
        };

        return treeNodeListeners;
    },

    onTreeNodeClick: function () {
        if (this.id > 0) {
            Ext.Ajax.request({
                url: "/plugin/Sitemap/menu/get",
                params: {
                    id: this.id
                },
                success: this.attributes.reference.addMenuPanel.bind(this.attributes.reference)
            });
        }
    },

    addMenuPanel: function (response) {

        var data = Ext.decode(response.responseText);

        if (this.menuPanel) {
            this.getEditPanel().removeAll();
            delete this.menuPanel;
        }

        this.menuPanel = new sitemap.comp.menu(data, this);
        pimcore.layout.refresh();
    },

    onTreeNodeContextmenu: function () {
        this.select();

        var menu = new Ext.menu.Menu();
        menu.add(new Ext.menu.Item({
            text: t('delete'),
            iconCls: "pimcore_icon_delete",
            handler: this.attributes.reference.deleteMenu.bind(this)
        }));

        menu.show(this.ui.getAnchor());
    },

    addMenu: function () {
        Ext.MessageBox.prompt(t('add_menu'), t('enter_the_name_of_the_new_menu'), this.addMenuComplete.bind(this), null, null, "");
    },

    addMenuComplete: function (button, value, object) {

        var regresult = value.match(/[a-zA-Z]+/);
        var forbiddennames = ["abstract","class","data","folder","list","permissions","resource","concrete","interface"];

        if (button == "ok" && value.length > 2 && regresult == value && !in_array(value, forbiddennames)) {
            Ext.Ajax.request({
                url: "/plugin/Sitemap/menu/add",
                params: {
                    name: value
                },
                success: function () {
                    this.tree.getRootNode().reload();

                    // update object type store
                    pimcore.globalmanager.get("object_types_store").reload();
                }.bind(this)
            });
        }
        else if (button == "cancel") {
            return;
        }
        else {
            Ext.Msg.alert(t('add_menu'), t('problem_creating_new_menu'));
        }
    },

    deleteMenu: function () {
        Ext.Ajax.request({
            url: "/plugin/Sitemap/menu/delete",
            params: {
                id: this.id
            }
        });

        this.attributes.reference.getEditPanel().removeAll();
        this.remove();

    // refresh the object tree
    //pimcore.globalmanager.get("layout_object_tree").tree.getRootNode().reload();

    // update object type store
    //pimcore.globalmanager.get("object_types_store").reload();
    },

    activate: function () {
        Ext.getCmp("pimcore_panel_tabs").activate("sitemap_settings");
    }

});