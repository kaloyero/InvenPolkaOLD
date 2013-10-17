<?php
class Ubicacione extends AppModel {
        public $name = 'Ubicacione';
		public $validate = array(
		        'CodigoUbicacion' => array(
		            'rule' => 'notEmpty'
		        ),
		        'Descripcion' => array(
		            'rule' => 'notEmpty'
		        ),
				'FechaFin' => array(
		            'rule' => 'notEmpty'
		        ),
				'IdDeposito' => array(
			            'rule' => 'notEmpty'
			      )
		    );

}
?>