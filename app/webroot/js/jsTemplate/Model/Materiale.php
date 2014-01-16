<?php
class Materiale extends AppModel {
        public $name = 'Materiale';

		public $validate = array(
			'Nombre' => array(
				'ruleName' => array(
					'rule' => 'notEmpty',
					'message' => 'El campo no puede estar vacio'
				),
				'ruleName3' => array(
					'rule' => array('maxLength', '50'),
					'message' => 'Maximo 50 caracteres'
				),
			),
		);		
}
?>