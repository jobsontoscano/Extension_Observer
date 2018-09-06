<?php 
	class Duit_Observer_Block_Observer{
		
		public function Logcustomss($observer){
			$customer = $observer->getCustomer();
			Mage::log($customer->getName() . "Teste do uso do events Observer", null, "customer.log");
		}
	}
?>