/**
 * Pimcore
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.pimcore.org/license
 *
 * @copyright  Copyright (c) 2009-2010 elements.at New Media Solutions GmbH (http://www.elements.at)
 * @license    http://www.pimcore.org/license     New BSD License
 */

pimcore.registerNS("pimcore.plugin.textTemplates.texttemplateList");
pimcore.plugin.textTemplates.texttemplateList = Class.create({

    initialize: function(object) {
        this.object = object;
        this.getLayout();

        var tabPanel = Ext.getCmp("pimcore_panel_tabs");
        tabPanel.add(this.layout);
        tabPanel.activate("plugin_texttemplates_texttemplateList");

        this.layout.on("destroy", function () {
            pimcore.globalmanager.remove("textTemplates.texttemplateList");
        }.bind(this));

    },

    activate: function () {
        Ext.getCmp("pimcore_panel_tabs").activate("plugin_textTemplates_texttemplateList");
    },

    getLayout: function () {

        if (this.layout == null) {

            this.addNewButtom = new Ext.Button({
                iconCls: "pimcore_icon_texttemplate_add",
                text: t("add_new_template"),
                enableToggle: true,
                handler: function (button) {
                    Ext.MessageBox.prompt(t('add_new_template'), t('please_enter_the_name_of_the_new_texttemplate'), this.createTexttemplate.bind(this));
                }.bind(this)
            });


            this.layout = new Ext.Panel({
                title: t('texttemplates_texttemplateList'),
                id: "plugin_texttemplates_texttemplateList",
                border: false,
                layout: "fit",
                iconCls: "pimcore_icon_texttemplate",
                items: [],
                closable:true,
                tbar: [this.addNewButtom]
            });

            this.layout.on("afterrender", this.getTableDescription.bind(this));
        }

        return this.layout;
    },

    getTableDescription: function () {
        var itemsPerPage = 20;
        var plugins = [];
        var gridColumns = [];

        // the store
        var readerFields = [];
        readerFields.push({name: "name", allowBlank: false});
        readerFields.push({name: "modificationDate", allowBlank: false});
        readerFields.push({name: "text", allowBlank: true});
        readerFields.push({name: "category", allowBlank: true});
        readerFields.push({name: "description", allowBlank: true});


        var proxy = new Ext.data.HttpProxy({
            url: '/plugin/Texttemplates/admin/grid-proxy'
        });

        var reader = new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            root: 'data'
        }, readerFields);
        var writer = new Ext.data.JsonWriter();

        this.store = new Ext.data.GroupingStore({
            restful: false,
            idProperty: 'name',
            remoteSort: true,
            proxy: proxy,
            reader: reader,
            writer: writer,
            groupField: "category",
            baseParams: {
                limit: itemsPerPage
            },
            listeners: {
                write : function(store, action, result, response, rs) {
                }
            }
        });
        this.store.load();
        
        gridColumns.push({
            xtype: 'actioncolumn',
            width: 30,
            items: [
                {
                    tooltip: t('open'),
                    icon: "/pimcore/static/img/icon/pencil_go.png",
                    handler: function (grid, rowIndex) {
                        var data = grid.getStore().getAt(rowIndex);
                        pimcore.plugin.texttemplate.helpers.openTexttemplate(data.data.name);
                    }.bind(this)
                }
            ]
        });
        gridColumns.push({
            xtype: 'actioncolumn',
            width: 30,
            items: [
                {
                    tooltip: t('remove'),
                    icon: "/pimcore/static/img/icon/cross.png",
                    handler: function (grid, rowIndex) {
                        var data = grid.getStore().getAt(rowIndex);
                        Ext.MessageBox.confirm(t('remove_textemplate'), t('remove_textemplate_text'), this.removeTexttemplate.bind(this, data.data.name), this);
                    }.bind(this)
                }
            ]
        });

        gridColumns.push({header: t("name"), width: 180, sortable: true, dataIndex: "name", editable: false});
        gridColumns.push({header: t("description"), width: 380, sortable: true, dataIndex: "description", editable: false});
        gridColumns.push({header: t("category"), width: 100, sortable: true, dataIndex: "category", editable: false});
        gridColumns.push({header: t("modificationDate"), width: 150, sortable: true, dataIndex: "modificationDate", editable: false});
        gridColumns.push({id: "text", header: t("preview"), sortable: false, dataIndex: "text", editable: false});

        // add filters
        var selectFilterFields;
        var configuredFilters = [{
            type: "string",
            dataIndex: "name"
        },{
            type: "string",
            dataIndex: "category"
        },{
            type: "string",
            dataIndex: "description"
        }];
        this.gridfilters = new Ext.ux.grid.GridFilters({
            encode: true,
            local: false,
            filters: configuredFilters
        });
        plugins.push(this.gridfilters);
        

        this.toolbarFilterInfo = new Ext.Toolbar.TextItem({
            text: ""
        });


        // grid        
        this.grid = new Ext.grid.EditorGridPanel({
            frame: false,
            store: this.store,
            columns : gridColumns,
            columnLines: true,
            stripeRows: true,
            plugins: plugins,
            border: true,
            loadMask: true,
            view: new Ext.grid.GroupingView({
                forceFit: true
            }),
//            viewConfig: {
//                forceFit: false
//            },
            autoExpandColumn: "text",
            tbar: [this.toolbarFilterInfo]
        });
//        this.grid.on("rowcontextmenu", this.onRowContextmenu);

        // check for filter updates
        this.grid.on("filterupdate", function () {
            var filterStringConfig = [];
            var filterData = this.gridfilters.getFilterData();
            var operator;

            // reset
            this.toolbarFilterInfo.setText(" ");

            if(filterData.length > 0) {
                for (var i=0; i<filterData.length; i++) {
                    operator = "LIKE";
                    filterStringConfig.push(filterData[i].field + " " + operator + " " + filterData[i].data.value);
                }
                this.toolbarFilterInfo.setText("<b>" + t("filter_condition") + ": " + filterStringConfig.join(" AND ") + "</b>");
            }
        }.bind(this))

        this.grid.on("rowcontextmenu", this.onRowContextmenu.bind(this));

        this.pagingtoolbar = new Ext.PagingToolbar({
            pageSize: itemsPerPage,
            store: this.store,
            displayInfo: true,
            displayMsg: '{0} - {1} / {2}',
            emptyMsg: t("no_objects_found")
        });

        // add per-page selection
        this.pagingtoolbar.add("-");

        this.pagingtoolbar.add(new Ext.Toolbar.TextItem({
            text: t("items_per_page")
        }));
        this.pagingtoolbar.add(new Ext.form.ComboBox({
            store: [
                [10, "10"],
                [20, "20"],
                [40, "40"],
                [60, "60"],
                [80, "80"],
                [100, "100"],
                [999999, t("all")]
            ],
            mode: "local",
            width: 50,
            value: 20,
            triggerAction: "all",
            listeners: {
                select: function (box, rec, index) {
                    this.pagingtoolbar.pageSize = intval(rec.data.field1);
                    this.pagingtoolbar.moveFirst();
                }.bind(this)
            }
        }));

        this.editor = new Ext.Panel({
            layout: "border",
            items: [new Ext.Panel({
                autoScroll: true,
                items: [this.grid],
                region: "center",
                layout: "fit",
                bbar: this.pagingtoolbar
            })]
        });

        this.layout.removeAll();
        this.layout.add(this.editor);
        this.layout.doLayout();

    },

    onRowContextmenu: function (grid, rowIndex, event) {

        $(grid.getView().getRow(rowIndex)).animate( { backgroundColor: '#E0EAEE' }, 100).animate( { backgroundColor: '#fff' }, 400);

        var menu = new Ext.menu.Menu();
        var data = grid.getStore().getAt(rowIndex);

        menu.add(new Ext.menu.Item({
            text: t('rename'),
            iconCls: "pimcore_icon_edit_key",
            handler: function (data) {
                Ext.MessageBox.prompt(t('rename_texttemplate'), t('please_enter_the_new_name_of_the_texttemplate'), this.renameTexttemplate.bind(this, data.data));
            }.bind(this, data)
        }));

        event.stopEvent();
        menu.showAt(event.getXY());
    },


    reload: function(){
        this.store.reload();
    },

    removeTexttemplate: function(name, answer) {
        if(answer == "yes") {
            Ext.Ajax.request({
                url: "/plugin/Texttemplates/admin/delete-texttemplate",
                method: "post",
                params: {name: name},
                success: function (response) {
                    try{
                        var rdata = Ext.decode(response.responseText);
                        if (rdata && rdata.success) {
                            pimcore.helpers.showNotification(t("success"), t("texttemplate_has_been_removed"), "success");
                            this.reload();
                        }
                        else {
                            pimcore.helpers.showNotification(t("error"), t("error_removed_texttemplate"), "error",t(rdata.message));
                        }
                    } catch(e){
                        pimcore.helpers.showNotification(t("error"), t("error_removed_texttemplate"), "error");
                    }
                }.bind(this)
            });
        }
    },

    createTexttemplate: function(answer, value) {
        if(answer == "ok") {
            var pattern = /^[\w\-\.\+]+$/;
            if(value.match(pattern)) {
                Ext.Ajax.request({
                    url: "/plugin/Texttemplates/admin/create-new-texttemplate",
                    method: "post",
                    params: {name: value},
                    success: function (response) {
                        try{
                            var rdata = Ext.decode(response.responseText);
                            if (rdata && rdata.success) {
                                this.reload();
                                pimcore.plugin.texttemplate.helpers.openTexttemplate(value);
                            }
                            else {
                                pimcore.helpers.showNotification(t("error"), t("error_create_texttemplate"), "error",t(rdata.message));
                            }
                        } catch(e){
                            pimcore.helpers.showNotification(t("error"), t("error_create_texttemplate"), "error");
                        }
                    }.bind(this)
                });
            } else {
                Ext.MessageBox.prompt(t('add_new_template'), t('please_check_name_of_the_new_texttemplate'), this.createTexttemplate.bind(this), this, false, value);
            }
        }
    },

    renameTexttemplate: function(data, answer, value) {
        if(answer == "ok") {
            Ext.Ajax.request({
                url: "/plugin/Texttemplates/admin/rename-texttemplate",
                method: "post",
                params: {name: value, old_name: data.name},
                success: function (response) {
                    try{
                        var rdata = Ext.decode(response.responseText);
                        if (rdata && rdata.success) {
                            pimcore.helpers.showNotification(t("success"), t("texttemplate_has_been_renamed"), "success");
                            this.reload();
                        }
                        else {
                            pimcore.helpers.showNotification(t("error"), t("error_rename_texttemplate"), "error",t(rdata.message));
                        }
                    } catch(e){
                        pimcore.helpers.showNotification(t("error"), t("error_rename_texttemplate"), "error");
                    }
                }.bind(this)
            });
        }
    }
});
