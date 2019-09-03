<?php
class ControllerCatalogCommentpage extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/commentpage');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/commentpage');

		$this->getList();
	}

	public function insert() {
		$this->load->language('catalog/commentpage');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/commentpage');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_commentpage->addCommentpage($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('catalog/commentpage', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->load->language('catalog/commentpage');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/commentpage');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_commentpage->editCommentpage($this->request->get['commentpage_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('catalog/commentpage', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/commentpage');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/commentpage');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $commentpage_id) {
				$this->model_catalog_commentpage->deleteCommentpage($commentpage_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('catalog/commentpage', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	private function getList() {

  	    $this->data['url_back'] = $this->url->link('module/article', 'token=' . $this->session->data['token'], 'SSL');
   		$this->data['url_back_text'] = $this->language->get('url_back_text');
        $this->data['token'] = $this->session->data['token'];

        $this->data['button_filter'] = $this->language->get('button_filter');

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}


		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'r.date_added';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}


		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/commentpage', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);

		$this->data['insert'] = $this->url->link('catalog/commentpage/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('catalog/commentpage/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['commentpages'] = array();

		$data = array(
			'filter_name'  => $filter_name,
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);

		$commentpage_total = $this->model_catalog_commentpage->getTotalCommentpages();

		$results = $this->model_catalog_commentpage->getCommentpages($data);

    	foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/commentpage/update', 'token=' . $this->session->data['token'] . '&commentpage_id=' . $result['commentpage_id'] . $url, 'SSL')
			);

			$this->data['commentpages'][] = array(
				'commentpage_id' => $result['commentpage_id'],
				'name'       => $result['name'],
				'author'     => $result['author'],
				'rating'     => $result['rating'],
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'selected'   => isset($this->request->post['selected']) && in_array($result['commentpage_id'], $this->request->post['selected']),
				'action'     => $action
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_commentpage_id'] = $this->language->get('column_commentpage_id');
		$this->data['column_page'] = $this->language->get('column_page');
		$this->data['column_author'] = $this->language->get('column_author');
		$this->data['column_rating'] = $this->language->get('column_rating');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');

        $this->data['filter_name'] = $filter_name;

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

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['sort_page'] = $this->url->link('catalog/commentpage', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$this->data['sort_author'] = $this->url->link('catalog/commentpage', 'token=' . $this->session->data['token'] . '&sort=r.author' . $url, 'SSL');
		$this->data['sort_rating'] = $this->url->link('catalog/commentpage', 'token=' . $this->session->data['token'] . '&sort=r.rating' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/commentpage', 'token=' . $this->session->data['token'] . '&sort=r.status' . $url, 'SSL');
		$this->data['sort_date_added'] = $this->url->link('catalog/commentpage', 'token=' . $this->session->data['token'] . '&sort=r.date_added' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $commentpage_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/commentpage', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'catalog/commentpage_list.tpl';
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


		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_select'] = $this->language->get('text_select');

        $this->data['entry_date_available'] = $this->language->get('entry_date_available');

		$this->data['entry_page'] = $this->language->get('entry_page');
		$this->data['entry_author'] = $this->language->get('entry_author');
		$this->data['entry_rating'] = $this->language->get('entry_rating');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_text'] = $this->language->get('entry_text');
		$this->data['entry_good'] = $this->language->get('entry_good');
		$this->data['entry_bad'] = $this->language->get('entry_bad');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['date_available'])) {
			$this->data['error_date_available'] = $this->error['date_available'];
		} else {
			$this->data['error_date_available'] = '';
		}


		if (isset($this->error['page'])) {
			$this->data['error_page'] = $this->error['page'];
		} else {
			$this->data['error_page'] = '';
		}

 		if (isset($this->error['author'])) {
			$this->data['error_author'] = $this->error['author'];
		} else {
			$this->data['error_author'] = '';
		}

 		if (isset($this->error['text'])) {
			$this->data['error_text'] = $this->error['text'];
		} else {
			$this->data['error_text'] = '';
		}

 		if (isset($this->error['rating'])) {
			$this->data['error_rating'] = $this->error['rating'];
		} else {
			$this->data['error_rating'] = '';
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/commentpage', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);






		if (!isset($this->request->get['commentpage_id'])) {
			$this->data['action'] = $this->url->link('catalog/commentpage/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/commentpage/update', 'token=' . $this->session->data['token'] . '&commentpage_id=' . $this->request->get['commentpage_id'] . $url, 'SSL');
		}

		$this->data['cancel'] = $this->url->link('catalog/commentpage', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['commentpage_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$commentpage_info = $this->model_catalog_commentpage->getCommentpage($this->request->get['commentpage_id']);
		}

		$this->load->model('catalog/page');

		if (isset($this->request->post['date_available'])) {
       		$this->data['date_available'] = $this->request->post['date_available'];
		} elseif (!empty($commentpage_info)) {
			$this->data['date_available'] = date('Y-m-d h:i:s', strtotime($commentpage_info['date_added']));
		} else {
			$this->data['date_available'] = date('Y-m-d h:i:s', time() - 86400);
		}



		if (isset($this->request->post['page_id'])) {
			$this->data['page_id'] = $this->request->post['page_id'];
		} elseif (!empty($commentpage_info)) {
			$this->data['page_id'] = $commentpage_info['page_id'];
		} else {
			$this->data['page_id'] = '';
		}

		if (isset($this->request->post['page'])) {
			$this->data['page'] = $this->request->post['page'];
		} elseif (!empty($commentpage_info)) {
			$this->data['page'] = $commentpage_info['page'];
		} else {
			$this->data['page'] = '';
		}

		if (isset($this->request->post['author'])) {
			$this->data['author'] = $this->request->post['author'];
		} elseif (!empty($commentpage_info)) {
			$this->data['author'] = $commentpage_info['author'];
		} else {
			$this->data['author'] = '';
		}

		if (isset($this->request->post['text'])) {
			$this->data['text'] = $this->request->post['text'];
		} elseif (!empty($commentpage_info)) {
			$this->data['text'] = $commentpage_info['text'];
		} else {
			$this->data['text'] = '';
		}

		if (isset($this->request->post['rating'])) {
			$this->data['rating'] = $this->request->post['rating'];
		} elseif (!empty($commentpage_info)) {
			$this->data['rating'] = $commentpage_info['rating'];
		} else {
			$this->data['rating'] = '';
		}

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($commentpage_info)) {
			$this->data['status'] = $commentpage_info['status'];
		} else {
			$this->data['status'] = '';
		}


		$this->template = 'catalog/commentpage_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	private function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/commentpage')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['page_id']) {
			$this->error['page'] = $this->language->get('error_page');
		}

		if ((utf8_strlen($this->request->post['author']) < 3) || (utf8_strlen($this->request->post['author']) > 64)) {
			$this->error['author'] = $this->language->get('error_author');
		}

		if (utf8_strlen($this->request->post['text']) < 1) {
			$this->error['text'] = $this->language->get('error_text');
		}

		if (!isset($this->request->post['rating'])) {
			$this->error['rating'] = $this->language->get('error_rating');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	private function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/commentpage')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/page');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}


			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 20;
			}

			$data = array(
				'filter_name'     => $filter_name,
				'start'           => 0,
				'limit'           => $limit
			);

			$results = $this->model_catalog_page->getPages($data);

			foreach ($results as $result) {
				$option_data = array();

				$page_options = $this->model_catalog_page->getPageOptions($result['page_id']);

				foreach ($page_options as $page_option) {
					if ($page_option['type'] == 'select' || $page_option['type'] == 'radio' || $page_option['type'] == 'checkbox' || $page_option['type'] == 'image') {
						$option_value_data = array();

						foreach ($page_option['page_option_value'] as $page_option_value) {
							$option_value_data[] = array(
								'page_option_value_id' => $page_option_value['page_option_value_id'],
								'option_value_id'         => $page_option_value['option_value_id'],
								'name'                    => $page_option_value['name']
							);
						}

						$option_data[] = array(
							'page_option_id' => $page_option['page_option_id'],
							'option_id'         => $page_option['option_id'],
							'name'              => $page_option['name'],
							'type'              => $page_option['type'],
							'option_value'      => $option_value_data,
							'required'          => $page_option['required']
						);
					} else {
						$option_data[] = array(
							'page_option_id' => $page_option['page_option_id'],
							'option_id'         => $page_option['option_id'],
							'name'              => $page_option['name'],
							'type'              => $page_option['type'],
							'option_value'      => $page_option['option_value'],
							'required'          => $page_option['required']
						);
					}
				}

				$json[] = array(
					'page_id' => $result['page_id'],
					'name'       => html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'),
					'article'      => $result['article_name'],
					'option'     => $option_data,
					'price'      => $result['price']
				);
			}
		}

		$this->response->setOutput(json_encode($json));
	}




}
?>