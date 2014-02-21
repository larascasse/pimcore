pimcore.registerNS("pimcore.plugin.lpnplugin");

pimcore.plugin.lpnplugin = Class.create(pimcore.plugin.admin, {
    getClassName: function() {
        return "pimcore.plugin.lpnplugin";
    },

    initialize: function() {
        pimcore.plugin.broker.registerPlugin(this);
    },
 
    pimcoreReady: function (params,broker){
        // alert("Example Ready!");
    }
});

var lpnpluginPlugin = new pimcore.plugin.lpnplugin();

