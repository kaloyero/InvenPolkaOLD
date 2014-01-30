var ComponentTranslator = new Class(
		{

		    show : function(objectType) {
				serverManager.showList({
					object : objectType,
					onSuccess : function(data) {
					    var renderInstace = renderTranslator.getRender(objectType);
					    renderInstace.currentStatus="";
                        renderInstace.onList(data);
					}
				});
			},
		    showWithParam : function(objectType,param) {
				serverManager.showList({
					object : objectType,
					onSuccess : function(data) {
					    var renderInstace = renderTranslator.getRender(objectType);
					    renderInstace.currentStatus="";
                        renderInstace.onList(data);
					}
				},param);
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
			save : function(objectType,formData,callback) {
				serverManager.save({
					object : objectType,
					data:formData,
					onSuccess : function(data) {
					    if (callback){
					         callback();
					    }else{
					         messageRender.createMessage(data);
                            var renderInstace = renderTranslator.getRender(objectType);
            			    renderInstace.onSaved(data);
					    }

					}
				});
			},
            delete : function(objectType,idObject) {
                serverManager.delete({
                    object : objectType,
                    id : idObject,
                    onSuccess : function(data) {
                        if (objectType=="proyecto"){
                              messageRender.createMessageProyecto(data);
                        }else{
                            messageRender.createMessageConfiguraciones(objectType,data);
                        }

                        var renderInstace = renderTranslator.getRender(objectType);
    					    renderInstace.onDeleted();
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
			viewPost : function(objectType,formData) {
    				serverManager.viewPost({
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
					     var renderInstace = renderTranslator.getRender(objectType);
    					    renderInstace.onSavedConfirmado(data);
					    jQuery.jGrowl("Pedido Confirmado.", {
					        theme : 'success'
				        });

					},
					onError : function(data) {
					    jQuery.jGrowl("El Pedido no se pudo confirmar.", {
					        theme : 'success'
				        });
						jQuery('.paginate_active').click();
					}

				});
    		},
			loginUser: function(objectType,formData) {
				serverManager.loginUser({
					object : objectType,
					data: formData,
					onSuccess : function(data) {
						jQuery("body").empty();
						jQuery("body").append(data);
					},
					onError : function(data) {
						jQuery(data).append("");
					}

				});
    		},
			logOutUser: function(objectType) {
				serverManager.logOutUser({
					object : objectType,
					onSuccess : function(data) {
						jQuery("body").empty();
						jQuery("body").append(data);
					},
					onError : function(data) {
					}
				});
    		},
			cambioPassword: function(objectType) {
    				serverManager.cambioPassword({
    					object : objectType,
    					onSuccess : function(data) {
    					    var renderInstace = renderTranslator.getRender(objectType);
                            renderInstace.onChangePass(data);
    					}
    				});
    		},
			cambioPasswordPost: function(objectType,formData) {
				serverManager.cambioPasswordPost({
					object : objectType,
					data:formData,
   					onSuccess : function(data) {
					     messageRender.createMessage(data);
					     var renderInstace = renderTranslator.getRender(objectType);
    					 renderInstace.onChangePass(data);
   					}
				});
    		},
		});

var translator = new ComponentTranslator();
