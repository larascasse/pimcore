

pimcore.registerNS("pimcore.plugin.textTemplates.insertDialog");
pimcore.plugin.textTemplates.insertDialog = Class.create({

    initialize: function (callback) {

        this.callback = callback;

        if(!this.callback) {
            this.callback = function () {};
        }

        this.searchPanel = new Ext.Panel({
            layout: "border",
            items: [this.getForm(), this.getSelectionPanel(), this.getResultPanel()]

        });

        this.window = new Ext.Window({
            width: 1100,
            height: 550,
            modal: true,
            layout: "fit",
            items: [this.searchPanel]
        });

        this.window.show();
    },


    commitData: function () {
        var data = this.getData();
        this.callback(data);
        this.window.close();
    },

    getData: function () {

        if(this.currentTexttemplate) {

            var string = "";
            string += "@{" + this.currentTexttemplate.name;
            var variableNames = Object.keys(this.variables);
            for(var i = 0; i < variableNames.length; i++) {
                var name = variableNames[i];
                var value = this.variables[name].getValue();
                if(value) {
                    string += " " + name + '="' + value + '"';
                }
            }

            var value = this.languageField.getValue();
            if(value) {
                string += ' language="' + value + '"';
            }

            string += "}@";
            return string;
        } else {
            return null;
        }
    },

    getForm: function () {

        var compositeConfig = {
            xtype: "compositefield",
            hideLabel: true,
            items: [{
                xtype: "textfield",
                name: "query",
                width: 500,
                hideLabel: true,
                enableKeyEvents: true,
                listeners: {
                    "keydown" : function (field, key) {
                        if (key.getKey() == key.ENTER) {
                            this.search();
                        }
                    }.bind(this)
                }
            }]
        };

        // add button
        compositeConfig.items.push({
            xtype: "button",
            iconCls: "pimcore_icon_search",
            text: t("search"),
            handler: this.search.bind(this)
        });

        if(!this.formPanel) {
            this.formPanel = new Ext.form.FormPanel({
                layout: "pimcoreform",
                region: "north",
                bodyStyle: "padding: 5px;",
                height: 35,
                items: [compositeConfig]
            });
        }

        return this.formPanel;
    },

    getSelectionPanel: function () {
        if(!this.selectionPanel) {
            this.selectionPanel = new Ext.form.FormPanel({
                layout: "pimcoreform",
                region: "east",
                bodyStyle: "padding: 10px;",
                title: t("selected_texttemplate"),
                width: 428,
                items: [],
                buttons: [{
                    text: t("insert"),
                    iconCls: "pimcore_icon_apply",
                    handler: function () {
                        this.commitData();
                    }.bind(this)
                }]
            });
        }

        return this.selectionPanel;
    },

    getResultPanel: function () {
        if (!this.resultPanel) {
            this.resultPanel = new Ext.Panel({
                region: "center",
                layout: "fit"
            });

            this.resultPanel.on("afterrender", this.initDefaultStore.bind(this));
        }

        return this.resultPanel;
    },

    refreshSelectionPanel: function() {
        this.selectionPanel.removeAll();
        this.selectionPanel.add({
                    xtype: "textfield",
                    fieldLabel: t("name"),
                    name: "name",
                    readOnly: true,
                    width: 300,
                    value: this.currentTexttemplate.name
                });

        delete this.variables;
        this.variables = {};
        for(var i = 0; i < this.currentTexttemplate.variables.length; i++) {
            var name = this.currentTexttemplate.variables[i];
            var textfield = new Ext.form.TextField({
                fieldLabel: ts(name),
                name: name,
                width: 300
            });
            this.selectionPanel.add(textfield);
            this.variables[name] = textfield;
        }

        var languages = [];

        for(var i = 0; i < pimcore.settings.websiteLanguages.length; i++) {
            languages.push([pimcore.settings.websiteLanguages[i], pimcore.available_languages[pimcore.settings.websiteLanguages[i]]]);
        }

        this.languageField = new Ext.form.ComboBox({
                            xtype: "combo",
                            fieldLabel: t("language"),
                            name: "language",
                            //readOnly: true,
                            width: 300,
                            typeAhead: true,
                            triggerAction: 'all',
                            lazyRender:true,
                            mode: 'local',
                            store: new Ext.data.ArrayStore({
                                //id: 0,
                                fields: [
                                    'value',
                                    'label'
                                ],
                                data: languages
                            }),
                            valueField: 'value',
                            displayField: 'label'
                        });
        this.languageField.setValue(languages[0][0]);

        this.selectionPanel.add(this.languageField);

        this.selectionPanel.doLayout();
    },


    initDefaultStore: function () {
        this.store = new Ext.data.JsonStore({
            autoDestroy: true,
            root: "data",
            url: '/plugin/Texttemplates/admin/grid-proxy',
            fields: ["name","text","category","description","modificationDate","variables"]
        });

        var columns = [
            {header: t("name"), width: 150, sortable: true, dataIndex: 'name'},
            {header: t("category"), width: 150, sortable: true, dataIndex: 'category'},
            {header: t("description"), width: 150, sortable: true, dataIndex: 'description'},
            {header: t("preview"), width: 250, sortable: true, dataIndex: 'text'}
        ];

        this.getGridPanel(columns);
    },

    getGridPanel: function (columns) {

        this.pagingtoolbar = new Ext.PagingToolbar({
            pageSize: 15,
            store: this.store,
            displayInfo: true,
            displayMsg: '{0} - {1} / {2}',
            emptyMsg: t("no_objects_found")
        });

        this.gridPanel = new Ext.grid.GridPanel({
            store: this.store,
            border: false,
            columns: columns,
            loadMask: true,
            columnLines: true,
            stripeRows: true,
            viewConfig: {
                forceFit: false
            },
            bbar: this.pagingtoolbar,
            listeners: {
                rowclick: function (grid, rowIndex, ev) {

                    var data = grid.getStore().getAt(rowIndex);

                    this.currentTexttemplate = data.data;
                    this.refreshSelectionPanel();

                }.bind(this)
            }
        });

        this.resultPanel.removeAll();
        this.resultPanel.add(this.gridPanel);
        this.resultPanel.doLayout();
    },

    getGrid: function () {
        return this.gridPanel;
    },

    search: function () {
        var formValues = this.formPanel.getForm().getFieldValues();

        this.store.baseparams = {};

        var query = [{field: "query", value: formValues.query}];
        this.store.setBaseParam("filter", Ext.util.JSON.encode(query));

        this.pagingtoolbar.moveFirst();
    }

});
