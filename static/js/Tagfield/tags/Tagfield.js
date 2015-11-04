pimcore.registerNS("pimcore.object.tags.Tagfield");
pimcore.object.tags.Tagfield = Class.create(pimcore.object.tags.input, {

    type: "Tagfield",

    initialize: function (data, fieldConf) {
        this.data = data;
        this.fieldConfig = fieldConf;
    },
    getExtjsVersion: function () {
        var majorVersion = 0;
        if (Ext.version != undefined) {
            majorVersion = Ext.version.substring(0, Ext.version.indexOf("."));
        } else {
            majorVersion = Ext.getVersion().getMajor();
        }

        return majorVersion;
    },
    getLayoutEdit:function(){
        var extver = this.getExtjsVersion();
        var self = this;

        if(extver <= 3) {
            var store = new Ext.data.JsonStore({
                autoDestroy: true,
                baseParams:{
                    key: this.fieldConfig.name
                },
                autoSave:false,
                url: '/plugin/Tagfield/Admin/gettags',
                root: 'tags',
                fields: ['value']
            });
                
            store.load();
            
            this.component =  new Ext.ux.form.SuperBoxSelect({
                allowBlank:true,
                autoSave:false,
                autoDestroy:true,
                queryDelay: 100,
                triggerAction: 'all',
                resizable: true,
                mode: 'remote',
                width: this.fieldConfig.width,
                minChars: 2,
                fieldLabel: this.fieldConfig.title,
                name: this.fieldConfig.name,
                value: this.data,
                itemCls:"object_field",
                emptyText: t("superselectbox_empty_text"),
                store: store,
                fields: ['value'],
                displayField: 'value',
                valueField: 'value',
                allowAddNewData: true,
                createNewOnEnter: true,
                listeners: {
                    newitem: function(bs, v, f) {
                        v = v + '';
                        var newObj = {
                            value: v
                        };
                        bs.addNewItem(newObj);
                    }
                }
            });
        } else {
            var store = new Ext.data.JsonStore({
                proxy: {
                    type: 'ajax',
                    url: '/plugin/Tagfield/Admin/gettags',
                    reader: {
                        type: 'json',
                        rootProperty: 'tags'
                    },
                    extraParams: {
                        key: self.fieldConfig.name
                    }
                },
                fields: ['value']
            });
            
            store.load();
            var value = '';

            if(typeof this.data !== 'undefined' && this.data !== null) {
                for(var i=0;i<this.data.length;i++) {
                    value += this.data[i].value;
                    if(i<(this.data.length)-1) {
                        value += ",";
                    }
                }
            }

            this.component =  Ext.create('Ext.form.field.Tag', {
                autoSelect: true,
                filterPickList: true,
                allowBlank:true,
                queryDelay: 100,
                triggerAction: 'all',
                width: this.fieldConfig.width,
                minChars: 2,
                fieldLabel: this.fieldConfig.title,
                name: this.fieldConfig.name,
                id: this.fieldConfig.name,
                value: value,
                itemCls: "object_field",
                store: store,
                displayField: 'value',
                valueField: 'value',
                filterPickList: true,
                createNewOnEnter: true,
                queryMode: 'remote'
            });
        }

        return this.component;
    }
});




















