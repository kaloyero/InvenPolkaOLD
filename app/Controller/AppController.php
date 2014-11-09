<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package                app.Controller
 * @link                http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

        function beforeFilter(){
			$Email = new CakeEmail();

			//$Email->emailFormat('html');
					//	$Email->template('tempemail');
					//	$Email->viewVars(array('dire' =>'www.ole.com.ar'));
					//	$Email->from(array('me@example.com' => 'My Site'));
					//	$Email->to('alexisq4a@yahoo.com.ar');
					//	$Email->subject('About');
			//$Email->helpers('Html');
						//$Email->attachments=array(TMP.'Recibo3.pdf');
						//$Email->send();

			//$to      = 'alexisq4a@yahoo.com.ar';
			//$subject = 'the subject';
			//$message = 'hello';
			//$headers = 'From: webmaster@example.com' . "\r\n" .
			//    'Reply-To: webmaster@example.com' . "\r\n" .
			//    'X-Mailer: PHP/' . phpversion();

			//mail($to, $subject, $message, $headers);

           if ($this->params['controller']!="pages" && $this->action!="generateComanda" && $this->action!="createComanda" && $this->action!="reciboPdf" ){
                                if (!$this->request->is('ajax')&& $this->params['controller']!="ayudas"){

                                        $this->redirect(array('controller' => 'pages', 'action' => 'display'));
                                }else{
                                        $this->layout = 'empty';
                                }
                        }
        }
        function addRedirect($view) {
                if ($this->request->data[$view]['guardaryseguir'] == '1'){
                        $this->redirect(array('action' => 'add?check=1'));
                } else {
                        $this->redirect(array('action' => 'index'));
                }
        }

        function getUsuario() {
			return $this->Session->read("usuario");
        }

}