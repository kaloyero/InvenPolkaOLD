<?php
class MovimientoInventario extends AppModel {
        public $name = 'MovimientoInventario';
		
		public $belongsTo = array(
			'Deposito' => array(
				'className' => 'Deposito',
				'conditions' => '',
				'dependent' => true,
				'foreignKey'   => 'IdDepositoOrig'
			)
		);

		public $validate = array(
						'Fecha' => array(
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
						'IdDepositoOrig' => array(
				            'rule' => 'notEmpty',
							'message' => 'Completa el campo'
				        ),
		);
		
}
?>