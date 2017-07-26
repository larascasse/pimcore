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

   /* postOpenObject : function(object,type){
    	var ref=this;

        doc.toolbar.insert(5, {
            text: 'Sync avec Magento',
            itemId: 'synccmagento',
            scale: "medium",
            handler: this.sync.bind(object)
        })

    },*/
    
    sync : function () {
    console.log("this",this)
       var url = 'https://www.laparqueterienouvelle.fr/LPN/sync_pim_document.php?path=' +this.data.key;
       //return;
         // pimcore.plugin.broker.fireEvent("preSaveAsset", this.id);

        Ext.Ajax.request({
            //url: '/plugin/LpnMageSync/index/download/id/' +this.id,
            url: url,
            method: "post",
            success: function (response) {
                try{
                    pimcore.helpers.showNotification(t("save"), t("successful_sync"), "success");

                    var rdata = Ext.decode(response.responseText);
                    if (rdata && rdata.success) {
                        pimcore.helpers.showNotification(t("save"), t("successful_sync"), "success");
                       // this.resetChanges();
                        //pimcore.plugin.broker.fireEvent("postSaveAsset", this.id);
                    }
                    else {
                        pimcore.helpers.showPrettyError(rdata.type, t("error"), t("error_sync"),
                            rdata.message, rdata.stack, rdata.code);
                    }
                } catch(e){
                    pimcore.helpers.showNotification(t("error"), t("error_sync"), "error");
                }
                


                if(typeof callback == "function") {
                    callback();
                }
            }.bind(this),
            failure: function () {
                this.tab.unmask();
            },
        });

     
    },
});

var lpnmagesyncPlugin = new pimcore.plugin.lpnmagesync();

