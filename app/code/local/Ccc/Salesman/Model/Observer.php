<?php
class Ccc_Salesman_Model_Observer extends Varien_Event_Observer
{
   public function __construct()
   {
 
   }
   
   public function saveSalesmanObserve($observer)
   {
      $event = $observer->getEvent(); 	
      $model = $event->getModel();
      echo "<pre>";
   	print_r($model->getData());
      die('test');
   }
}