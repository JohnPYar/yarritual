<?php
class ControllerModuleunivermenucategory extends Controller {
	protected function index($setting) {
		static $numMod = 1; // blanc first template module
		$this->language->load('module/univermenucategory');

		$this->data['heading_latest'] = $this->language->get('heading_latest');
		$this->data['text_show'] = $this->language->get('text_show');
        $this->data['text_hide'] = $this->language->get('text_hide');

		$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/univermenucategory.css');
        $this->document->addScript('catalog/view/javascript/jquery/tabs.js');
		

		
		// tab
		
		$this->load->model('catalog/product');
		$this->load->model('tool/image');
		
		$this->data['tabs'] = array();
		
		$tabs = array();
		$tabs = $this->config->get('univermenucategory_tab');
		
		if (isset($tabs)) {
			foreach ($tabs as $tab) {
				
				$data = array(
					'filter_category_id' => $tab['category_id'],
					'sort'  => 'pd.name',
					'order' => 'ASC',
					'start' => 0,
				);
				
				
               if ($tab['image']) {
					$image = $this->model_tool_image->resize($tab['image'], $setting['image_category_width'], $setting['image_category_height']);
					$this->data['cat_width']   = $setting['image_category_width'] + 5;
					$this->data['cat_height']   = $setting['image_category_height'];
				} else {
					$image = false;
				}

				
			$catagory_name = $this->model_catalog_category->getCategory($tab['category_id']);
			if (isset($catagory_name['name'])) {
					$catagory_name['name'] = $catagory_name['name'];
				} else {
					$catagory_name['name'] = false;
				}
				
			$children_data = array();

			$children = $this->model_catalog_category->getCategories($tab['category_id']);


			foreach ($children as $child) {
				$data = array(
					'filter_category_id'  => $child['category_id'],
					'filter_sub_category' => true
				);
               

				$children_data[] = array(
					'category_id' => $child['category_id'],
					'name'        => $child['name'],
					'description' => utf8_substr(strip_tags(html_entity_decode($child['description'], ENT_QUOTES, 'UTF-8')), 0, 100),
					'href'        => $this->url->link('product/category', 'path=' . $tab['category_id'] . '_' . $child['category_id']),
					'children' => $this->getChildrenData($child['category_id'], $child['category_id']),	// rb, 2011-09-03: menu 3rd level	
				);		
			}
				
				$this->data['tabs'][] = array(
					'image' 		 => $image,
					'name'			 => $catagory_name['name'],
					'href'           => $this->url->link('product/category', 'path=' . $tab['category_id']),
					'title'	 		 =>	$tab['title'][$this->config->get('config_language_id')],
					'subcateg'	 	 =>	$tab['subcateg'],
					'column'	 	 =>	$tab['column'],
					'children'        => $children_data,
				);
			}
		}
		// end tab
		
		$this->data['module'] =  $numMod++;
				
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/univermenucategory.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/univermenucategory.tpl';
		} else {
			$this->template = 'default/template/module/univermenucategory.tpl';
		}

        $this->data['position'] = $setting['position'];
		$this->render();
	}
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
				'href'  => $this->url->link('product/category', 'path=' . $path_prefix . '_' . $child['category_id'])
			);
		}
		return $children_data;
	} 	
	
	
}
?>