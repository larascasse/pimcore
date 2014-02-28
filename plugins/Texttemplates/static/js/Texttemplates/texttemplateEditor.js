
pimcore.registerNS("pimcore.plugin.textTemplates.texttemplateEditor");
pimcore.plugin.textTemplates.texttemplateEditor = Class.create(pimcore.object.abstract, {

    texttemplateName: null,
    tabId: null,
    toolbar : null,
    toolbarButtons: null,

    initialize: function(name) {
        this.texttemplateName = name;

        this.tabId = "texttemplates.texttemplate_" + this.texttemplateName;

        this.getData();
    },

    getData: function () {
        Ext.Ajax.request({
            url: "/plugin/Texttemplates/admin/get-texttemplate",
            params: {name: this.texttemplateName},
            success: this.getDataComplete.bind(this)
        });
    },

    getDataComplete: function (response) {

        try {
            this.data = Ext.decode(response.responseText);

            if(this.data.success) {

                this.general = new pimcore.plugin.textTemplates.texttemplateEditors.editTab(this.data);
                this.dependencies = new pimcore.plugin.textTemplates.texttemplateEditors.dependenciesTab(this.texttemplateName);

                this.addTab();
                this.startChangeDetector();
            } else {
                pimcore.plugin.texttemplate.helpers.closeTexttemplate(this.texttemplateName);
            }

        }
        catch (e) { 
            console.log(e);
            pimcore.plugin.texttemplate.helpers.closeTexttemplate(this.texttemplateName);
        }
    },

    addTab: function () {
        var title = t("texttemplate") + " " + this.texttemplateName;
        if(this.data.title) {
            title = this.data.title;
        }

        this.tabPanel = Ext.getCmp("pimcore_panel_tabs");
        var tabId = this.tabId;

        this.tab = new Ext.Panel({
            id: tabId,
            title: title,
            closable:true,
            layout: "border",
            items: [this.getLayoutToolbar(),this.getTabPanel()],
            object: this,
            iconCls: "pimcore_icon_texttemplate"
        });

        this.tab.on("activate", function () {
            this.tab.doLayout();
            pimcore.layout.refresh();
        }.bind(this));

        // remove this instance when the panel is closed
        this.tab.on("destroy", function () {
            pimcore.globalmanager.remove(this.tabId);
        }.bind(this));

        this.tab.on("afterrender", function (tabId) {
            this.tabPanel.activate(tabId);
        }.bind(this, tabId));

        this.tabPanel.add(this.tab);

        // recalculate the layout
        pimcore.layout.refresh();
    },

    getTabPanel: function () {
        var items = [];
        items.push(this.general.getLayout());
        items.push(this.dependencies.getLayout());

        var tabbar = new Ext.TabPanel({
            tabPosition: "top",
            region:'center',
            deferredRender:false,
            enableTabScroll:true,
            border: false,
            items: items,
            activeTab: 0
        });

        return tabbar;
    },

    getLayoutToolbar : function () {
        if (!this.toolbar) {

            var buttons = [];

            this.toolbarButtons = {};

            this.toolbarButtons.save = new Ext.SplitButton({
                text: t('save'),
                iconCls: "pimcore_icon_save_medium",
                scale: "medium",
                handler: this.save.bind(this),
                menu:[{
                        text: t('save_close'),
                        iconCls: "pimcore_icon_save",
                        handler: this.saveClose.bind(this)
                    }]
            });


            this.toolbarButtons.remove = new Ext.Button({
                text: t("delete"),
                iconCls: "pimcore_icon_delete_medium",
                scale: "medium",
                handler: this.remove.bind(this)
            });

            buttons.push(this.toolbarButtons.save);
            buttons.push(this.toolbarButtons.remove);


            this.toolbarButtons.reload = new Ext.Button({
                text: t('reload'),
                iconCls: "pimcore_icon_reload_medium",
                scale: "medium",
                handler: this.reload.bind(this)
            });
            buttons.push(this.toolbarButtons.reload);


            buttons.push("-");
            buttons.push({
                text: this.texttemplateName,
                xtype: 'tbtext'
            });


            this.toolbar = new Ext.Toolbar({
                region: "north",
                border: false,
                cls: "document_toolbar",
                items: buttons
            });
        }

        return this.toolbar;
    },

    activate: function () {
        this.tabPanel.activate(this.tabId);
    },

    getSaveData : function (only) {
        var data = {};

        data.name = this.texttemplateName;

        // data
        try {
            data.data = Ext.encode(this.general.getValues());
        }
        catch (e) {
            console.log(e)
        }

        return data;
    },

    saveClose: function(only){
        this.save();
        var tabPanel = Ext.getCmp("pimcore_panel_tabs");
        tabPanel.remove(this.tab);
    },

    save : function (task, only) {

        var saveData = this.getSaveData(only);

        if (saveData.data != "false" && saveData.groupData != "false") {
            Ext.Ajax.request({
                url: "/plugin/Texttemplates/admin/save-texttemplate",
                method: "post",
                params: saveData,
                success: function (response) {
                    try{
                        var rdata = Ext.decode(response.responseText);
                        if (rdata && rdata.success) {
                            pimcore.helpers.showNotification(t("success"), t("texttemplate_has_been_saved"), "success");
                        }
                        else {
                            pimcore.helpers.showNotification(t("error"), t("error_saving_texttemplate"), "error",t(rdata.message));
                        }
                    } catch(e){
                        pimcore.helpers.showNotification(t("error"), t("error_saving_texttemplate"), "error");
                    }
                }.bind(this)
            });

            this.resetChanges();
            return true;
        }
        return false;
    },


    remove: function () {
        Ext.Ajax.request({
            url: "/plugin/Texttemplates/admin/delete-texttemplate",
            method: "post",
            params: {name: this.texttemplateName},
            success: function (response) {
                try{
                    var rdata = Ext.decode(response.responseText);
                    if (rdata && rdata.success) {
                        var tabPanel = Ext.getCmp("pimcore_panel_tabs");
                        tabPanel.remove(this.tab);
                        pimcore.helpers.showNotification(t("success"), t("texttemplate_has_been_removed"), "success");

                        var list = pimcore.globalmanager.get("textTemplates.texttemplateList");
                        if(list) {
                            list.reload();
                        }
                    }
                    else {
                        pimcore.helpers.showNotification(t("error"), t("error_remove_texttemplate"), "error",t(rdata.message));
                    }
                } catch(e){
                    pimcore.helpers.showNotification(t("error"), t("error_remove_texttemplate"), "error");
                }
            }.bind(this)
        });

    },

    isAllowed: function (key) {
        return true;
    },

    reload: function () {
        window.setTimeout(function (texttemplateName) {
            pimcore.plugin.texttemplate.helpers.openTexttemplate(texttemplateName);
        }.bind(window, this.texttemplateName), 500);

        var tabPanel = Ext.getCmp("pimcore_panel_tabs");
        tabPanel.remove(this.tab);
    },

    checkForChanges: function () {
        if(!this.changeDetectorInitData) {
            this.setupChangeDetector();
        }

        this.ignoreMandatoryFields = true;
        var liveData = this.getSaveData();
        this.ignoreMandatoryFields = false;

        var keys = Object.keys(liveData);

        for (var i=0; i<keys.length; i++) {
            if(this.changeDetectorInitData[keys[i]]) {
                if(this.changeDetectorInitData[keys[i]] != liveData[keys[i]]) {
                    this.detectedChange();
                }
            }
            this.changeDetectorInitData[keys[i]] = liveData[keys[i]];
        }
    }
});