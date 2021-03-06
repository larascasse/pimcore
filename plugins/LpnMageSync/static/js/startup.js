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
                
            });
            obj.toolbar.insert(5, menu);
        }

        //realisations
        else if(obj.data.general.o_classId==8) {

             var menu = new Ext.SplitButton({
                text: t('sync magento'),
                iconCls: "pimcore_icon_publish",
                scale: "medium",
                handler: this.syncCategory.bind(obj),
                
            });
            obj.toolbar.insert(5, menu);
        } 


        //taxonomu
        else if(obj.data.general.o_classId==6) {

             var menu = new Ext.SplitButton({
                text: t('sync magento'),
                iconCls: "pimcore_icon_publish",
                scale: "medium",
                handler: this.syncTaxonomies.bind(obj),
                
            });
            obj.toolbar.insert(5, menu);
        }
        //withchildren,configurable,create
        else if(obj.data.general.o_classId==5) {

             var menu = new Ext.SplitButton({
                text: t('sync magento + enfants (BATCH)'),
                iconCls: "pimcore_icon_publish",
                scale: "small",
                handler: this.syncProduct.bind(obj,true,false,false,true),
                menu: [
                    {
                        text: t('sync magento + enfants'),
                        iconCls: "pimcore_icon_publish",
                        scale: "medium",
                        handler: this.syncProduct.bind(obj,true,false,false,false),
                    },
                     {
                        text: t('sync magento seul'),
                        iconCls: "pimcore_icon_save",
                        //withchildren,configurable,create
                        handler: this.syncProduct.bind(obj,false,false,false,false)
                    },
                    {
                        text: t('sync configurable'),
                        iconCls: "pimcore_icon_save",
                        handler: this.syncProduct.bind(obj,true,true,false,false)
                    },
                    {
                        xtype: 'menuseparator'
                    },
                    {
                        text: t('create magento + enfants'),
                        iconCls: "pimcore_icon_save",
                        //withchildren,configurable,create
                        handler: this.syncProduct.bind(obj,true,false,true,false)
                    },
                    {
                        text: t('create seul'),
                        iconCls: "pimcore_icon_save",
                        handler: this.syncProduct.bind(obj,false,false,true,false)
                    },
                    
                    {
                        text: t('create configurable'),
                        iconCls: "pimcore_icon_save",
                        handler: this.syncProduct.bind(obj,true,true,true,false)
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

         //Teinte
        else if(obj.data.general.o_classId==13) {

             var menu = new Ext.SplitButton({
                text: t('sync magento + enfants'),
                iconCls: "pimcore_icon_publish",
                scale: "medium",
                handler: this.syncTeinte.bind(obj,true),
                menu: [
                    
                    {
                        text: t('create magento + enfants'),
                        iconCls: "pimcore_icon_save",
                        //withchildren,configurable,create
                        handler: this.syncTeinte.bind(obj,true)
                    },
                    {
                        text: t('Effacer le cache'),
                        iconCls: "pimcore_icon_save",
                        handler: this.syncTeinte.bind(obj)
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
       var url = '/plugin/LpnMageSync/index/publish-cms-block/key/'+this.data.general.o_key;
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


    syncCategory : function () {
       console.log("this",this)
       //var url = 'https://www.laparqueterienouvelle.fr/LPN/sync_pim_document.php?path=' +this.data.key+'&t='+(new Date());
       var url = '/plugin/LpnMageSync/index/publish-category/key/'+this.data.general.o_key;
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


    syncTaxonomies : function () {
       console.log("this",this)
       //var url = 'https://www.laparqueterienouvelle.fr/LPN/sync_pim_document.php?path=' +this.data.key+'&t='+(new Date());
       var url = '/plugin/LpnMageSync/index/publish-taxonomies';///key='+this.data.general.o_key;
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


     syncProduct : function (withChildren,configurable,create,queueMode) {
        console.log("syncProduct",this);
        if(!this.data)
            return;
       var url = '/plugin/LpnMageSync/index/publish-to-magento/id/' +this.id;
       if(withChildren)
        url+="/withChildren/1";
       if(configurable)
        url+="/configurable/1";
       if(create)
        url+="/create/1";
        if(queueMode)
         url+="/queueMode/1";
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


    syncTeinte : function (create) {
        console.log("syncProduct",this);
        if(!this.data)
            return;
       var url = '/plugin/LpnMageSync/index/publish-to-magento/id/' +this.id;
       

       
       if(create)
        url+="/create/1";

   
      url+="/teinte/1";

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

