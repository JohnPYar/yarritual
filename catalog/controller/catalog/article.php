<?php
class ControllerCatalogArticle extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/article');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/article');

		$this->getList();
	}

	public function insert() {
		$this->load->language('catalog/article');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/article');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_article->addArticle($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('catalog/article', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('catalog/article');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/article');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_article->editArticle($this->request->get['article_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('catalog/article', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/article');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/article');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $article_id) {
				$this->model_catalog_article->deleteArticle($article_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('catalog/article', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->getList();
	}

	private function getList() {

   		$this->data['url_back'] = $this->url->link('module/article', 'token=' . $this->session->data['token'], 'SSL');
   		$this->data['url_back_text'] = $this->language->get('url_back_text');

   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/article', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$this->data['insert'] = $this->url->link('catalog/article/insert', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['delete'] = $this->url->link('catalog/article/delete', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['categories'] = array();

		$results = $this->model_catalog_article->getCategories(0);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/article/update', 'token=' . $this->session->data['token'] . '&article_id=' . $result['article_id'], 'SSL')
			);

			$this->data['categories'][] = array(
				'article_id' => $result['article_id'],
				'name'        => $result['name'],
				'sort_order'  => $result['sort_order'],
				'selected'    => isset($this->request->post['selected']) && in_array($result['article_id'], $this->request->post['selected']),
				'action'      => $action
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		$this->template = 'catalog/article_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	private function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');

  	    $this->data['url_back'] = $this->url->link('module/article', 'token=' . $this->session->data['token'], 'SSL');
   		$this->data['url_back_text'] = $this->language->get('url_back_text');

		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
    	$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_percent'] = $this->language->get('text_percent');
		$this->data['text_amount'] = $this->language->get('text_amount');

		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_parent'] = $this->language->get('entry_parent');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_top'] = $this->language->get('entry_top');
		$this->data['entry_column'] = $this->language->get('entry_column');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_layout'] = $this->language->get('entry_layout');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

    	$this->data['tab_general'] = $this->language->get('tab_general');
    	$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_design'] = $this->language->get('tab_design');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/article', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		if (!isset($this->request->get['article_id'])) {
			$this->data['action'] = $this->url->link('catalog/article/insert', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/article/update', 'token=' . $this->session->data['token'] . '&article_id=' . $this->request->get['article_id'], 'SSL');
		}

		$this->data['cancel'] = $this->url->link('catalog/article', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['article_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
      		$article_info = $this->model_catalog_article->getArticle($this->request->get['article_id']);
    	}

		$this->load->model('localisation/language');

		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['article_description'])) {
			$this->data['article_description'] = $this->request->post['article_description'];
		} elseif (isset($this->request->get['article_id'])) {
			$this->data['article_description'] = $this->model_catalog_article->getArticleDescriptions($this->request->get['article_id']);
		} else {
			$this->data['article_description'] = array();
		}

		$categories = $this->model_catalog_article->getCategories(0);

		// Remove own id from list
		if (!empty($article_info)) {
			foreach ($categories as $key => $article) {
				if ($article['article_id'] == $article_info['article_id']) {
					unset($categories[$key]);
				}
			}
		}

		$this->data['categories'] = $categories;

		if (isset($this->request->post['parent_id'])) {
			$this->data['parent_id'] = $this->request->post['parent_id'];
		} elseif (!empty($article_info)) {
			$this->data['parent_id'] = $article_info['parent_id'];
		} else {
			$this->data['parent_id'] = 0;
		}

		$this->load->model('setting/store');

		$this->data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['article_store'])) {
			$this->data['article_store'] = $this->request->post['article_store'];
		} elseif (isset($this->request->get['article_id'])) {
			$this->data['article_store'] = $this->model_catalog_article->getArticleStores($this->request->get['article_id']);
		} else {
			$this->data['article_store'] = array(0);
		}

		if (isset($this->request->post['keyword'])) {
			$this->data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($article_info)) {
			$this->data['keyword'] = $article_info['keyword'];
		} else {
			$this->data['keyword'] = '';
		}

		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (!empty($article_info)) {
			$this->data['image'] = $article_info['image'];
		} else {
			$this->data['image'] = '';
		}

		$this->load->model('tool/image');

		if (!empty($article_info) && $article_info['image'] && file_exists(DIR_IMAGE . $article_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($article_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}

		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		if (isset($this->request->post['top'])) {
			$this->data['top'] = $this->request->post['top'];
		} elseif (!empty($article_info)) {
			$this->data['top'] = $article_info['top'];
		} else {
			$this->data['top'] = 0;
		}

		if (isset($this->request->post['column'])) {
			$this->data['column'] = $this->request->post['column'];
		} elseif (!empty($article_info)) {
			$this->data['column'] = $article_info['column'];
		} else {
			$this->data['column'] = 1;
		}

		if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($article_info)) {
			$this->data['sort_order'] = $article_info['sort_order'];
		} else {
			$this->data['sort_order'] = '';
		}

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($article_info)) {
			$this->data['status'] = $article_info['status'];
		} else {
			$this->data['status'] = 1;
		}

		if (isset($this->request->post['article_layout'])) {
			$this->data['article_layout'] = $this->request->post['article_layout'];
		} elseif (isset($this->request->get['article_id'])) {
			$this->data['article_layout'] = $this->model_catalog_article->getArticleLayouts($this->request->get['article_id']);
		} else {
			$this->data['article_layout'] = array();
		}

		$this->load->model('design/layout');

		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'catalog/article_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/article')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['article_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/article')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

		public function createTables() {

$sql[0]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `top` tinyint(1) NOT NULL,
  `column` int(3) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=64 ;
";


$sql[1]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "article_description` (
  `article_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `description` text COLLATE utf8_bin NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_bin NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`article_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
";

$sql[2]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "article_to_layout` (
  `article_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`article_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
";




$sql[3]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "article_to_store` (
  `article_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  PRIMARY KEY (`article_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
";


$sql[4]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "commentpage` (
  `commentpage_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `author` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `text` text COLLATE utf8_bin NOT NULL,
  `rating` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`commentpage_id`),
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;
";


$sql[5]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(64) COLLATE utf8_bin NOT NULL,
  `sku` varchar(64) COLLATE utf8_bin NOT NULL,
  `upc` varchar(12) COLLATE utf8_bin NOT NULL,
  `location` varchar(128) COLLATE utf8_bin NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT '0',
  `stock_status_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `shipping` tinyint(1) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `points` int(8) NOT NULL DEFAULT '0',
  `tax_class_id` int(11) NOT NULL,
  `date_available` date NOT NULL,
  `weight` decimal(5,2) NOT NULL DEFAULT '0.00',
  `weight_class_id` int(11) NOT NULL DEFAULT '0',
  `length` decimal(5,2) NOT NULL DEFAULT '0.00',
  `width` decimal(5,2) NOT NULL DEFAULT '0.00',
  `height` decimal(5,2) NOT NULL DEFAULT '0.00',
  `length_class_id` int(11) NOT NULL DEFAULT '0',
  `subtract` tinyint(1) NOT NULL DEFAULT '1',
  `minimum` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `commentpage_status` tinyint(1) NOT NULL,
  `commentpage_status_reg` tinyint(1) NOT NULL,
  `commentpage_status_now` tinyint(1) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `viewed` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=60 ;
";



$sql[6]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page_attribute` (
  `page_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`page_id`,`attribute_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
";


$sql[7]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page_description` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_bin NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`page_id`,`language_id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=60 ;
";



$sql[8]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page_discount` (
  `page_discount_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `quantity` int(4) NOT NULL DEFAULT '0',
  `priority` int(5) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`page_discount_id`),
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=441 ;
";

$sql[9]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page_image` (
  `page_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2354 ;
";



$sql[10]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page_option` (
  `page_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `option_value` text COLLATE utf8_bin NOT NULL,
  `required` tinyint(1) NOT NULL,
  PRIMARY KEY (`page_option_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=227 ;
";

$sql[11]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page_option_value` (
  `page_option_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_option_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `option_value_id` int(11) NOT NULL,
  `quantity` int(3) NOT NULL,
  `subtract` tinyint(1) NOT NULL,
  `price` decimal(15,4) NOT NULL,
  `price_prefix` varchar(1) COLLATE utf8_bin NOT NULL,
  `points` int(8) NOT NULL,
  `points_prefix` varchar(1) COLLATE utf8_bin NOT NULL,
  `weight` decimal(15,8) NOT NULL,
  `weight_prefix` varchar(1) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`page_option_value_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;
";

$sql[12]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page_related` (
  `page_id` int(11) NOT NULL,
  `related_id` int(11) NOT NULL,
  PRIMARY KEY (`page_id`,`related_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
";


$sql[13]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page_reward` (
  `page_reward_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL DEFAULT '0',
  `customer_group_id` int(11) NOT NULL DEFAULT '0',
  `points` int(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_reward_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=563 ;
";

$sql[14]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page_special` (
  `page_special_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `customer_group_id` int(11) NOT NULL,
  `priority` int(5) NOT NULL DEFAULT '1',
  `price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `date_start` date NOT NULL DEFAULT '0000-00-00',
  `date_end` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`page_special_id`),
  KEY `page_id` (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=440 ;
";

$sql[15]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page_tag` (
  `page_tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `tag` varchar(32) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`page_tag_id`),
  KEY `page_id` (`page_id`),
  KEY `language_id` (`language_id`),
  KEY `tag` (`tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=354 ;
";


$sql[16]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page_to_article` (
  `page_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`page_id`,`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
";


$sql[17]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page_to_download` (
  `page_id` int(11) NOT NULL,
  `download_id` int(11) NOT NULL,
  PRIMARY KEY (`page_id`,`download_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
";

$sql[18]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page_to_layout` (
  `page_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `layout_id` int(11) NOT NULL,
  PRIMARY KEY (`page_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
";

$sql[19]="
CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "page_to_store` (
  `page_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_id`,`store_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
";


foreach ($sql as $qsql)
{
 $query = $this->db->query($qsql);
}

	$msql="SELECT * FROM `" . DB_PREFIX . "layout` WHERE `name`='Article';";
	$query = $this->db->query($msql);
	if( count($query->rows)<=0)
	{
		$msql="INSERT INTO `" . DB_PREFIX . "layout` (`name`) VALUES  ('Article');";
		$query = $this->db->query($msql);
		$msql="INSERT INTO `" . DB_PREFIX . "layout_route` (`route`, `layout_id`) VALUES  ('page/article',".mysql_insert_id().");";
		$query = $this->db->query($msql);
	}

	$msql="SELECT * FROM `" . DB_PREFIX . "layout` WHERE `name`='Page';";
	$query = $this->db->query($msql);
	if( count($query->rows)<=0)
	{
		$msql="INSERT INTO `" . DB_PREFIX . "layout` (`name`) VALUES  ('Page');";
		$query = $this->db->query($msql);
		$msql="INSERT INTO `" . DB_PREFIX . "layout_route` (`route`, `layout_id`) VALUES  ('page/page',".mysql_insert_id().");";
		$query = $this->db->query($msql);
	}

 $this->load->language('catalog/article');
 $html=$this->language->get('ok_create_tables');
 $this->response->setOutput($html);


	}





}
?>