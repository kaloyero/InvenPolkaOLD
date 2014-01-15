<?php
class Proyecto extends AppModel {
        public $name = 'Proyecto';

		public $validate = array(
			'Nombre' => array(
				'ruleName' => array(
					'rule' => 'notEmpty',
					'message' => 'El campo no puede estar vacio'
				),
/*				'ruleName2' => array(
					'rule' => 'alphaNumeric',
					'message' => 'Solo se puede ingresar letras y numeros'
				),*/
				'ruleName3' => array(
					'rule' => array('maxLength', '20'),
					'message' => 'Maximo 20 caracteres'
				),
			),
			'Descripcion' => array(
				'ruleName' => array(
					'rule' => 'notEmpty',
					'message' => 'El campo no puede estar vacio'
				),
/*				'ruleName2' => array(
					'rule' => 'alphaNumeric',
					'message' => 'Solo se puede ingresar letras y numeros'
				),*/
				'ruleName3' => array(
					'rule' => array('maxLength', '100'),
					'message' => 'Maximo 100 caracteres'
				)
			),
			'Director' => array(
				'ruleName' => array(
					'rule' => 'notEmpty',
					'message' => 'El campo no puede estar vacio'
				),
/*				'ruleName2' => array(
					'rule' => 'alphaNumeric',
					'message' => 'Solo se puede ingresar letras y numeros'
				),*/
				'ruleName3' => array(
					'rule' => array('maxLength', '50'),
					'message' => 'Maximo 50 caracteres'
				),
			),
			'FechaIni' => array(
				'ruleName' => array(
					'rule' => 'notEmpty',
					'message' => 'El campo no puede estar vacio'
				)
			)
		);

}
?>