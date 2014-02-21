pimcore.registerNS("pimcore.plugin.lpnplugin");

pimcore.plugin.lpnplugin = Class.create(pimcore.plugin.admin, {
    getClassName: function() {
        return "pimcore.plugin.lpnplugin";
    },

    initialize: function() {
        pimcore.plugin.broker.registerPlugin(this);
        alert("kllkjkljkl");
    },
 
    pimcoreReady: function (params,broker){
        // add a sub-menu item under "Extras" in the main menu
        var toolbar = Ext.getCmp("pimcore_panel_toolbar");

        var action = new Ext.Action({
            id: "my_plugin_menu_item",
            text: "Lpn Plugin",
            iconCls:"fraud_check_menu_icon",
            handler: this.showTab
        });

        toolbar.items.items[1].menu.add(action);
    },

    showTab: function() {
        myPlugin.panel = new Ext.Panel({
            id:         "spark_fraud_check_panel",
            title:      "Lpn Plugin",
            iconCls:    "spark_fraud_check_panel_icon",
            border:     false,
            layout:     "fit",
            closable:   true,
            items:      [lpnplugin.getGrid()]
        });

        var tabPanel = Ext.getCmp("pimcore_panel_tabs");
        tabPanel.add(lpnplugin.panel);
        tabPanel.activate("my_plugin_check_panel");

        pimcore.layout.refresh();
    },
    getGrid: function() {
    // fetch data from a webservice (which we haven't written yet!)
    lpnplugin.store = new Ext.data.JsonStore({
        id:                 'my_plugin_store',
        url:                '/plugin/LpnPlugin/admin/getAddressBook',
        restful:            false,
        root:               "addresses",
        fields: [
            "name",
            "phoneNumber",
            "address"
        ]
    });

    lpnplugin.store.load();

    var typeColumns = [
            {header: "Name",         width: 100, sortable: true, dataIndex: 'name'},
            {header: "Phone Number", width: 100, sortable: true, dataIndex: 'phoneNumber'},
            {header: "Address",      width: 100, sortable: true, dataIndex: 'address'}
    ];

    lpnplugin.grid = new Ext.grid.GridPanel({
            frame:          false,
            autoScroll:     true,
            store:          myPlugin.store,
            columns:        typeColumns,
            trackMouseOver: true,
            columnLines:    true,
            stripeRows:     true,
            viewConfig:     { forceFit: true }
        });

   return lpnplugin.grid;
}
});

var myPlugin = new pimcore.plugin.lpnplugin();