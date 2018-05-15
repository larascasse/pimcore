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

    postOpenObject: function(obj,type){
        console.log("postOpenObject",obj);

        //realisations
        if(obj.data.general.o_classId==16) {

             var menu = new Ext.SplitButton({
                text: t('sync magento'),
                iconCls: "pimcore_icon_publish",
                scale: "medium",
                handler: this.syncRealisation.bind(obj),
                /*menu: [
                    {
                        text: t('sync magento seul'),
                        iconCls: "pimcore_icon_save",
                        //withchildren,configurable,create
                        handler: this.syncProduct.bind(obj,false,false,false)
                    },
                    {
                        text: t('sync configurable'),
                        iconCls: "pimcore_icon_save",
                        handler: this.syncProduct.bind(obj,true,true,false)
                    },
                    {
                        xtype: 'menuseparator'
                    },
                    {
                        text: t('create magento + enfants'),
                        iconCls: "pimcore_icon_save",
                        //withchildren,configurable,create
                        handler: this.syncProduct.bind(obj,true,false,true)
                    },
                    {
                        text: t('create seul'),
                        iconCls: "pimcore_icon_save",
                        handler: this.syncProduct.bind(obj,false,false,true)
                    },
                    
                    {
                        text: t('create configurable'),
                        iconCls: "pimcore_icon_save",
                        handler: this.syncProduct.bind(obj,true,true,true)
                    },
                    {
                        xtype: 'menuseparator'
                    },
                    {
                        text: t('Effacer le cache'),
                        iconCls: "pimcore_icon_save",
                        handler: this.syncProduct.bind(obj)
                    }
                ]*/
            });
            obj.toolbar.insert(5, menu);
        }
        //withchildren,configurable,create
        if(obj.data.general.o_classId==5) {

             var menu = new Ext.SplitButton({
                text: t('sync magento + enfants'),
                iconCls: "pimcore_icon_publish",
                scale: "medium",
                handler: this.syncProduct.bind(obj,true,false,false),
                menu: [
                    {
                        text: t('sync magento seul'),
                        iconCls: "pimcore_icon_save",
                        //withchildren,configurable,create
                        handler: this.syncProduct.bind(obj,false,false,false)
                    },
                    {
                        text: t('sync configurable'),
                        iconCls: "pimcore_icon_save",
                        handler: this.syncProduct.bind(obj,true,true,false)
                    },
                    {
                        xtype: 'menuseparator'
                    },
                    {
                        text: t('create magento + enfants'),
                        iconCls: "pimcore_icon_save",
                        //withchildren,configurable,create
                        handler: this.syncProduct.bind(obj,true,false,true)
                    },
                    {
                        text: t('create seul'),
                        iconCls: "pimcore_icon_save",
                        handler: this.syncProduct.bind(obj,false,false,true)
                    },
                    
                    {
                        text: t('create configurable'),
                        iconCls: "pimcore_icon_save",
                        handler: this.syncProduct.bind(obj,true,true,true)
                    },
                    {
                        xtype: 'menuseparator'
                    },
                    {
                        text: t('Effacer le cache'),
                        iconCls: "pimcore_icon_save",
                        handler: this.syncProduct.bind(obj)
                    }
                ]
            });
            obj.toolbar.insert(5, menu);
        }
           


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
       //var url = 'https://www.laparqueterienouvelle.fr/LPN/sync_pim_document.php?path=' +this.data.key+'&t='+(new Date());
       var url = '/plugin/LpnMageSync/index/publish-cms-block/key/'+this.data.key;
       console.log(url,this.data)
    

        Ext.Ajax.request({
            //url: '/plugin/LpnMageSync/index/download/id/' +this.id,
            url: url,
            method: "get",
            success: function (response) {
                try{
                   // pimcore.helpers.showNotification(t("save"), t("successful_sync"), "success");

                    var rdata = Ext.decode(response.responseText);
                    if (rdata && rdata.success) {
                        pimcore.helpers.showNotification(t("save"), t("successful_sync")+rdata.message, "success");
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

    syncRealisation : function () {
       console.log("this",this)
       //var url = 'https://www.laparqueterienouvelle.fr/LPN/sync_pim_document.php?path=' +this.data.key+'&t='+(new Date());
       var url = '/plugin/LpnMageSync/index/publish-cms-block/real/'+this.data.general.o_key;
       //console.log(url,this.data,this.general)
       //console.log(url,this.data,this.key)
       //alert(url);

        Ext.Ajax.request({
            //url: '/plugin/LpnMageSync/index/download/id/' +this.id,
            url: url,
            method: "get",
            success: function (response) {
                try{
                   // pimcore.helpers.showNotification(t("save"), t("successful_sync"), "success");

                    var rdata = Ext.decode(response.responseText);
                    if (rdata && rdata.success) {
                        pimcore.helpers.showNotification(t("save"), t("successful_sync")+rdata.message, "success");
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


     syncProduct : function (withChildren,configurable,create) {
        console.log("syncProduct",this);
        if(!this.data)
            return;
       var url = '/plugin/LpnMageSync/index/publish-to-Magento/id/' +this.id;
       if(withChildren)
        url+="/withChildren/1";
       if(configurable)
        url+="/configurable/1";
       if(create)
        url+="/create/1";
       console.log(url)
       //return;
       //return;
         // pimcore.plugin.broker.fireEvent("preSaveAsset", this.id);

        Ext.Ajax.request({
            //url: '/plugin/LpnMageSync/index/download/id/' +this.id,
            url: url,
            method: "get",
            success: function (response) {
                try{
                   // pimcore.helpers.showNotification(t("save"), t("successful_sync"), "success");

                    var rdata = Ext.decode(response.responseText);
                    if (rdata && rdata.success) {
                        pimcore.helpers.showNotification(t("save"), t("successful_sync")+rdata.message, "success");
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

