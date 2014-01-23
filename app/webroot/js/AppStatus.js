var AppStatus = new Class({
    Extends: Render,
    initialize: function(name){
        this.actualTable="";
        this.startTablein=0;
        this.showRowsByPage=10;
    }

});

appStatus=new AppStatus();