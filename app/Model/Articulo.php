<?php
class Articulo extends AppModel {
        public $name = 'Articulo';
		public $actsAs = array(
			'Upload.Upload' => array(
				'IdFoto' => array(
					'fields' => array(
						'dir' => 'dir'
					)
				)
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