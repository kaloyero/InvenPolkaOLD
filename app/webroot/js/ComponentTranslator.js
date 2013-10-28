var ComponentTranslator = new Class(
		{

		    show : function(objectType) {
				serverManager.showList({
					object : objectType,
					onSuccess : function(data) {
					    var renderInstace = renderTranslator.getRender(objectType);
                        renderInstace.onList(data);
					}
				});
			},
			add : function(objectType) {
				serverManager.add({
					object : objectType,
					onSuccess : function(data) {
					    var renderInstace = renderTranslator.getRender(objectType);
                        renderInstace.onAdd(data);
					}
				});
			},
			save : function(objectType,formData) {
				serverManager.save({
					object : objectType,
					data:formData,
					onSuccess : function(data) {
					 console.log("LISTO")
					jQuery.jGrowl("Creado con exito.", {
						theme : 'success'
					});
					}
				});
			},
			update : function(objectType,formData) {
    				serverManager.update({
    					object : objectType,
    					data:formData,
    					onSuccess : function(data) {
    					    var renderInstace = renderTranslator.getRender(objectType);
    					    renderInstace.onUpdated(data);
    					}
    				});
    			},
			 view : function(objectType,idObject) {
    				serverManager.view({
    					object : objectType,
    					id : idObject,
    					onSuccess : function(data) {
    					    var renderInstace = renderTranslator.getRender(objectType);
                            renderInstace.onView(data);
    					}
    				});
    			}

		});

var translator = new ComponentTranslator();
