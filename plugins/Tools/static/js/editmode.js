pimcore.registerNS("pimcore.plugin.tools");

pimcore.plugin.tools = Class.create(pimcore.plugin.admin, {

    getClassName:function () {
        return "pimcore.plugin.tools";
    },

    initialize:function () {
        pimcore.plugin.broker.registerPlugin(this);
        this.searchTabIdCounter = 0;
    },

    pimcoreReady:function (params, broker) {
        try {
            console.log("Pimcore Tools Plugin is Ready");
        }
        catch (e) {

        }
    },

    postOpenObject:function (object, type) {
        if (type == "object") {
            this.objectid = object.id;
            var classname = object.data.general.o_className;

            switch (classname) {

                default:
                    break;
            }
        }
    },
    getDataComplete:function (response) {

        this.data = Ext.decode(response.responseText);
        if (this.data.message != null) {
            Ext.MessageBox.show({
                title:"Developer Plugin",
                msg:this.data.message,
                buttons:Ext.Msg.OK,
                icon:Ext.MessageBox.ERROR
            });
            return;
        }

        var element = '#object_' + this.objectid + ' .objectlayout_element_developerrpos .x-panel-bwrap .x-panel-body';

        if ($(element).length != 1) {
            Ext.MessageBox.show({
                title:"Tools Plugin",
                msg:"internal Plugin Error",
                buttons:Ext.Msg.OK,
                icon:Ext.MessageBox.ERROR
            });
        }

        $(element).css({'background-image':'url(' + this.data.imageurl + ')'});

    }

});

new pimcore.plugin.tools();
