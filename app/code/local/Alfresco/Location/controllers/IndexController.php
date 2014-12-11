<?php
/**
 * Created by JetBrains PhpStorm.
 * User: KevinYank
 * Date: 7/18/13
 * Time: 9:08 PM
 * To change this template use File | Settings | File Templates.
 */
class Alfresco_Location_IndexController extends Mage_Core_Controller_Front_Action {


    public function indexAction() {
        $Controller = "Controller Called";

        $this->loadLayout();
        $block = $this->getLayout()->getBlock('locationview');
        $block->setData("message","Index Action in Controller has called! ");
        $this->renderLayout();
    }

}