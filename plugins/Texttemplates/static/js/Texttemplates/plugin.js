pimcore.registerNS("pimcore.plugin.textTemplates");

pimcore.plugin.textTemplates = Class.create(pimcore.plugin.admin,{
    getClassName: function (){
        return "pimcore.plugin.textTemplates";
    },

    initialize: function(){
		pimcore.plugin.broker.registerPlugin(this);
	},

    uninstall: function(){
        //TODO remove from menu
    },

    pimcoreReady: function (params,broker) {
//        if(pimcore.globalmanager.get("user").isAllowed("plugin_customerdb")) {
            var extrasMenu = pimcore.globalmanager.get("layout_toolbar").extrasMenu;

            extrasMenu.insert(0, {
                text: t("texttemplates"),
                iconCls: "pimcore_icon_texttemplate",
                cls: "pimcore_main_menu",
                handler: function () {
                    try {
                        pimcore.globalmanager.get("textTemplates.texttemplateList").activate();
                    }
                    catch (e) {
                        pimcore.globalmanager.add("textTemplates.texttemplateList", new pimcore.plugin.textTemplates.texttemplateList());
                    }
                }
            });

            extrasMenu.doLayout();
//        }

    }
});

new pimcore.plugin.textTemplates();