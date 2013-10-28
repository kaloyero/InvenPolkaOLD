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
			showFinder : function(objectType) {
				serverManager.showFinder({
					object : objectType,
					onSuccess : function(data) {
					    var renderInstace = renderTranslator.getRender(objectType);
                        renderInstace.onFinder(data);
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
					     var renderInstace = renderTranslator.getRender(objectType);
    					    renderInstace.onSaved(data);
					}
				});
			},
			search : function(objectType,formData) {
				serverManager.search({
					object : objectType,
					data:formData,
					onSuccess : function(data) {
					    var renderInstace = renderTranslator.getRender(objectType);
                        renderInstace.onSearched(data);
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
    		updateConfigurations : function(objectType,elementIdToEdit,newValue) {
        				serverManager.updateConfigurations({
        					object : objectType,
        					editObject:elementIdToEdit,
        					value:newValue,
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
