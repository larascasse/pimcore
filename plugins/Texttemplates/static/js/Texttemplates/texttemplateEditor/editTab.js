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

pimcore.registerNS("pimcore.plugin.textTemplates.texttemplateEditors.editTab");
pimcore.plugin.textTemplates.texttemplateEditors.editTab = Class.create({ 

    initialize: function(data) {
        this.data = data;
        this.dataFields = {};
    },

    getLayout: function () {
 
        if (this.layout == null) {
            this.layout = new Ext.Panel({
                title: t('edit'),
                bodyStyle:'background-color: #fff;',
                padding: 10,
                border: false,
                layout: "fit",
                forceLayout: true,
                defaults: {
                    forceLayout: true
                },
                iconCls: "pimcore_icon_tab_edit",
                items: [ this.buildLayout() ],
                listeners: {
                    afterrender: function () {
                        pimcore.layout.refresh();
                    }
                }
            });
        }

        return this.layout;
    },

    buildLayout: function() {

        var languages = this.data.data.languages;

        var editableDivId = "object_tempateWysiwyg_" + uniqid();

        var panels = [];
        for(var i = 0; i < languages.length; i++) {
            var language = languages[i];
            var editorlayout = {width: 800, height: 200};

            var text = this.data.data[language];
            if(!text) {
                text = "";
            }

            var pConf = {
                width: editorlayout.width,
                html: '<div style="cursor:pointer;" id="' + editableDivId + '_' + languages[i] + '">' + text + '</div>',
                cls: "object_field"
            };
            var ckeditor = new Ext.Panel(pConf);

            ckeditor.on("afterrender", function (id, language) {
                try {
                    this.dataFields[language] = pimcore.plugin.texttemplate.helpers.initCkEditor(editorlayout, id);
                }catch(e) {
                    console.log(e);
                }
            }.bind(this, editableDivId + '_' + languages[i], language));


            var panel = new Ext.Panel({
                title: pimcore.available_languages[languages[i]],
                autoScroll: true,
                autoHeight: true,
                bodyStyle: "padding: 10px;",
                items: [ckeditor]
            });

            panels.push(panel);


        }

        this.category = new Ext.form.TextField({
                    xtype: "textfield",
                    fieldLabel: t("category"),
                    name: "category",
                    readOnly: false,
                    width: 250,
                    value: this.data.data.category
        });

        this.description = new Ext.form.TextField({
                    xtype: "textfield",
                    fieldLabel: t("description"),
                    name: "description",
                    readOnly: false,
                    width: 765,
                    value: this.data.data.description
        });

        this.rootPanel = new Ext.form.FormPanel({
            bodyStyle: "padding: 10px;",
            layout: "pimcoreform",
            autoScroll: true,
            labelWidth: 80,
            items: [
                {
                    xtype: "textfield",
                    fieldLabel: t("name"),
                    name: "name",
                    readOnly: true,
                    width: 250,
                    value: this.data.data.name
                },this.category,this.description,{
                    xtype: "tabpanel",
                    activeTab: 0,
                    width: 850,
                    items: panels
                }
            ]
        });

        this.rootPanel.doLayout();

        return this.rootPanel;
    },

    getTimeString: function(time) {
        if (time) {
            var timestamp = intval(time) * 1000;
            var date = new Date(timestamp);

            return date.format("Y-m-d H:i");
        }
    },

    getValues: function () {
        var data = {};

        var languages = this.data.data.languages;
        for(var i = 0; i < languages.length; i++) {
             data[languages[i]] = this.data.data[languages[i]]
        }

        var keys = Object.keys(this.dataFields);
        for(var i = 0; i < keys.length; i++) {
            data[keys[i]] = this.dataFields[keys[i]].getData();
        }

        data.description = this.description.getValue();
        data.category = this.category.getValue();

        return data;
    }

});