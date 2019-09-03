<?php  
class ControllerCommonHome extends Controller {
	public function clearCache() {
		$cachedir = realpath(dirname(DIR_CATALOG)) . '/pagecache/cachefiles/';
		$files = glob($cachedir . 'cache.*');
		
		if(!empty($files)) {
			foreach($files as $file) {
				@unlink($file);
			}
		}
		
		$this->session->data['clear_cache'] = true;
		if(!isset($this->session->data['token'])) $this->session->data['token'] = '';
		$this->redirect(HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token']);
	}
	
	public function deleteCacheFile() {
		$files = false;
		$key = empty($this->request->get['key']) ? '' : preg_replace('~[^a-z0-9]+~', '', $this->request->get['key']);
		if(!empty($key)) {
			
			$cachedir = realpath(dirname(DIR_CATALOG)) . '/pagecache/cachefiles/';
			$files = glob($cachedir . 'cache.' . $key . '*');
			foreach($files as $file) {
				@unlink($file);
			}
		}
			
		if(!empty($files)) {			
			die('1');
		} else {
			die('0');
		}
	}
	public function index() {
		$this->data['text_clear_cache'] = $this->language->get('text_clear_cache');
		$this->document->setTitle($this->config->get('config_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));

		$this->data['heading_title'] = $this->config->get('config_title');
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/home.tpl';
		} else {
			$this->template = 'default/template/common/home.tpl';
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
?>