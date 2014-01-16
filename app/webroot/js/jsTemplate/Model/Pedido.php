<?php
class Pedido extends AppModel {
        public $name = 'Pedido';

		public $belongsTo = array(
			'Proyecto' => array(
				'className' => 'Proyecto',
				'conditions' => '',
				'dependent' => true,
				'foreignKey'   => 'IdProyecto'
			),
		);

		public $validate = array(
						'FechaFin' => array(
							'ruleName' => array(
								'rule' => 'notEmpty',
								'message' => 'El campo no puede estar vacio'
							),
							'ruleName2' => array(
								'rule' => 'date'
							)
						),
						'Numero' => array(
				            'rule' => 'notEmpty'
				        ),
						'Descripcion' => array(
				            'rule' => 'notEmpty'
				        ),
						'IdProyecto' => array(
				            'rule' => 'notEmpty',
							'message' => 'Completa el campo'
				        ),
						'estado' => array(
				            'rule' => 'notEmpty'
				        ),
		);

		
}
?>