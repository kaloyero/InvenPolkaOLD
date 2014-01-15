<?php
class Articulo extends AppModel {
        public $name = 'Articulo';
		public $actsAs = array(
			'Upload.Upload' => array(
				'idFoto' => array(
							'fields' => array(
							'dir' => 'dir'
							),

						  'thumbnailSizes' => array(
						                    'big' => '600x600',
						                    'small' => '200x200',
						                    'thumb' => '80x80'

						            ),
						'thumbnailMethod'	=> 'php'
				)

			)
			);
		public $validate = array(
				        'CodigoArticulo' => array(
				            'rule' => 'notEmpty',
				        ),
						'Descripcion' => array(
				            'rule' => 'notEmpty'
				        ),/*
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
				        ),*/

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