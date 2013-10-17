<?php
class Dimensione extends AppModel {
        public $name = 'Dimensione';

		public $validate = array(
		        'Nombre' => array(
		            'rule' => 'notEmpty'
		        ),
				'FechaFin' => array(
		            'rule' => 'notEmpty'
		        )
		    );
		
}
?>