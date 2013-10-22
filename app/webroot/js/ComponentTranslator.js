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
					}
				});
			},

		});

var translator = new ComponentTranslator();
