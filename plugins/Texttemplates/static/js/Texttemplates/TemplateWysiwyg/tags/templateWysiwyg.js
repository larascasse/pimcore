/**
 * Pimcore
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.pimcore.org/license
 *
 * @copyright  Copyright (c) 2009-2010 elements.at New Media Solutions GmbH (http://www.elements.at)
 * @license    http://www.pimcore.org/license     New BSD License
 */

pimcore.registerNS("pimcore.object.tags.templateWysiwyg");
pimcore.object.tags.templateWysiwyg = Class.create(pimcore.object.tags.wysiwyg, {

    type: "templateWysiwyg",

    initialize: function (data, fieldConfig) {
        this.data = "";
        if (data) {
            this.data = data;
        }
        this.fieldConfig = fieldConfig;
    },

    getLayoutEdit: function () {

        if (parseInt(this.fieldConfig.width) < 1) {
            this.fieldConfig.width = 400;
        }
        if (parseInt(this.fieldConfig.height) < 1) {
            this.fieldConfig.height = 300;
        }

        this.editableDivId = "object_tempateWysiwyg_" + uniqid();
        this.previewIframeId = "object_wysiwyg_iframe_" + uniqid();

        var pConf = {
            width: this.fieldConfig.width,
            html: '<div style="cursor:pointer;" id="' + this.editableDivId + '">' + this.data + '</div>',
            cls: "object_field"
        };


        var ckeditor = new Ext.Panel(pConf);

        this.editPanel = new Ext.Panel({
            title: ts(this.fieldConfig.title) + " " + t("edit"),
            autoHeight: true,
            autoWidth: true,
            autoScroll: true,
            padding: 10,
            hidden: true,
            items: [ckeditor]
        });


        this.previewPanelContent = new Ext.Panel({
            cls: "object_field",
            autoEl: {id: this.editableDivId + "_preview"}
        });

        this.previewPanelContent.on("afterrender", function () {
            this.updatePreviewPanel();
        }.bind(this));

        this.previewPanel = new Ext.Panel({
            title: ts(this.fieldConfig.title) + " " + t("preview"),
            padding: 10,
            items: [this.previewPanelContent]
        });

        this.showPreviewButton= new Ext.Button({
            iconCls: "pimcore_icon_texttemplate_preview",
            text: t("texttemplate_show_preview"),
            hidden: true,
            handler: function (button) {
                this.showPreviewPanel();
            }.bind(this)
        });

        this.showEditButton = new Ext.Button({
            iconCls: "pimcore_icon_texttemplate_edit",
            text: t("texttemplate_show_edit"),
            hidden: false,
            handler: function (button) {
                this.showEditPanel();
            }.bind(this)
        });


        this.component = new Ext.Panel({
            width: this.fieldConfig.width + 40,
            style: "padding-bottom: 15px",
            tbar: [this.showEditButton, this.showPreviewButton],
            items: [this.editPanel, this.previewPanel]
        });

        return this.component;
    },

    isRendered: function () {
        if(this.component) {
            return this.component.rendered;
        }
    },

    showEditPanel: function() {
        this.ckeditor = pimcore.plugin.texttemplate.helpers.initCkEditor(this.fieldConfig, this.editableDivId, this.object);


        this.editPanel.setVisible(true);
        this.previewPanel.setVisible(false);
        this.showPreviewButton.setVisible(true);
        this.showEditButton.setVisible(false);
    },

    showPreviewPanel: function() {
        this.updatePreviewPanel();
        
        this.editPanel.setVisible(false);
        this.previewPanel.setVisible(true);
        this.showPreviewButton.setVisible(false);
        this.showEditButton.setVisible(true);

        this.ckeditor.destroy();
        this.ckeditor = null;
    },

    updatePreviewPanel: function() {
        var data = this.getValue();
//        console.log(this.object);
        
        Ext.Ajax.request({
            url: "/plugin/Texttemplates/preview/get-preview",
            method: "post",
            params: {object_id: this.object.id, fieldname: this.myName, data: data},
            success: function (response) {

                var iframe = document.createElement("iframe");
                iframe.setAttribute("frameborder", "0");
                iframe.setAttribute("id", this.previewIframeId);
                iframe.onload = function () {
                    var document = Ext.get(this.previewIframeId).dom.contentWindow.document;
                    var iframeContent = response.responseText;
                    iframeContent += '<link href="/pimcore/static/js/lib/ckeditor/contents.css" rel="stylesheet" type="text/css" />';
                    document.body.innerHTML = iframeContent;
                    //Ext.get(document.body).on("click", this.initCkEditor.bind(this));

                }.bind(this);

                Ext.get(this.editableDivId + "_preview").dom.innerHTML = "";
                Ext.get(this.editableDivId + "_preview").dom.appendChild(iframe);


                // set dimensions of iframe
                if (this.fieldConfig.height) {
                    Ext.get(this.previewIframeId).setStyle({
                        height: this.fieldConfig.height + "px"
                    });
                }
                if (this.fieldConfig.width) {
                    Ext.get(this.previewIframeId).setStyle({
                        width: this.fieldConfig.width + "px"
                    });
                }



//                Ext.get(this.editableDivId + "_preview").update(response.responseText);
            }.bind(this)
        });
    },

    isDirty: function() {
        if(!this.isRendered()) {
            return false;
        }

        if(this.ckeditor) {
            this.dirty = this.ckeditor.checkDirty();
        }

        return this.dirty;
    }

});