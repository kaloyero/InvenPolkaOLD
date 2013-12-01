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
			add : function(objectType,dataToSend) {
				serverManager.add({
					object : objectType,
					data:dataToSend,
					onSuccess : function(data) {
					    var renderInstace = renderTranslator.getRender(objectType);
                        renderInstace.onAdd(data);
					}
				});
			},
			addMovimiento : function(objectType,dataToSend,funcion) {
				serverManager.addMovimiento({
					object : objectType,
					data:dataToSend,
					onSuccess : function(data) {
					    var renderInstace = renderTranslator.getRender(objectType);
                        renderInstace.onAdd(data);
					}
				},funcion);
			},
			getConfiguraciones : function(objectType,idObject) {
				serverManager.getConfiguraciones({
					object : "configuracion",
				    id : idObject,
					onSuccess : function(data) {
					    var renderInstace = renderTranslator.getRender(objectType);
                        renderInstace.onRetrievedConfiguraciones(data);
					}
				});
			},
			save : function(objectType,formData) {
				serverManager.save({
					object : objectType,
					data:formData,
					onSuccess : function(data) {
					    messageRender.createMessage(data);
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
    					    messageRender.createMessage(data);
    					    var renderInstace = renderTranslator.getRender(objectType);
    					    renderInstace.onUpdated(data);

						},
    				});
    			},
    		updateConfigurations : function(objectType,elementIdToEdit,newValue) {
        				serverManager.updateConfigurations({
        					object : objectType,
        					editObject:elementIdToEdit,
        					value:newValue,
        					onSuccess : function(data) {
        					    messageRender.createMessage(data);
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
    		},
			 viewDetail : function(objectType,idObject) {
    				serverManager.viewDetail({
    					object : objectType,
    					id : idObject,
    					onSuccess : function(data) {
    					    var renderInstace = renderTranslator.getRender(objectType);
                            renderInstace.onView(data);
    					}
    				});
    		},
			confirmarPedido : function(objectType,idObject) {

				serverManager.confirmarPedido({
					object : objectType,
					id : idObject,
					onSuccess : function(data) {
					    console.log("PASA")
					     var renderInstace = renderTranslator.getRender(objectType);
    					    renderInstace.onSaved(data);
					    jQuery.jGrowl("Pedido Confirmado.", {
					        theme : 'success'
				        });
						jQuery('.paginate_active').click();
					},
					onError : function(data) {
					    jQuery.jGrowl("El Pedido no se pudo confirmar.", {
					        theme : 'success'
				        });
						jQuery('.paginate_active').click();
					}

				});
    		}

		});

var translator = new ComponentTranslator();
