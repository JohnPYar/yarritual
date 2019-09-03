<?php  
class ControllerModulehtmlBox extends Controller {
	protected function index($setting) {
		
    	$this->data['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
    	
    	//print_r($setting);
    	
		$this->data['message'] = html_entity_decode($setting['description'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
		$this->data['title'] = html_entity_decode($setting['title'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
		if(isset($setting['show_title'])){
			$this->data['show_title'] = TRUE;		
		}
		else $this->data['show_title'] = FALSE;

		if(isset($setting['borderless'])){
			$this->data['borderless'] = TRUE;		
		}
		else $this->data['borderless'] = FALSE;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/htmlBox.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/htmlBox.tpl';
		} else {
			$this->template = 'default/template/module/htmlBox.tpl';
		}
		
		$this->render();
	}
}
?>