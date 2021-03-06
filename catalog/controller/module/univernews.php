<?php
class ControllerModuleunivernews extends Controller {

	private $_name = 'univernews';

	protected function index($setting) {
		static $module = 0;
	
		$this->language->load('module/' . $this->_name);
	     $this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/news.css');
      	$this->data['heading_title'] = $this->language->get('heading_title');
	
		$this->load->model('localisation/language');
	
		$languages = $this->model_localisation_language->getLanguages();
	
		$this->data['customtitle'] = $this->config->get($this->_name . '_customtitle' . $this->config->get('config_language_id'));
		$this->data['header'] = $this->config->get($this->_name . '_header');
	
		if (!$this->data['customtitle']) { $this->data['customtitle'] = $this->data['heading_title']; } 
		if (!$this->data['header']) { $this->data['customtitle'] = ''; }
	
		$this->data['icon'] = $this->config->get($this->_name . '_icon');
		$this->data['box'] = $this->config->get($this->_name . '_box');
	
		
	
		$this->load->model('catalog/univernews');
		
	    $this->data['text_empty'] = $this->language->get('text_empty');
		$this->data['text_more'] = $this->language->get('text_more');
		$this->data['text_posted'] = $this->language->get('text_posted');
	
		$this->data['show_headline'] = $this->config->get($this->_name . '_headline_module');
	
		$this->data['univernews_count'] = $this->model_catalog_univernews->getTotalunivernews();
		
		$this->data['univernews_limit'] = $setting['limit'];
	
		if ($this->data['univernews_count'] > $this->data['univernews_limit']) { $this->data['showbutton'] = true; } else { $this->data['showbutton'] = false; }
	
		$this->data['buttonlist'] = $this->language->get('buttonlist');
	
		$this->data['univernewslist'] = $this->url->link('information/univernews');
		
		$this->data['numchars'] = $setting['numchars'];

		$this->data['pos_img']  = $setting['pos_img'];
		$this->data['pos_line']  = $setting['pos_line'];
		
		if (($this->data['numchars'] !=='') && (isset($this->data['numchars']))) { $chars = $this->data['numchars']; } else { $chars = 100; }
		if (isset($setting['headline'])) {
			$this->data['headline'] = true;
		} else {
			$this->data['headline'] = false;
		}
		if ($setting['pos_img']) {
			$this->data['pos_img'] = true;
		} else {
			$this->data['pos_img'] = false;
		}
		if ($setting['pos_line']) {
			$this->data['pos_line'] = true;
		} else {
			$this->data['pos_line'] = false;
		}
		
		$this->data['univernews'] = array();
	
		$results = $this->model_catalog_univernews->getunivernewsShorts($setting['limit']);
		
		$this->load->model('tool/image');
	
		foreach ($results as $result) {
			
			if ($result['image']) {
 			$image = $this->model_tool_image->resize($result['image'], $this->config->get('univernews_thumb_width'), $this->config->get('univernews_thumb_height'));
 			} else {
 			$image = FALSE;
 			}
			
			$this->data['univernews'][] = array(
				'title'        		=> $result['title'],
				'description'  		=> utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $chars),
				'href'         		=> $this->url->link('information/univernews', 'univernews_id=' . $result['univernews_id']),
				'thumb' 			=> $image,
				'posted'   			=> date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}
	
		$this->data['module'] = $module++; 
	
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/' . $this->_name . '.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/' . $this->_name . '.tpl';
		} else {
			$this->template = 'default/template/module/' . $this->_name . '.tpl';
		}
	
		$this->render();
	}
}
?>
