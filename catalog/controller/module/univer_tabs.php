<?php
class ControllerModuleUniverTabs extends Controller {
	protected function index($setting) {
		static $module = 0;
		$this->document->addScript('catalog/view/javascript/jquery/tabs.js');
		$this->data['button_cart'] = $this->language->get('button_cart');
		
		$this->load->model('catalog/product');
		$this->load->model('catalog/popular');
		$this->load->model('tool/image');
		$this->load->model('catalog/review');
		
		
		
		if (!empty($setting['carousel'])){
		$this->data['carousel'] = true;	
		}else{
		$this->data['carousel'] = false;		
		}
		
		if ($setting['v_limit']==''){
		$this->data['v_limit'] = 3;	
		}else{
		$this->data['v_limit'] = $setting['v_limit'];		
		}
		
    
		$this->data['tabs'] = array();
		
		$tabs = array();
//		$tabs = $this->config->get('univer_tabs_tab');
		$tabs = $setting['tabs'];
		if (isset($tabs)) {
			foreach ($tabs as $tab) {
				$results = array();

				if ($tab['filter_type'] == "special") {
					$data = array(
						'sort'  => 'pd.name',
						'order' => 'ASC',
						'start' => 0,
						'limit' => $setting['limit'],
					);
					$results = $this->model_catalog_product->getProductSpecials($data);
				}
				if ($tab['filter_type'] == "latest") {
					$results = $this->model_catalog_product->getLatestProducts($setting['limit']);
				}
				if ($tab['filter_type'] == "popular") {
					$results = $this->model_catalog_popular->getPopularProducts($setting['limit']);
				}
				if ($tab['filter_type'] == "bestseller") {
					$results = $this->model_catalog_product->getBestSellerProducts($setting['limit']);
        }
				if ($tab['filter_type'] == "category") {
					$data = array(
						'filter_category_id' => $tab['filter_type_category'],
						'sort'  => 'pd.name',
						'order' => 'ASC',
						'start' => 0,
						'limit' => $setting['limit'],
					);
					$results = $this->model_catalog_product->getProducts($data);
				}
				
				$products = array();
				
				foreach ($results as $result) {
					
				$results_img = $this->model_catalog_product->getProductImages($result['product_id']);
                $dop_img = array();
                foreach ($results_img as $result_img) {
                if ($result_img['image']) {
                $image_dop = $this->model_tool_image->resize($result_img['image'], $setting['image_width'], $setting['image_height']);
                } else {
                $image_dop = $this->model_tool_image->resize('no_image.jpg',  $setting['image_width'], $setting['image_height']);
                }
                 $dop_img[] = $image_dop;
                }
					
					
					if ($result['image']) {
						$image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);
					} else {
						$image = false;
					}

					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$price = false;
					}
							
					if ((float)$result['special']) { 
						$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$special = false;
					}
					
					if ($this->config->get('config_review_status')) {
						$rating = $result['rating'];
					} else {
						$rating = false;
					}
					$products[] = array(
						'product_id'   => $result['product_id'],
                        'model'        => $result['model'],
						'thumb'   	   => $image,
						'name'    	   => $result['name'],
						'price'   	   => $price,
						'special' 	   => $special,
						'saving'	 => round((($result['price'] - $result['special'])/($result['price'] + 0.01))*100, 0),
						'dop_img' => $dop_img,
		   	            'quickview'        => $this->url->link('product/quickview', 'product_id=' . $result['product_id']),
						'rating'       => $rating,
						'reviews'      => sprintf($this->language->get('text_reviews'), (int)$result['reviews']),
						'href'    	   => $this->url->link('product/product', 'product_id=' . $result['product_id']),  
					);
				}
				
				

				if (($tab['title'][$this->config->get('config_language_id')] =='') || ($tab['title'][$this->config->get('config_language_id')] =='Enter the name')){
					
					    if ($tab['filter_type'] == "special") {$title = 'Special';} 
					    if ($tab['filter_type'] == "latest") {$title = 'Latest';}
						if ($tab['filter_type'] == "popular") {$title = 'Most Viewed';}
						if ($tab['filter_type'] == "bestseller") {$title = 'Bestseller';}
					    if ($tab['filter_type'] == "category") {
							$category_name = $this->model_catalog_category->getCategory($tab['filter_type_category']);
			                if (isset($category_name['name'])) {
					        $title = $category_name['name'];
				             } else {
					         $title = false;
				           }}
							

					} else {
					$title = $tab['title'][$this->config->get('config_language_id')];	
					}
			
				$this->data['tabs'][] = array(
						'title'	 		 =>	$title,
						'products'   => $products
					);
			}
		}
		
		
		$this->data['module'] = $module++;
				
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/univer_tabs.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/univer_tabs.tpl';
		} else {
			$this->template = 'default/template/module/univer_tabs.tpl';
		}

		$this->render();
	}
}
?>