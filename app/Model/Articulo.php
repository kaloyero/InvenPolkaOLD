<?php
class Articulo extends AppModel {
        public $name = 'Articulo';
		public $actsAs = array(
			'Upload.Upload' => array(
				'idFoto' => array(
					'fields' => array(
						'dir' => 'dir'
					)
				)
			)
			);
		public $validate = array(
				        'CodigoArticulo' => array(
				            'rule' => 'notEmpty',
							'on' => 'create'
				        ),
						'Descripcion' => array(
				            'rule' => 'notEmpty'
				        ),
						'idFoto' => array(
				            'rule1'=>array(
							        'rule' => array('extension',array('jpeg','jpg','png','gif')),
							        'required' => 'create',
							        'allowEmpty' => true,
							        'message' => 'Seleccione una imagen valida',
							        'on' => 'create',
							        'last'=>true
							    ),
							    'rule2'=>array(
							        'rule' => array('extension',array('jpeg','jpg','png','gif')),
							        'message' => 'Seleccione una imagen valida',
							        'on' => 'update',
							    ),
				        ),

						'IdCategoria' => array(
				            'rule' => 'notEmpty',
							'message' => 'Completa el campo'
				        ),
						'IdObjeto' => array(
				            'rule' => 'notEmpty',
							'message' => 'Completa el campo'
				        ),
						'IdEstilo' => array(
				            'rule' => 'notEmpty',
							'message' => 'Completa el campo'
				        ),
						'IdMaterial' => array(
				            'rule' => 'notEmpty',
							'message' => 'Completa el campo'
				        ),
						'IdDecorado' => array(
				            'rule' => 'notEmpty',
							'message' => 'Completa el campo'
				        ),
						'IdDimension' => array(
				            'rule' => 'notEmpty',
							'message' => 'Completa el campo'
				        )
	);

/**		var $hasOne = array(
        'Estilo' => array(
            'className'    => 'Estilo',
            'foreignKey'    => 'Id'
         )
    );

	**/
}
?>