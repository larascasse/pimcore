pimcore.registerNS("pimcore.plugin.sitemap");

pimcore.plugin.sitemap = Class.create(pimcore.plugin.admin, {


    getClassName: function () {
        return "pimcore.plugin.sitemap";
    },

    initialize: function() {
        pimcore.plugin.broker.registerPlugin(this);
    },


    uninstall: function() {
    
    },

    pimcoreReady: function (params,broker){


        var user = pimcore.globalmanager.get("user");
        if(user.admin == true){

            var toolbar = Ext.getCmp("pimcore_panel_toolbar");

            var action = new Ext.Action({
                id:"sitemap_setting_button",
                text: t('Menu settings'),
                iconCls:"sitemap_icon_root",
                handler: function(){
                    var gestion = new sitemap.settings;
                }
            });

            toolbar.items.items[1].menu.add(action);
        }
    }



});

new pimcore.plugin.sitemap();
