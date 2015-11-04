pimcore.registerNS("pimcore.object.classes.data.Tagfield");
pimcore.object.classes.data.Tagfield = Class.create(pimcore.object.classes.data.data, {

    type: "Tagfield",
    
    allowIn: {
        object: true,
        objectbrick: true,
        fieldcollection: true,
        localizedfield: true
    },


    initialize: function (treeNode, initData) {
        this.type = "Tagfield";
        this.initData(initData);
        this.treeNode = treeNode;
    },

    getTypeName: function () {
        return t("Tagfield");
    },

    getGroup: function () {
        return "select";
    },

    getIconClass: function () {
        return "pimcore_icon_Tagfield";
    },

    getLayout: function ($super) {
        $super();
        this.specificPanel.removeAll();
        this.specificPanel.removeAll();
        this.specificPanel.add([
            {
                xtype: "spinnerfield",
                fieldLabel: t("width"),
                name: "width",
                value: this.datax.width
            }
        ]);

        return this.layout;

    }
});
