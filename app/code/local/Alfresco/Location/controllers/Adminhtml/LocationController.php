<?php

class Alfresco_Location_Adminhtml_LocationController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout();
		return $this;
	}

    public function editAction() {
        $id     = $this->getRequest()->getParam('id');
        $model  = Mage::getModel('location/location')->load($id);

        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('location_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('location/location_items');

            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Location Manager'), Mage::helper('adminhtml')->__('location Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Location News'), Mage::helper('adminhtml')->__('location News'));

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this->_addContent($this->getLayout()->createBlock('location/adminhtml_location_edit'))
                ->_addLeft($this->getLayout()->createBlock('location/adminhtml_location_edit_tabs'));

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('location')->__('location does not exist'));
            $this->_redirect('*/*/');
        }
    }


	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}
    public function exportCsvAction()
    {
        $fileName   = 'location.csv';
        $content    = $this->getLayout()->createBlock('location/adminhtml_location_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'location.xml';
        $content    = $this->getLayout()->createBlock('location/adminhtml_location_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }

    public function newAction() {
        $this->_forward('edit');
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {

            $model = Mage::getModel('location/location');
            $data['content']=$data['_content'];
            $model->setData($data)
                ->setId($this->getRequest()->getParam('id'));

            try {
                if ($model->getCreatedTime == NULL || $model->getUpdateTime() == NULL) {
                    $model->setCreatedTime(now())
                        ->setUpdateTime(now());
                } else {

                    $model->setUpdateTime(now());
                }

                $model->save();



                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('location')->__('Location was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('location')->__('Unable to find Location to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction() {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('location/location');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Location was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }








}