pimcore.registerNS("pimcore.plugin.lpnmagesync");

pimcore.plugin.lpnmagesync = Class.create(pimcore.plugin.admin, {
    getClassName: function() {
        return "pimcore.plugin.lpnmagesync";
    },

    initialize: function() {
        pimcore.plugin.broker.registerPlugin(this);
    },
 
    pimcoreReady: function (params,broker){
        // alert("LpnMageSync Plugin Ready!");
    },
    postOpenDocument : function(doc,type){
    	var ref=this;

        doc.toolbar.insert(5, {
            text: 'Sync avec Magento',
            itemId: 'synccmagento',
            scale: "medium",
            handler: this.sync.bind(doc)
        })

    },
    
    sync : function () {

       alert('/plugin/LpnMageSync/index/download/id/' +this.id);
       return;
         // pimcore.plugin.broker.fireEvent("preSaveAsset", this.id);

        Ext.Ajax.request({
            url: '/plugin/LpnMageSync/index/download/id/' +this.id,
            method: "post",
            success: function (response) {
                try{
                    var rdata = Ext.decode(response.responseText);
                    if (rdata && rdata.success) {
                        pimcore.helpers.showNotification(t("save"), t("successful_saved_asset"), "success");
                        this.resetChanges();
                        pimcore.plugin.broker.fireEvent("postSaveAsset", this.id);
                    }
                    else {
                        pimcore.helpers.showPrettyError(rdata.type, t("error"), t("error_saving_asset"),
                            rdata.message, rdata.stack, rdata.code);
                    }
                } catch(e){
                    pimcore.helpers.showNotification(t("error"), t("error_saving_asset"), "error");
                }
                // reload versions
                if (this.isAllowed("versions")) {
                    if (this["versions"] && typeof this.versions.reload == "function") {
                        this.versions.reload();
                    }
                }

                this.tab.unmask();

                if(typeof callback == "function") {
                    callback();
                }
            }.bind(this),
            failure: function () {
                this.tab.unmask();
            },
            params: this.getSaveData(only)
        });

     
    },
});

var lpnmagesyncPlugin = new pimcore.plugin.lpnmagesync();

