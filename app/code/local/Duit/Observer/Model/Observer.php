<?php 
	class Duit_Observer_Model_Observer{
		public function observerCoupon(Varien_Event_Observer $object) {
		 $order = $object->getEvent()->getOrder();
		 $status = $order->getStatus();
		 $customer_email = $order->getCustomerEmail();
		 $firstname = $order->getCustomerFirstname();
			

		 // if($status && $status == 'holded'){
			 $groupIds = Mage::getModel('customer/group')->getCollection()->getAllIds();
		     $websiteIds = Mage::getModel('core/website')->getCollection()->getAllIds();
		     $gerando_cupom = Mage::helper('core')->getRandomString(8);
		     $data = array(
		     'product_ids' => null,
		     'name' => 'AUTO GENERATED COUPOM - ' . date('YmdHis'),
		     'description' => 'This rule was generated automatically by Tiago Sampaio.',
		     'is_active' => 1,
		     'website_ids' => $websiteIds,
		     'customer_group_ids' => $groupIds,
		     'coupon_type' => Mage_SalesRule_Model_Rule::COUPON_TYPE_SPECIFIC,
		     'coupon_code' => $gerando_cupom,
		     'uses_per_coupon' => 1,
		     'uses_per_customer' => 1,
		     'from_date' => Mage::getModel('core/date')->date('d/m/Y'),
		     'to_date' => Mage::getModel('core/date')->date('d/m/Y'),
		     'sort_order' => null,
		     'is_rss' => 1,
		     'rule' => array(
		     'conditions' => array(
		     array(
		     'type' => 'salesrule/rule_condition_combine',
		     'aggregator' => 'all',
		     'value' => 1,
		     'new_child' => null
		     )
		     )
		     ),
		     'simple_action' => Mage_SalesRule_Model_Rule::CART_FIXED_ACTION,
		     'discount_amount' => '200',
		     'discount_qty' => 0,
		     'discount_step' => null,
		     'apply_to_shipping' => 0,
		     'simple_free_shipping' => 0,
		     'stop_rules_processing' => 0,
		     'rule' => array(
		     'actions' => array(
		     array(
		     'type' => 'salesrule/rule_condition_product_combine',
		     'aggregator' => 'all',
		     'value' => 1,
		     'new_child' => null
		     )
		     )
		     ),
		     'store_labels' => array('Premium Discount'),
		     );
		     
		     $rule = Mage::getModel('salesrule/rule');
		     // $data = $this->_filterDates($data, array('from_date', 'to_date'));
		     // $validateResult = $rule->validateData(new Varien_Object($data));
		     
		     // if ($validateResult == true) {
		     // if (isset($data['simple_action']) && $data['simple_action'] == 'by_percent'
		     // && isset($data['discount_amount'])) {
		     // $data['discount_amount'] = min(100, $data['discount_amount']);
		     // }
		     // if (isset($data['rule']['conditions'])) {
		     // $data['conditions'] = $data['rule']['conditions'];
		     // }
		     // if (isset($data['rule']['actions'])) {
		     // $data['actions'] = $data['rule']['actions'];
		     // }
		     // unset($data['rule']);
		     $rule->loadPost($data);
		     $rule->save();
		     $html = "Bom dia Sr(a).".$firstname.", Diante mão, a muma vem agradecendo por sua escolha ser nossa loja para realizar sua compra. Portanto, venho aqui lhe entregar um cupom do valor de R$100,00. CUPOM #".$gerando_cupom;
				$mail = Mage::getModel('core/email');
				$mail->setToName("MUMA");
				$mail->setToEmail($customer_email);
				$mail->setBody(utf8_decode($html));
		        $mail->setSubject('TESTANDO USO DE EVENTS -- OBSERVER - 2018.1 ');
		        $mail->setFromEmail('jobson@muma.com.br');
		        $mail->setFromName("Muma - T.I");
		        $mail->setType('html');
		        $mail->send();

		 // }
	 	return $rule;
	}
}
?>