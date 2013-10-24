<?php
class Inventario extends AppModel {
        public $name = 'Inventario';

		public $belongsTo = array(
			'Articulo' => array(
				'className' => 'Articulo',
				'conditions' => '',
				'dependent' => true,
				'foreignKey'   => 'IdArticulo'
			),
			'Proyecto' => array(
				'className' => 'Proyecto',
				'conditions' => '',
				'dependent' => true,
				'foreignKey'   => 'IdProyecto'
			),
			'Deposito' => array(
				'className' => 'Deposito',
				'conditions' => '',
				'dependent' => true,
				'foreignKey'   => 'IdDeposito'
			)
		);
		
}
?>