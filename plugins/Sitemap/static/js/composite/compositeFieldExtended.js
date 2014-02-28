Ext.form.CompositeFieldExtended = Ext.extend(Ext.form.CompositeField, {

//    initComponent: function($super) {
//        $super();
//    },

    getValue: function(){
        this.values = {};
        this.eachItem(function(item){
            this.values[item.getName()]=item.getValue();
        },this);
        return this.values;
    },

    setValue: function(values){
        this.values = values;
        if(this.values != null){
        this.eachItem(function(item){
            if(!(item instanceof Ext.form.DisplayField)){
            var itemName = item.getName();
            if(this.values[itemName] != null){
                item.setValue(this.values[itemName]);
            }
            }
        },this);
        }
    }
});
Ext.reg('compositefieldextended', Ext.form.CompositeField);


