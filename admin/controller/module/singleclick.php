<?php
class ControllerModuleSingleclick extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->language->load('module/singleclick');
		
		
		$this->document->setTitle($this->language->get('heading_title'));
		
						
					
		$this->data['heading_title'] = $this->language->get('heading_title');
        $this->data['id'] = $this->language->get('id');
        $this->data['date'] = $this->language->get('date');
        $this->data['name'] = $this->language->get('name');
        $this->data['message'] = $this->language->get('message');
        $this->data['phone'] = $this->language->get('phone');
	
		
		$this->data['button_save'] = "Export";
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_delete'] = $this->language->get('button_delete');
		

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   				
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/singleclick', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		
		
		$this->data['action'] = $this->url->link('module/singleclick?export=1', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
		$this->getList();
	}
private function getList(){
		$this->load->model('module/singleclick');

		$results_total = $this->model_module_singleclick->getTotalhistory();
		$results = $this->model_module_singleclick->gethistory();
		if(!empty($results))
		{
			foreach($results as $result)
			{
				$this->data['history'][] = array(
					'id'    	  => $result['id'],
					'name'        => $result['name'],
					'phone'       => $result['phone'],
					'message'     => $result['message'],
					'date'        => $result['date']
				);
			}
		}
		
		
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		$this->data['delete'] = $this->url->link('module/singleclick/delete', 'token=' . $this->session->data['token'], 'SSL');

		$this->template = 'module/singleclick.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());

}

    public function install() {
        $this->load->model('module/singleclick');
        $this->model_module_singleclick->createTable();

        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('singleclick', array('singleclick_status'=>1));
    }


    public function uninstall() {
        $this->load->model('module/singleclick');
        $this->model_module_singleclick->deleteTable();

        $this->load->model('setting/setting');
        $this->model_setting_setting->editSetting('my_module', array('my_module_status'=>0));
    }
	
  	public function delete() {
		$this->language->load('module/singleclick');
		

    	$this->document->setTitle($this->language->get('heading_title'));
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			$this->load->model('module/singleclick');
			foreach ($this->request->post['selected'] as $id) {
				$this->model_module_singleclick->delete($id);
	  		}
			$this->session->data['success'] = $this->language->get('text_success');
			$this->redirect($this->url->link('module/singleclick', 'token=' . $this->session->data['token'], 'SSL'));
		}

    	$this->getList();
  	}
  	protected function validateDelete() {
    	if (!$this->user->hasPermission('modify', 'module/singleclick')) {
      		$this->error['warning'] = $this->language->get('error_permission');  
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}
	
	
}
?>