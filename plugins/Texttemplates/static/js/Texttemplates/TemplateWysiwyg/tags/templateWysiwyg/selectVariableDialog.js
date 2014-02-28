

pimcore.registerNS("pimcore.object.helpers.gridConfigDialog");
pimcore.plugin.textTemplates.selectVariableDialog = Class.create({

    data: {},
    brickKeys: [],

    initialize: function (object, callback) {

        this.config = {};
        this.config.classid = object.data.general.o_classId;
        this.callback = callback;

        this.forceFullPath = new Ext.form.Checkbox({
            fieldLabel: t("texttemplate_insert_variable_full_path")
        });

        var bottomPanel = {
            xtype: 'form',
            labelWidth: 200,
            items: [this.forceFullPath],
            height: 32,
            padding: 5,
            region: 'south'
        }


        if(!this.callback) {
            this.callback = function () {};
        }

        this.configPanel = new Ext.Panel({
            layout: "border",
            items: [this.getResultPanel(), bottomPanel],
            buttons: [{
                text: t("apply"),
                iconCls: "pimcore_icon_apply",
                handler: function () {
                    this.commitData();
                }.bind(this)
            }]

        });

        this.window = new Ext.Window({
            width: 850,
            height: 550,
            modal: true,
            title: t('grid_column_config'),
            layout: "fit",
            items: [this.configPanel]
        });

        this.window.show();
    },


    commitData: function () {
        var data = this.getData();
        this.callback(data);
        this.window.close();
    },

    getData: function () {
        var activeNode = this.tree.getSelectionModel().getSelectedNode();
        if(activeNode && activeNode.attributes) {
            if(this.forceFullPath.getValue()) {
                this.data = activeNode.attributes.key;
            } else {
                this.data = activeNode.attributes.layout.name;
            }


        } else {
            this.data = "";
        }
        return this.data;
    },

    getResultPanel: function () {
        if (!this.resultPanel) {

            this.brickKeys = [];
            this.resultPanel = this.getClassTree("/admin/class/get-class-definition-for-column-config", this.config.classid);
        }

        return this.resultPanel;
    },

    getClassTree: function(url, id) {

        this.tree = new Ext.tree.TreePanel({
            title: t('class_definitions'),
            xtype: "treepanel",
            region: "center",
            enableDrag: true,
            enableDrop: false,
            autoScroll: true,
            rootVisible: false,
            root: {
                id: "0",
                root: true,
                text: t("base"),
                draggable: false,
                leaf: true,
                isTarget: true
            },
            listeners:{
                "dblclick": function(node) {
                    this.commitData();
                }.bind(this)
            }
        });

        Ext.Ajax.request({
            url: url,
            params: {
                id: id
            },
            success: this.initLayoutFields.bind(this, this.tree)
        });

        return this.tree;
    },

    initLayoutFields: function (tree, response) {
        var data = Ext.decode(response.responseText);

        var keys = Object.keys(data);
        for(var i = 0; i < keys.length; i++) {
            if (data[keys[i]]) {
                if (data[keys[i]].childs) {
                    var attributePrefix = "";
                    var text = t(data[keys[i]].nodeLabel);
                    if(data[keys[i]].nodeType == "objectbricks") {
                        text = ts(data[keys[i]].nodeLabel) + " " + t("columns");
                        attributePrefix = data[keys[i]].nodeLabel;
                    }
                    var baseNode = new Ext.tree.TreeNode({
                        type: "layout",
                        draggable: false,
                        iconCls: "pimcore_icon_" + data[keys[i]].nodeType,
                        text: text
                    });

                    tree.getRootNode().appendChild(baseNode);
                    for (var j = 0; j < data[keys[i]].childs.length; j++) {
                        baseNode.appendChild(this.recursiveAddNode(data[keys[i]].childs[j], baseNode, attributePrefix));
                    }
                    if(data[keys[i]].nodeType == "object") {
                        baseNode.expand();
                    } else {
                        baseNode.collapse();
                    }
                }
            }
        }
    },

    recursiveAddNode: function (con, scope, attributePrefix) {

        var fn = null;
        var newNode = null;

        if (con.datatype == "layout") {
            fn = this.addLayoutChild.bind(scope, con.fieldtype, con);
        }
        else if (con.datatype == "data") {
            fn = this.addDataChild.bind(scope, con.fieldtype, con, attributePrefix);
        }

        newNode = fn();

        if (con.childs) {
            for (var i = 0; i < con.childs.length; i++) {
                this.recursiveAddNode(con.childs[i], newNode, attributePrefix);
            }
        }

        return newNode;
    },

    addLayoutChild: function (type, initData) {

        var nodeLabel = t(type);

        if (initData) {
            if (initData.name) {
                nodeLabel = initData.name;
            }
        }
        var newNode = new Ext.tree.TreeNode({
            type: "layout",
            draggable: false,
            iconCls: "pimcore_icon_" + type,
            text: nodeLabel
        });

        this.appendChild(newNode);

        if(this.rendered) {
            this.renderIndent();
            this.expand();
        }

        return newNode;
    },

    addDataChild: function (type, initData, attributePrefix) {

        if(type != "objectbricks" && !initData.invisible) {
            var isLeaf = true;
            var draggable = true;

            // localizedfields can be a drop target
            if(type == "localizedfields") {
                isLeaf = false;
                draggable = false;
            }

            var key = initData.name;
            if(attributePrefix) {
                key = attributePrefix + "~" + key;
            }

            var newNode = new Ext.tree.TreeNode({
                text: ts(initData.title),
                key: key,
                type: "data",
                layout: initData,
                leaf: isLeaf,
                draggable: draggable,
                dataType: type,
                iconCls: "pimcore_icon_" + type
            });

            this.appendChild(newNode);

            if(this.rendered) {
                this.renderIndent();
                this.expand();
            }

            return newNode;
        } else {
            return null;
        }

    }

});
