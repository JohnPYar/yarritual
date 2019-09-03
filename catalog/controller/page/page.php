<?php
class ControllerPagePage extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('page/page');

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
			'separator' => false
		);

		$this->load->model('catalog/article');

		if (isset($this->request->get['article_id'])) {
			$path = '';

			foreach (explode('_', $this->request->get['article_id']) as $path_id) {
				if (!$path) {
					$path = $path_id;
				} else {
					$path .= '_' . $path_id;
				}

				$article_info = $this->model_catalog_article->getArticle($path_id);

				if ($article_info) {
					$this->data['breadcrumbs'][] = array(
						'text'      => $article_info['name'],
						'href'      => $this->url->link('page/article', 'article_id=' . $path),
						'separator' => $this->language->get('text_separator')
					);
				}
			}
		}
		else
		{
         $path = '';
		}
/*
		$this->load->model('catalog/manufacturer');

		if (isset($this->request->get['manufacturer_id'])) {
			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_brand'),
				'href'      => $this->url->link('page/manufacturer'),
				'separator' => $this->language->get('text_separator')
			);

			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($this->request->get['manufacturer_id']);

			if ($manufacturer_info) {
				$this->data['breadcrumbs'][] = array(
					'text'	    => $manufacturer_info['name'],
					'href'	    => $this->url->link('page/manufacturer/page', 'manufacturer_id=' . $this->request->get['manufacturer_id']),
					'separator' => $this->language->get('text_separator')
				);
			}
		}
         */
		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_tag'])) {
			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . $this->request->get['filter_name'];
			}

			if (isset($this->request->get['filter_tag'])) {
				$url .= '&filter_tag=' . $this->request->get['filter_tag'];
			}

			if (isset($this->request->get['filter_description'])) {
				$url .= '&filter_description=' . $this->request->get['filter_description'];
			}

			if (isset($this->request->get['filter_article_id'])) {
				$url .= '&filter_article_id=' . $this->request->get['filter_article_id'];
			}

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_search'),
				'href'      => $this->url->link('page/search', $url),
				'separator' => $this->language->get('text_separator')
			);
		}

		if (isset($this->request->get['page_id'])) {
			$page_id = $this->request->get['page_id'];
		} else {
			$page_id = 0;
		}

		$this->load->model('catalog/page');

		$page_info = $this->model_catalog_page->getPage($page_id);

		$this->data['page_info'] = $page_info;

		if ($page_info) {
			$url = '';

			if (isset($this->request->get['article_id'])) {
				$url .= '&article_id=' . $this->request->get['article_id'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . $this->request->get['filter_name'];
			}

			if (isset($this->request->get['filter_tag'])) {
				$url .= '&filter_tag=' . $this->request->get['filter_tag'];
			}

			if (isset($this->request->get['filter_description'])) {
				$url .= '&filter_description=' . $this->request->get['filter_description'];
			}

			if (isset($this->request->get['filter_article_id'])) {
				$url .= '&filter_article_id=' . $this->request->get['filter_article_id'];
			}

			$this->data['breadcrumbs'][] = array(
				'text'      => $page_info['name'],
				'href'      => $this->url->link('page/page', $url . '&page_id=' . $this->request->get['page_id']),
				'separator' => $this->language->get('text_separator')
			);

			$this->document->setTitle($page_info['name']);
			$this->document->setDescription($page_info['meta_description']);
			$this->document->setKeywords($page_info['meta_keyword']);
			$this->document->addLink($this->url->link('page/page', 'page_id=' . $this->request->get['page_id']), 'canonical');

			$this->data['heading_title'] = $page_info['name'];


			$this->data['text_select'] = $this->language->get('text_select');
			$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$this->data['text_model'] = $this->language->get('text_model');
			$this->data['text_reward'] = $this->language->get('text_reward');
			$this->data['text_points'] = $this->language->get('text_points');
			$this->data['text_discount'] = $this->language->get('text_discount');
			$this->data['text_stock'] = $this->language->get('text_stock');
			$this->data['text_price'] = $this->language->get('text_price');
			$this->data['text_tax'] = $this->language->get('text_tax');
			$this->data['text_discount'] = $this->language->get('text_discount');
			$this->data['text_option'] = $this->language->get('text_option');
			$this->data['text_qty'] = $this->language->get('text_qty');
			$this->data['text_minimum'] = sprintf($this->language->get('text_minimum'), $page_info['minimum']);
			$this->data['text_or'] = $this->language->get('text_or');
			$this->data['text_write'] = $this->language->get('text_write');
			$this->data['text_note'] = $this->language->get('text_note');
			$this->data['text_share'] = $this->language->get('text_share');
			$this->data['text_wait'] = $this->language->get('text_wait');
			$this->data['text_tags'] = $this->language->get('text_tags');

			$this->data['text_viewed'] = $this->language->get('text_viewed');

			$this->data['entry_name'] = $this->language->get('entry_name');
			$this->data['entry_commentpage'] = $this->language->get('entry_commentpage');
			$this->data['entry_rating'] = $this->language->get('entry_rating');
			$this->data['entry_good'] = $this->language->get('entry_good');
			$this->data['entry_bad'] = $this->language->get('entry_bad');
			$this->data['entry_captcha'] = $this->language->get('entry_captcha');

			$this->data['button_cart'] = $this->language->get('button_cart');
			$this->data['button_wishlist'] = $this->language->get('button_wishlist');
			$this->data['button_compare'] = $this->language->get('button_compare');
			$this->data['button_upload'] = $this->language->get('button_upload');
			$this->data['button_continue'] = $this->language->get('button_continue');

			$this->load->model('catalog/commentpage');

			$this->data['tab_description'] = $this->language->get('tab_description');
			$this->data['tab_attribute'] = $this->language->get('tab_attribute');
			$this->data['tab_advertising'] = $this->language->get('tab_advertising');

            $this->data['commentpage_count']=$this->model_catalog_commentpage->getTotalCommentpagesByPageId($this->request->get['page_id']);
			$this->data['tab_commentpage'] = $this->language->get('tab_commentpage');

			$this->data['tab_images'] =$this->language->get('tab_images');
			$this->data['tab_related'] = $this->language->get('tab_related');

			$this->data['page_id'] = $this->request->get['page_id'];
			$this->data['manufacturer'] = $page_info['manufacturer'];
			$this->data['manufacturers'] = $this->url->link('page/manufacturer/page', 'manufacturer_id=' . $page_info['manufacturer_id']);
			$this->data['model'] = $page_info['model'];
			$this->data['reward'] = $page_info['reward'];
			$this->data['points'] = $page_info['points'];

			if ($page_info['quantity'] <= 0) {
				$this->data['stock'] = $page_info['stock_status'];
			} elseif ($this->config->get('config_stock_display')) {
				$this->data['stock'] = $page_info['quantity'];
			} else {
				$this->data['stock'] = $this->language->get('text_instock');
			}

			$this->load->model('tool/image');

			if ($page_info['image']) {
				$this->data['popup'] = $this->model_tool_image->resize($page_info['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
			} else {
				$this->data['popup'] = '';
			}

			if ($page_info['image']) {
				$this->data['thumb'] = $this->model_tool_image->resize($page_info['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
			} else {
				$this->data['thumb'] = '';
			}

			$this->data['images'] = array();

			$results = $this->model_catalog_page->getPageImages($this->request->get['page_id']);

			foreach ($results as $result) {
				$this->data['images'][] = array(
					'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
					'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
				);
			}

			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$this->data['price'] = $this->currency->format($this->tax->calculate($page_info['price'], $page_info['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$this->data['price'] = false;
			}

			if ((float)$page_info['special']) {
				$this->data['special'] = $this->currency->format($this->tax->calculate($page_info['special'], $page_info['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$this->data['special'] = false;
			}

			if ($this->config->get('config_tax')) {
				$this->data['tax'] = $this->currency->format((float)$page_info['special'] ? $page_info['special'] : $page_info['price']);
			} else {
				$this->data['tax'] = false;
			}

			/*
			$discounts = $this->model_catalog_page->getPageDiscounts($this->request->get['page_id']);

			$this->data['discounts'] = array();

			foreach ($discounts as $discount) {
				$this->data['discounts'][] = array(
					'quantity' => $discount['quantity'],
					'price'    => $this->currency->format($this->tax->calculate($discount['price'], $page_info['tax_class_id'], $this->config->get('config_tax')))
				);
			}
            */
			$this->data['options'] = array();

			foreach ($this->model_catalog_page->getPageOptions($this->request->get['page_id']) as $option) {
				if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') {
					$option_value_data = array();

					foreach ($option['option_value'] as $option_value) {
						if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
							$option_value_data[] = array(
								'page_option_value_id' => $option_value['page_option_value_id'],
								'option_value_id'         => $option_value['option_value_id'],
								'name'                    => $option_value['name'],
								'image'                   => $this->model_tool_image->resize($option_value['image'], 50, 50),
								'price'                   => (float)$option_value['price'] ? $this->currency->format($this->tax->calculate($option_value['price'], $page_info['tax_class_id'], $this->config->get('config_tax'))) : false,
								'price_prefix'            => $option_value['price_prefix']
							);
						}
					}

					$this->data['options'][] = array(
						'page_option_id' => $option['page_option_id'],
						'option_id'         => $option['option_id'],
						'name'              => $option['name'],
						'type'              => $option['type'],
						'option_value'      => $option_value_data,
						'required'          => $option['required']
					);
				} elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
					$this->data['options'][] = array(
						'page_option_id' => $option['page_option_id'],
						'option_id'         => $option['option_id'],
						'name'              => $option['name'],
						'type'              => $option['type'],
						'option_value'      => $option['option_value'],
						'required'          => $option['required']
					);
				}
			}

			if ($page_info['minimum']) {
				$this->data['minimum'] = $page_info['minimum'];
			} else {
				$this->data['minimum'] = 1;
			}



			$this->data['text_commentpages'] = sprintf($this->language->get('text_commentpages'), (int)$page_info['commentpages']);
			$this->data['commentpages'] =  (int)$page_info['commentpages'];
			$this->data['commentpage_status'] = $page_info['commentpage_status'];

			if ($this->customer->isLogged())
			{
			$this->data['text_login'] = $this->customer->getFirstName();
			$this->data['captcha_status']=false;
			}
			else
			{
			  $this->data['text_login'] = $this->language->get('text_anonymus');
			  $this->data['captcha_status']=true;
			}

			$this->data['viewed'] = $page_info['viewed'];
            $this->data['date_added'] = $page_info['date_added'];


			$this->data['rating'] = (int)$page_info['rating'];
			$this->data['description'] = html_entity_decode($page_info['description'], ENT_QUOTES, 'UTF-8');
			$this->data['attribute_groups'] = $this->model_catalog_page->getPageAttributes($this->request->get['page_id']);

			$this->data['pages'] = array();

			$results = $this->model_catalog_page->getPageRelated($this->request->get['page_id']);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
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


				if ($result['commentpage_status']) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}



				$this->data['pages'][] = array(
					'page_id' =>  $result['page_id'],
					'thumb'   	 => $image,
					'name'    	 => $result['name'],
					'viewed'   	 => $result['viewed'],
					'rating'     => $rating,
					'commentpage_status' =>$result['commentpage_status'],
					'commentpages'    => sprintf($this->language->get('text_commentpages'), (int)$result['commentpages']),
					'href'    	 => $this->url->link('page/page', 'article_id=' . $path.'&page_id=' . $result['page_id']),
				);
			}

			$this->data['tags'] = array();

			$results = $this->model_catalog_page->getPageTags($this->request->get['page_id']);

			foreach ($results as $result) {
				$this->data['tags'][] = array(
					'tag'  => $result['tag'],
					'href' => $this->url->link('page/search', 'filter_tag=' . $result['tag'])
				);
			}

			$this->model_catalog_page->updateViewed($this->request->get['page_id']);

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/page/page.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/page/page.tpl';
			} else {
				$this->template = 'default/template/page/page.tpl';
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

			if (isset($this->request->get['article_id'])) {
				$url .= '&article_id=' . $this->request->get['article_id'];
			}

			if (isset($this->request->get['manufacturer_id'])) {
				$url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
			}

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . $this->request->get['filter_name'];
			}

			if (isset($this->request->get['filter_tag'])) {
				$url .= '&filter_tag=' . $this->request->get['filter_tag'];
			}

			if (isset($this->request->get['filter_description'])) {
				$url .= '&filter_description=' . $this->request->get['filter_description'];
			}

			if (isset($this->request->get['filter_article_id'])) {
				$url .= '&filter_article_id=' . $this->request->get['filter_article_id'];
			}

      		$this->data['breadcrumbs'][] = array(
        		'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('page/page', $url . '&page_id=' . $page_id),
        		'separator' => $this->language->get('text_separator')
      		);

      		$this->document->setTitle($this->language->get('text_error'));

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

	public function commentpage() {
    	$this->language->load('page/page');

		$this->load->model('catalog/commentpage');

		$this->data['text_no_commentpages'] = $this->language->get('text_no_commentpages');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$this->data['commentpages'] = array();

		$commentpage_total = $this->model_catalog_commentpage->getTotalCommentpagesByPageId($this->request->get['page_id']);

		$results = $this->model_catalog_commentpage->getCommentpagesByPageId($this->request->get['page_id'], ($page - 1) * 5, 5);

		foreach ($results as $result) {
        	$this->data['commentpages'][] = array(
        		'author'     => $result['author'],
				'text'       => strip_tags($result['text']),
				'rating'     => (int)$result['rating'],
        		'commentpages'    => sprintf($this->language->get('text_commentpages'), (int)$commentpage_total),
        		'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
        	);
      	}

		$pagination = new Pagination();
		$pagination->total = $commentpage_total;
		$pagination->page = $page;
		$pagination->limit = 5;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('page/page/commentpage', 'page_id=' . $this->request->get['page_id'] . '&page={page}');

		$this->data['pagination'] = $pagination->render();

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/page/commentpage.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/page/commentpage.tpl';
		} else {
			$this->template = 'default/template/page/commentpage.tpl';
		}

		$this->response->setOutput($this->render());
	}

	public function write() {
		$json = array();

		$this->language->load('page/page');

		$this->load->model('catalog/page');

		if (isset($this->request->get['page_id'])) {
			$page_id = $this->request->get['page_id'];
		} else {
			$page_id = 0;
		}

		if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
				} else {
					$sort = 'p.sort_order';
				}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_catalog_limit');
		}

		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
			$captcha_status=false;
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
			$captcha_status=true;
		}


         $page_article = $this->model_catalog_page->getPageCategories($page_id);

 		if (isset($page_article) && count($page_article)>0 )
		{
			foreach ($page_article as $k => $article_id)
			{

			$data = array(
				'filter_article_id' 	 => $article_id,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);

		 $cache = md5(http_build_query($data));

         $key='page.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$customer_group_id . '.' . $cache;

         $this->cache->delete($key);


		}


		}












		$page_info = $this->model_catalog_page->getPage($page_id);

        $this->data['commentpage_status'] = $page_info['commentpage_status'];
        $this->data['commentpage_status_reg'] = $page_info['commentpage_status_reg'];

        $this->request->post['status']= $page_info['commentpage_status_now'];

		$this->load->model('catalog/commentpage');





		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
			$json['error'] = $this->language->get('error_name');
		}

		if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
			$json['error'] = $this->language->get('error_text');
		}

		if (!$this->request->post['rating']) {
			$json['error'] = $this->language->get('error_rating');
		}

		if ( !isset($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
            if ($captcha_status)
            {
			 $json['error'] = $this->language->get('error_captcha');
			}
		}


		if ($page_info['commentpage_status_reg'] && !$this->customer->isLogged()) {
			$json['error'] = $this->language->get('error_reg');
		}

		if ($this->customer->isLogged()) {
			$json['login'] = $this->customer->getFirstName();
		}
		else
		{
			$json['login'] = $this->language->get('text_anonymus');
		}



		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !isset($json['error'])) {

			$this->model_catalog_commentpage->addCommentpage($this->request->get['page_id'], $this->request->post);

            $this->data['commentpage_count']=$this->model_catalog_commentpage->getTotalCommentpagesByPageId($page_id);
			$json['commentpage_count']=$this->data['commentpage_count'];


			if ($page_info['commentpage_status_now'])
			{
			  $json['success'] = $this->language->get('text_success_now');
			}
			else
			{
			  $json['success'] = $this->language->get('text_success');
			}
		}




		$this->response->setOutput(json_encode($json));
	}

	public function captcha()
	{

		$this->load->library('captcha');

		if ($this->customer->isLogged()) {


		}
		else
		{

		$this->data['captcha_status']=true;

		$captcha = new Captcha();

		$this->session->data['captcha'] = $captcha->getCode();

		$captcha->showImage();

		}

	}

	public function upload() {
		$this->language->load('page/page');

		$json = array();

		if (!empty($this->request->files['file']['name'])) {
			$filename = basename(html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8'));

			if ((strlen($filename) < 3) || (strlen($filename) > 128)) {
        		$json['error'] = $this->language->get('error_filename');
	  		}

			$allowed = array();

			$filetypes = explode(',', $this->config->get('config_upload_allowed'));

			foreach ($filetypes as $filetype) {
				$allowed[] = trim($filetype);
			}

			if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
				$json['error'] = $this->language->get('error_filetype');
       		}

			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
			}
		} else {
			$json['error'] = $this->language->get('error_upload');
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !isset($json['error'])) {
			if (is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
				$file = basename($filename) . '.' . md5(rand());

				// Hide the uploaded file name sop people can not link to it directly.
				$this->load->library('encryption');

				$encryption = new Encryption($this->config->get('config_encryption'));

				$json['file'] = $encryption->encrypt($file);

				move_uploaded_file($this->request->files['file']['tmp_name'], DIR_DOWNLOAD . $file);
			}

			$json['success'] = $this->language->get('text_upload');
		}

		$this->response->setOutput(json_encode($json));
	}
}
?>