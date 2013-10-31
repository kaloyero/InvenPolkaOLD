<?php
class Deposito extends AppModel {
        public $name = 'Deposito';
		public $validate = array(
		        'Nombre' => array(
		            'rule' => 'notEmpty'
		        )
		    );

}
?>