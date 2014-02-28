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

pimcore.registerNS("pimcore.plugin.textTemplates.texttemplateEditors.dependenciesTab");
pimcore.plugin.textTemplates.texttemplateEditors.dependenciesTab = Class.create({

    initialize: function(elementName, type) {
        this.elementName = elementName;
        this.requiredByLoaded = false;
    },

    getLayout: function() {
        
        this.requiredByPanel = new Ext.Panel({
            flex: 1,
            layout: "fit"
        });
        
        if (this.layout == null) {
            this.layout = new Ext.Panel({
                title: t('dependencies'),
                border: false,
                iconCls: "pimcore_icon_tab_dependencies",
                autoScroll: true,
                bodyStyle: "padding: 10px",
                listeners:{
                    activate: this.getData.bind(this)
                }
            });
        }
        return this.layout;
    },

    waitForLoaded: function() {
        if (this.requiredByLoaded) {
            this.completeLoad();
        } else {
            window.setTimeout(this.completeLoad.bind(this), 1000);
        }
    },

    completeLoad: function() {
        this.layout.add(this.requiredByNote);
        this.layout.add(this.requiredByGrid);
        
        this.layout.doLayout();
    },


    getData: function() {
        
        // only load it once
        if(this.requiredByLoaded) {
            return;
        }
        

        Ext.Ajax.request({
            url: '/plugin/Texttemplates/admin/get-dependencies/',
            method: "get",
            params: {
                name: this.elementName
            },
            success: this.getRequiredByLayout.bind(this)
        });


        this.waitForLoaded();
    },
        
    getRequiredByLayout: function(response) {
        if (response != null) {
            this.requiredByData = Ext.decode(response.responseText);
        }
                
        this.requiredByStore = new Ext.data.JsonStore({
            autoDestroy: true,
            data: this.requiredByData,
            root: 'dependencies',
            fields: ['id', 'path', 'type', 'subtype']
        });
        
                        
                                
        this.requiredByGrid = new Ext.grid.GridPanel({
            store: this.requiredByStore,
            columns: [
                {header: "ID", sortable: true, dataIndex: 'id'},
                {header: t("path"), id: "path", sortable: true, dataIndex: 'path'},
                {header: t("type"), sortable: true, dataIndex: 'type'},
                {header: t("subtype"), sortable: true, dataIndex: 'subtype'}
            ],
            autoExpandColumn: "path",
            columnLines: true,
            stripeRows: true,
            autoHeight: true,
            title: t('required_by')
        });
        this.requiredByGrid.on("rowclick", this.click.bind(this));
        
        
        
        this.requiredByNote = new Ext.Panel({
            html:t('hidden_dependencies'),
            cls:'dependency-warning',
            border:false,
            hidden: !this.requiredByData.hasHidden                        
        });
        
    
        this.requiredByLoaded = true;        
    },

    click: function ( grid, index) {
        
        var d = grid.getStore().getAt(index).data;

        if (d.type == "object") {
            pimcore.helpers.openObject(d.id, d.subtype);
        }
        else if (d.type == "asset") {
            pimcore.helpers.openAsset(d.id, d.subtype);
        }
        else if (d.type == "document") {
            pimcore.helpers.openDocument(d.id, d.subtype);
        }
    }

});