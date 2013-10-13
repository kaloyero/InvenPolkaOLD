<?php
class Estilo extends AppModel {
        public $name = 'Estilo';

		var $hasOne = array(
        'Articulo' => array(
            'className'    => 'Articulo',
            'foreignKey'    => 'IdEstilo'
         ));
		
}
?>