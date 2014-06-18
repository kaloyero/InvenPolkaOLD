var AppStatus = new Class({
    Extends: Render,
    initialize: function(name){
        this.actualTable="";
        this.startTablein=0;
        this.showRowsByPage=100;
        this.actualSearch="";
    }

});

appStatus=new AppStatus();