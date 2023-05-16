<?php
class Ccc_Practice_11Controller extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        echo "<pre>";

        $message = Mage::getSingleton('core/session');
        $message->addSuccess('This is a success message.');
        $message->addNotice('This is a notice message.');
        $message->addError('This is an error message.');
        $message->addWarning('This is a warning message.');

        $messages = Mage::getSingleton('core/session')->getMessages();
        
        foreach ($messages->getItems() as $message){
            echo $message->getType().' => '.$message->getText()."\n";
        }

        $messages->clear();

    } 
}