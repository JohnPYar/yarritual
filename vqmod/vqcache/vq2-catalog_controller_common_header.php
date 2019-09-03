<?php   
class ControllerCommonHeader extends Controller {

			//  menu 3rd level
	private function getChildrenData( $ctg_id, $path_prefix )
	{
		$children_data = array();
		$children = $this->model_catalog_category->getCategories($ctg_id);

		foreach ($children as $child) {
			$data = array(
				'filter_category_id'  => $child['category_id'],
				'filter_sub_category' => true
			);

			$product_total = $this->model_catalog_product->getTotalProducts($data);

			$children_data[] = array(
				'name'  => $child['name'] .($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
				'href'  => $this->url->link('product/category', 'path=' . $path_prefix . '_' . $child['category_id']),
			);
		}
		return $children_data;
	} 	 	
			
			
	protected function index() {
		$this->data['title'] = $this->document->getTitle();
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$this->data['base'] = $this->config->get('config_ssl');
		} else {
			$this->data['base'] = $this->config->get('config_url');
		}
		
		$this->data['action'] = $this->url->link('information/contact');
		$this->data['store'] = $this->config->get('config_name');
    	$this->data['address'] = nl2br($this->config->get('config_address'));
    	$this->data['telephone'] = $this->config->get('config_telephone');
    	$this->data['fax'] = $this->config->get('config_fax');
		
		$this->data['description'] = $this->document->getDescription();
		$this->data['keywords'] = $this->document->getKeywords();
		$this->data['links'] = $this->document->getLinks();	 
		$this->data['styles'] = $this->document->getStyles();
		$this->data['scripts'] = $this->document->getScripts();
		$this->data['lang'] = $this->language->get('code');
		$this->data['direction'] = $this->language->get('direction');
		$this->data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');

		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');
	
			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];	
			} else {
				$ip = ''; 
			}
			
			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];	
			} else {
				$url = '';
			}
			
			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];	
			} else {
				$referer = '';
			}
						
			$this->model_tool_online->whosonline($ip, $this->customer->getId(), $url, $referer);
		}
				
		$this->language->load('common/header');
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = HTTPS_IMAGE;
		} else {
			$server = HTTP_IMAGE;
		}	
				
		if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->data['icon'] = $server . $this->config->get('config_icon');
		} else {
			$this->data['icon'] = '';
		}
		
		$this->data['name'] = $this->config->get('config_name');
				
		if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo'))) {
			$this->data['logo'] = $server . $this->config->get('config_logo');
		} else {
			$this->data['logo'] = '';
		}
		
		$this->data['text_home'] = $this->language->get('text_home');
		$this->data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$this->data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
    	$this->data['text_search'] = $this->language->get('text_search');
		$this->data['text_welcome'] = sprintf($this->language->get('text_welcome'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
		$this->data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName(), $this->url->link('account/logout', '', 'SSL'));
		$this->data['text_account'] = $this->language->get('text_account');
    	$this->data['text_checkout'] = $this->language->get('text_checkout');
				
		$this->data['home'] = $this->url->link('common/home');
		$this->data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$this->data['logged'] = $this->customer->isLogged();
		$this->data['account'] = $this->url->link('account/account', '', 'SSL');
		$this->data['shopping_cart'] = $this->url->link('checkout/cart');
		$this->data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		
		if (isset($this->request->get['filter_name'])) {
			$this->data['filter_name'] = $this->request->get['filter_name'];
		} else {
			$this->data['filter_name'] = '';
		}
		
		// Menu
		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}

		$this->load->model('catalog/category');
		
		$this->load->model('catalog/product');
		
		$this->data['categories'] = array();
					
		$categories = $this->model_catalog_category->getCategories(0);
		
		foreach ($categories as $category) {
			if ($category['top']) {
				$children_data = array();
				
				$children = $this->model_catalog_category->getCategories($category['category_id']);
				
				foreach ($children as $child) {
					$data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);
					
					$product_total = $this->model_catalog_product->getTotalProducts($data);
									
					$children_data[] = array(
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),

			'children' => $this->getChildrenData($child['category_id'], $category['category_id']),
			'img'      => $this->model_tool_image->resize($child['image'], 40,40),	// menu 3rd level	
			
			
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])	
					);						
				}
				
				// Level 1
				$this->data['categories'][] = array(
					'name'     => $category['name'],

			'img'      => $this->model_tool_image->resize($category['image'], 100,100),
			'img2'      => $this->model_tool_image->resize($category['image'], 250,250),
			'description' => utf8_substr(strip_tags(html_entity_decode($category['description'], ENT_QUOTES, 'UTF-8')), 0, 100),
			
			
					'children' => $children_data,
					'active'   => in_array($category['category_id'], $parts),
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}
		
		$this->children = array(
			'module/language',
			'module/currency',
			'module/cart'
		);
				
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/header.tpl';
		} else {
			$this->template = 'default/template/common/header.tpl';
		}
		

			$this->language->load('account/login');
          $this->data['text_forgotten'] = $this->language->get('text_forgotten');
          $this->data['text_register'] = $this->language->get('text_register');
          $this->data['entry_email'] = $this->language->get('entry_email');
          $this->data['entry_password'] = $this->language->get('entry_password');
          $this->data['button_continue'] = $this->language->get('button_continue');
          $this->data['button_login'] = $this->language->get('button_login');
		  
			$this->load->model('account/customer');
	    	$this->data['action'] = $this->url->link('account/login', '', 'SSL');
		    $this->data['register'] = $this->url->link('account/register', '', 'SSL');
		    $this->data['forgotten'] = $this->url->link('account/forgotten', '', 'SSL');
			$this->data['order'] = $this->url->link('account/order', '', 'SSL');
			
			$this->data['address'] = nl2br($this->config->get('config_address'));
    	    $this->data['telephone'] = $this->config->get('config_telephone');
    	    $this->data['fax'] = $this->config->get('config_fax');
			$this->data['email'] = $this->config->get('config_email');
			$this->data['contact'] = $this->url->link('information/contact');
			
			$this->data['special'] = $this->url->link('product/special');
			
			$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$this->data['href_manufacturer'] = $this->url->link('product/manufacturer');
			$data = array();
			$this->load->model('catalog/manufacturer');
			
		$this->data['brands'] = array();
        $brandresults = $this->model_catalog_manufacturer->getManufacturers();
        foreach ($brandresults as $brandresult) {
			if (is_numeric(utf8_substr($brandresult['name'], 0, 1))) {
				$key = '0 - 9';
			} else {
				$key = utf8_substr(utf8_strtoupper($brandresult['name']), 0, 1);
			}

			if (!isset($this->data['manufacturers'][$key])) {
				$this->data['brands'][$key]['name'] = $key;
			}

			$this->data['brands'][$key]['manufacturer'][] = array(
				'name' => $brandresult['name'],
				'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $brandresult['manufacturer_id'])
			);
		}
		
			$this->data['compare'] = $this->url->link('product/compare');
            $this->language->load('product/compare');
            $this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			
			
    	$this->render();
	} 	
}
?>