<?php
class ControllerModuleUniverTabs extends Controller {
	private $error = array(); 
   private $val = array();

	private $_name = 'univer_tabs';
	public function index() {   
		$this->load->language('module/univer_tabs');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
		
			$this->model_setting_setting->editSetting('univer_tabs', $this->request->post);		

			
			if ($this->request->post['buttonForm'] == 'apply') {
				$this->redirect($this->url->link('module/' . $this->_name, 'token=' . $this->session->data['token'], 'SSL'));
			} else {
				$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
				$this->session->data['success'] = $this->language->get('text_success');
			}

		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');
		$this->data['text_apply'] = $this->language->get('text_apply');		
		
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_position'] = $this->language->get('entry_position');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_limit'] = $this->language->get('entry_limit');	

        $this->data['text_number'] = $this->language->get('text_number');		    	
		$this->data['add_tab'] = $this->language->get('add_tab');
		$this->data['tab_title'] = $this->language->get('tab_title');
		$this->data['choose_products'] = $this->language->get('choose_products');
		$this->data['special_products'] = $this->language->get('special_products');
		$this->data['latest_products'] = $this->language->get('latest_products');
		$this->data['popular_products'] = $this->language->get('popular_products');    		
		$this->data['bestseller_products'] = $this->language->get('bestseller_products');
		$this->data['choose_category'] = $this->language->get('choose_category');
		$this->data['view_tab'] = $this->language->get('view_tab');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['button_add_image'] = $this->language->get('button_add_image');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		if (isset($this->error['category'])) {
			$this->data['error_category'] = $this->error['category'];
		} else {
			$this->data['error_category'] = array();
		}
		if (isset($this->error['numproduct'])) {
			$this->data['error_numproduct'] = $this->error['numproduct'];
		} else {
			$this->data['error_numproduct'] = array();
		}
		if (isset($this->error['image'])) {
			$this->data['error_image'] = $this->error['image'];
		} else {
			$this->data['error_image'] = array();
		}
		
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/univer_tabs', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/univer_tabs', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['token'] = $this->session->data['token'];
		
		$this->data['modules'] = array();

		if (isset($this->request->post['univer_tabs_module'])) {
			$this->data['modules'] = $this->request->post['univer_tabs_module'];
		} elseif ($this->config->get('univer_tabs_module')) { 
			$this->data['modules'] = $this->config->get('univer_tabs_module');
		}					

		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->load->model('catalog/category');
		$this->data['categories'] = $this->model_catalog_category->getCategories(0);

		$this->load->model('localisation/language');
   	$languages = $this->model_localisation_language->getLanguages();
		$this->data['languages'] = $languages;

		$array_title = array();
		
		foreach($languages as $language){
			$array_title{$language['language_id']} = 'Enter the name';
		}

      $this->data['modules'][0] = array(
      'limit'         =>'6',
	  'v_limit'       =>'3',
	  'carousel'      =>'0',
      'image_width'   =>'248',
      'image_height'  =>'248',
      'layout_id'     =>'1',
      'position'      =>'content_top',
      'status'        =>'0',
      'sort_order'    =>'2',
      'tabs'          => 
         array(0 => 
            array(
            'title'        => $array_title, 
            'filter_type'  => 'specials',
            'filter_type_category'    => '25'
            )
         )
      );
		
		$this->template = 'module/univer_tabs.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);		
		$this->response->setOutput($this->render());
	}
	
	private function validate() {

		if (!$this->user->hasPermission('modify', 'module/univer_tabs')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		if (isset($this->request->post['univer_tabs_module'])) {
			foreach ($this->request->post['univer_tabs_module'] as $value_tab) {
   			foreach ($value_tab['tabs'] as $key => $value) {
   				if ($value['filter_type'] == 'category' && !isset($value['filter_type_category'])) {
   					$this->error['category'][$key] = $this->language->get('error_category');
   				}
				
            }
			}
		}
		if (isset($this->request->post['univer_tabs_module'])) {
			foreach ($this->request->post['univer_tabs_module'] as $key => $value) {
				if (!$value['limit']) {
					$this->error['numproduct'][$key] = $this->language->get('error_numproduct');
				}
				if (!$value['image_width'] || !$value['image_height']) {
					$this->error['image'][$key] = $this->language->get('error_image');
				}
			}
		}
				
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}

 }
?>