<?php 
	class Duit_Observer_Model_Observer {
		
		public function logCustomer($observer) {
			$email = $observer->getRequest()->getParam('email');
			$html = "BRASIL VAI SER CAMPEAO -- Copa America";
			$mail = Mage::getModel('core/email');
			$mail->setToName("MUMA");
			$mail->setToEmail($email);
			$mail->setBody(utf8_decode($html));
	        $mail->setSubject('TESTANDO USO DE EVENTS -- OBSERVER - 2018.1 ');
	        $mail->setFromEmail('jobson@muma.com.br');
	        $mail->setFromName("Muma - T.I");
	        $mail->setType('html');
	        $mail->send();
		}
	}
?>