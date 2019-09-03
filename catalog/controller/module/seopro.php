<?php
class ControllerModuleSeopro extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('module/seopro');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));

		$this->load->model('setting/setting');

		if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('seopro', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['button_add'] = $this->language->get('button_add');
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_remove'] = $this->language->get('button_remove');

		$this->data['column_query'] = $this->language->get('column_query');
		$this->data['column_keyword'] = $this->language->get('column_keyword');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['text_edit'] = $this->language->get('text_edit');
		$this->data['text_delete'] = $this->language->get('text_delete');
		$this->data['text_save'] = $this->language->get('text_save');
		$this->data['text_cancel'] = $this->language->get('text_cancel');

		if(isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('module/seopro', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['action'] = $this->url->link('module/seopro', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['save_ajax'] = str_replace('&amp;', '&', $this->url->link('module/seopro/save_ajax', 'token=' . $this->session->data['token'], 'SSL'));
		$this->data['delete_ajax'] = str_replace('&amp;', '&', $this->url->link('module/seopro/delete_ajax', 'token=' . $this->session->data['token'], 'SSL'));

		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		if(!file_exists(DIR_SYSTEM . '../.htaccess')) {
			$this->data['error_warning'] = $this->language->get('error_htaccess');
		} elseif($this->config->get('config_seo_url') == "0") {
			$this->data['error_warning'] = $this->language->get('error_seo_url');
		} elseif($this->config->get('config_seo_url_type') != 'seo_pro') {
			$this->data['error_warning'] = $this->language->get('error_seo_url_type');
		}


		$query = $this->db->query("SELECT *
		FROM `" . DB_PREFIX . "url_alias`
WHERE NOT (
`query` LIKE 'product_id=%'
OR `query` LIKE 'category_id=%'
OR `query` LIKE 'manufacturer_id=%'
)
ORDER BY url_alias_id");
		$this->data['aliases'] = $query->rows;

		$this->template = 'module/seopro.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	public function delete_ajax() {
		if(isset($this->request->post['url_alias_id'])) {
			$this->db->query("DELETE FROM `" . DB_PREFIX . "url_alias` WHERE url_alias_id = " . (int)$this->request->post['url_alias_id']);
			$this->response->setOutput(json_encode(array('result' => 'success')));
		}
	}

	public function save_ajax() {

		if(isset($this->request->post['url_alias_id'])) {
			$this->db->query("UPDATE `" . DB_PREFIX . "url_alias` SET `query` = '" . $this->db->escape($this->request->post['query']) . "'," .
							 " keyword = '" . $this->db->escape($this->request->post['keyword']) . "' WHERE url_alias_id = " . (int)$this->request->post['url_alias_id']);
			$result = array('result' => 'success');

		} else {
			$this->db->query("INSERT IGNORE INTO `" . DB_PREFIX . "url_alias` SET `query` = '" . $this->db->escape($this->request->post['query']) . "'," .
							 " keyword = '" . $this->db->escape($this->request->post['keyword']) . "'");
			$url_alias_id = $this->db->getLastId();
			$result = array('result' => $url_alias_id);
		}
		$this->cache->delete('seo_pro');
		$this->response->setOutput(json_encode($result));
	}

	public function install() {

		$query = $this->db->query("SHOW INDEX FROM `" . DB_PREFIX . "url_alias`");

		$index_exists = false;
		foreach($query->rows as $row) {
			if($row['Key_name'] == 'query') {
				$index_exists = true;
				break;
			}
		}
		if(!$index_exists) {
			$this->db->query("ALTER IGNORE TABLE `" . DB_PREFIX . "url_alias` ADD UNIQUE `query` ( `query` ( 32 ) )");
		}
		$aliases = $this->initArr();
		foreach($aliases as $alias) {
			$this->db->query("INSERT IGNORE INTO " . DB_PREFIX . "url_alias (query, keyword) VALUES ('" . $alias[0] . "', '" . $alias[1] . "')");
		}
		$this->cache->delete('seo_pro');
	}

	private function initArr() {
		$aliases = array();
		$aliases[] = array('common/home', '');
		$aliases[] = array('common/home', '');
		$aliases[] = array('account/wishlist', 'wishlist');
		$aliases[] = array('account/account', 'my-account');
		$aliases[] = array('checkout/cart', 'shopping-cart');
		$aliases[] = array('checkout/checkout', 'checkout');
		$aliases[] = array('account/login', 'login');
		$aliases[] = array('account/logout', 'logout');
		$aliases[] = array('account/order', 'order-history');
		$aliases[] = array('account/newsletter', 'newsletter');
		$aliases[] = array('product/special', 'specials');
		$aliases[] = array('affiliate/account', 'affiliates');
		$aliases[] = array('checkout/voucher', 'gift-vouchers');
		$aliases[] = array('product/manufacturer', 'brands');
		$aliases[] = array('information/contact', 'contact-us');
		$aliases[] = array('account/return/insert', 'request-return');
		$aliases[] = array('information/sitemap', 'sitemap');
		$aliases[] = array('account/forgotten', 'forgot-password');
		$aliases[] = array('account/download', 'downloads');
		$aliases[] = array('account/return', 'returns');
		$aliases[] = array('account/transaction', 'transactions');
		$aliases[] = array('account/register', 'create-account');
		$aliases[] = array('product/compare', 'compare-products');
		$aliases[] = array('product/search', 'search');
		$aliases[] = array('account/edit', 'edit-account');
		$aliases[] = array('account/password', 'change-password');
		$aliases[] = array('account/address', 'address-book');
		$aliases[] = array('account/reward', 'reward-points');
		$aliases[] = array('affiliate/edit', 'edit-affiliate-account');
		$aliases[] = array('affiliate/password', 'change-affiliate-password');
		$aliases[] = array('affiliate/payment', 'affiliate-payment-options');
		$aliases[] = array('affiliate/tracking', 'affiliate-tracking-code');
		$aliases[] = array('affiliate/transaction', 'affiliate-transactions');
		$aliases[] = array('affiliate/logout', 'affiliate-logout');
		$aliases[] = array('affiliate/forgotten', 'affiliate-forgot-password');
		$aliases[] = array('affiliate/register', 'create-affiliate-account');
		$aliases[] = array('affiliate/login', 'affiliate-login');
		return $aliases;
	}

	private function validate() {
		if(!$this->user->hasPermission('modify', 'module/seopro')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if(!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}

?>