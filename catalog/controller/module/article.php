<?php
class ControllerModuleArticle extends Controller {
	protected function index() {
		$this->language->load('module/article');

    	$this->data['heading_title'] = $this->language->get('heading_title');

		if (isset($this->request->get['article_id'])) {
			$parts = explode('_', (string)$this->request->get['article_id']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$this->data['article_id'] = $parts[0];
		} else {
			$this->data['article_id'] = 0;
		}

		if (isset($parts[1])) {
			$this->data['child_id'] = $parts[1];
		} else {
			$this->data['child_id'] = 0;
		}

        $this->load->model('catalog/article');
		$this->load->model('catalog/page');

		$this->data['articleies'] = array();

		$articleies = $this->model_catalog_article->getArticleies(0);

		foreach ($articleies as $article) {

        $article_info = $this->model_catalog_article->getArticle($article['article_id']);

        $this->load->model('tool/image');

         if ($article_info) {
             	if ($article_info['image']) {
				$thumb = $this->model_tool_image->resize($article_info['image'],$this->config->get('config_image_wishlist_width'), $this->config->get('config_image_wishlist_height'), 1);
			} else {
				$thumb = '';
			}

         }


			$children_data = array();

			$children = $this->model_catalog_article->getArticleies($article['article_id']);

			foreach ($children as $child) {
				$data = array(
					'filter_article_id'  => $child['article_id'],
					'filter_sub_article' => true
				);

				$page_total = $this->model_catalog_page->getTotalPages($data);


				 $article_child_info = $this->model_catalog_article->getArticle($child['article_id']);



		         if ($article_child_info) {
		             	if ($article_child_info['image']) {
						$thumb_child = $this->model_tool_image->resize($article_child_info['image'], $this->config->get('config_image_wishlist_width'), $this->config->get('config_image_wishlist_height'), 1);
					} else {
						$thumb_child = '';
					}

		         }





				$children_data[] = array(
					'article_id' => $child['article_id'],
					'name'        => $child['name'],
					'count'		  => $page_total,
					'thumb' 	  => $thumb_child,
					'href'        => $this->url->link('page/article', 'article_id=' . $article['article_id'] . '_' . $child['article_id'])
				);
			}

			$data = array(
				'filter_article_id'  => $article['article_id'],
				'filter_sub_article' => true
			);

			$page_total = $this->model_catalog_page->getTotalPages($data);

			$this->data['articleies'][] = array(
				'article_id' => $article['article_id'],
				'name'        => $article['name'],
				'children'    => $children_data,
				'count'		  => $page_total,
				'meta'		  => $article['meta_description'],
				'thumb'		  => $thumb,
				'href'        => $this->url->link('page/article', 'article_id=' . $article['article_id'])
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/article.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/article.tpl';
		} else {
			$this->template = 'default/template/module/article.tpl';
		}

		$this->render();
  	}
}
?>