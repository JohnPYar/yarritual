<?php

class ControllerInformationunivernews extends Controller {

	public function index() {
	
    	$this->language->load('information/univernews');
	
		$this->load->model('catalog/univernews');
		
	   $this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/news.css');
	   
		$this->data['breadcrumbs'] = array();
	
		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('common/home'),
			'text'      => $this->language->get('text_home'),
			'separator' => false
		);
	
		if (isset($this->request->get['univernews_id'])) {
			$univernews_id = $this->request->get['univernews_id'];
		} else {
			$univernews_id = 0;
		}
	
		$univernews_info = $this->model_catalog_univernews->getunivernewsStory($univernews_id);
	
		if ($univernews_info) {
	  	
			
		
			$this->data['breadcrumbs'][] = array(
				'href'      => $this->url->link('information/univernews'),
				'text'      => $this->language->get('heading_title'),
				'separator' => $this->language->get('text_separator')
			);
		
			$this->data['breadcrumbs'][] = array(
				'href'      => $this->url->link('information/univernews', 'univernews_id=' . $this->request->get['univernews_id']),
				'text'      => $univernews_info['title'],
				'separator' => $this->language->get('text_separator')
			);
			
			$this->document->setTitle($univernews_info['title']);
			$this->document->setDescription($univernews_info['meta_description']);
			$this->document->setKeywords($univernews_info['meta_keyword']);
			$this->document->addLink($this->url->link('information/univernews', 'univernews_id=' . $this->request->get['univernews_id']), 'canonical');
		
     		$this->data['univernews_info'] = $univernews_info;
		
     		$this->data['heading_title'] = $univernews_info['title'];
     		
			$this->data['description'] = html_entity_decode($univernews_info['description']);
			
     		$this->data['meta_keyword'] = html_entity_decode($univernews_info['meta_keyword']);
			
			$this->data['viewed'] = sprintf($this->language->get('text_viewed'), $univernews_info['viewed']);
		
			$this->data['addthis'] = $this->config->get('univernews_univernewspage_addthis');
		
			$this->data['min_height'] = $this->config->get('univernews_popup_height');
		
			$this->load->model('tool/image');
		
			if ($univernews_info['image']) { $this->data['image'] = TRUE; } else { $this->data['image'] = FALSE; }
		
			$this->data['thumb'] = $this->model_tool_image->resize($univernews_info['image'], $this->config->get('univernews_popup_width'), $this->config->get('univernews_popup_height'));
			$this->data['popup'] = $this->model_tool_image->resize($univernews_info['image'], $this->config->get('univernews_popup_width'), $this->config->get('univernews_popup_height'));
		
     		$this->data['button_news'] = $this->language->get('button_news');
			$this->data['button_continue'] = $this->language->get('button_continue');
		
			$this->data['univernews'] = $this->url->link('information/univernews');
			$this->data['continue'] = $this->url->link('common/home');
			
			if (isset($_SERVER['HTTP_REFERER'])) {
			$this->data['referred'] = $_SERVER['HTTP_REFERER'];
			}
 
			$this->data['refreshed'] = 'http://' . $_SERVER['HTTP_HOST'] . '' . $_SERVER['REQUEST_URI'];
			
			if (isset($this->data['referred'])) {
				$this->model_catalog_univernews->updateViewed($this->request->get['univernews_id']);
			}
		
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/univernews.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/information/univernews.tpl';
			} else {
				$this->template = 'default/template/information/univernews.tpl';
			}
		
			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
		
			$this->response->setOutput($this->render());
		
	  	} else {
		
		    	$url = '';
			
				if (isset($this->request->get['page'])) {
				$page = $this->request->get['page'];
				$url .= '&page=' . $this->request->get['page'];
				} else { 
				$page = 1;
				}
				
				$limit = $this->config->get('config_catalog_limit');
				$this->data['widthimg']			= $this->config->get('univernews_popup_width');
				$this->data['heightimg']		= $this->config->get('univernews_popup_height');
		
				$data = array(
				'page' => $page,
				'limit' => $limit,
				'start' => $limit * ($page - 1),
				);
		
				$total = $this->model_catalog_univernews->getTotalunivernews();
		
				$pagination = new Pagination();
				$pagination->total = $total;
				$pagination->page = $page;
				$pagination->limit = $limit;
				$pagination->text = $this->language->get('text_pagination');
				$pagination->url = $this->url->link('information/univernews', $url . '&page={page}', 'SSL');
		
				$this->data['pagination'] = $pagination->render();
		
	  		$univernews_data = $this->model_catalog_univernews->getunivernews($data);
		
	  		if ($univernews_data) {
			
				$this->document->setTitle($this->language->get('heading_title'));
			
				$this->data['breadcrumbs'][] = array(
					'href'      => $this->url->link('information/univernews'),
					'text'      => $this->language->get('heading_title'),
					'separator' => $this->language->get('text_separator')
				);
			
				$this->data['heading_title'] = $this->language->get('heading_title');
			
			
				$this->data['text_more'] = $this->language->get('text_more');
				$this->data['text_posted'] = $this->language->get('text_posted');
				
				$chars = $this->config->get('univernews_headline_chars');
				$this->load->model('tool/image');
			
				foreach ($univernews_data as $result) {
					$this->data['univernews_data'][] = array(
						'id'  				=> $result['univernews_id'],
						'title'        		=> $result['title'],
						'thumb'				=> $this->model_tool_image->resize($result['image'],$this->config->get('univernews_popup_width'), $this->config->get('univernews_popup_height')),
						'description'   	=> utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $chars),
						'href'         		=> $this->url->link('information/univernews', 'univernews_id=' . $result['univernews_id']),
						'posted'   		    => date($this->language->get('date_format_short'), strtotime($result['date_added']))
					);
				}
			
				$this->data['button_continue'] = $this->language->get('button_continue');
			
				$this->data['continue'] = $this->url->link('common/home');
			
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/univernews.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/information/univernews.tpl';
				} else {
					$this->template = 'default/template/information/univernews.tpl';
				}
			
				$this->children = array(
					'common/column_left',
					'common/column_right',
					'common/content_top',
					'common/content_bottom',
					'common/footer',
					'common/header'
				);
			
				$this->response->setOutput($this->render());
			
	    	} else {
			
		  		$this->document->setTitle($this->language->get('text_error'));
			
	     		$this->document->breadcrumbs[] = array(
	        		'href'      => $this->url->link('information/univernews'),
	        		'text'      => $this->language->get('text_error'),
	        		'separator' => $this->language->get('text_separator')
	     		);
			
				$this->data['heading_title'] = $this->language->get('text_error');
			
				$this->data['text_error'] = $this->language->get('text_error');
			
				$this->data['button_continue'] = $this->language->get('button_continue');
			
				$this->data['continue'] = $this->url->link('common/home');
			
				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
					$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
				} else {
					$this->template = 'default/template/error/not_found.tpl';
				}
			
				$this->children = array(
					'common/column_left',
					'common/column_right',
					'common/content_top',
					'common/content_bottom',
					'common/footer',
					'common/header'
				);
			
				$this->response->setOutput($this->render());
		  	}
		}
	}
}
?>
