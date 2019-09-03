<?php
class ControllerPageArticle extends Controller {
	public function index() {
		$this->language->load('page/article');

		$this->load->model('catalog/article');

		$this->load->model('catalog/page');

		$this->load->model('tool/image');

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

		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
       		'separator' => false
   		);

		if (isset($this->request->get['article_id'])) {
			$path = '';

			$parts = explode('_', (string)$this->request->get['article_id']);

			foreach ($parts as $path_id) {
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

			$article_id = array_pop($parts);
		} else {
			$article_id = 0;
		}

		$article_info = $this->model_catalog_article->getArticle($article_id);

		if ($article_info) {
	  		$this->document->setTitle($article_info['meta_keyword']);
			$this->document->setDescription($article_info['meta_description']);
			$this->document->setKeywords($article_info['meta_keyword']);

			$this->data['heading_title'] = $article_info['name'];

			$this->data['text_refine'] = $this->language->get('text_refine');
			$this->data['text_empty'] = $this->language->get('text_empty');
			$this->data['text_quantity'] = $this->language->get('text_quantity');
			$this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
			$this->data['text_model'] = $this->language->get('text_model');
			$this->data['text_price'] = $this->language->get('text_price');
			$this->data['text_tax'] = $this->language->get('text_tax');
			$this->data['text_points'] = $this->language->get('text_points');
			$this->data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
			$this->data['text_display'] = $this->language->get('text_display');
			$this->data['text_list'] = $this->language->get('text_list');
			$this->data['text_grid'] = $this->language->get('text_grid');
			$this->data['text_sort'] = $this->language->get('text_sort');
			$this->data['text_limit'] = $this->language->get('text_limit');
			$this->data['text_commentpages'] = $this->language->get('text_commentpages');
			$this->data['text_viewed'] = $this->language->get('text_viewed');

			$this->data['button_cart'] = $this->language->get('button_cart');
			$this->data['button_wishlist'] = $this->language->get('button_wishlist');
			$this->data['button_compare'] = $this->language->get('button_compare');
			$this->data['button_continue'] = $this->language->get('button_continue');

			if ($article_info['image']) {
				$this->data['thumb'] = $this->model_tool_image->resize($article_info['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
			} else {
				$this->data['thumb'] = '';
			}

					if (!function_exists("truncate_words"))
                    {
                        function truncate_words($text, $limit=200)
                                                {
                                                        $text=mb_substr($text,0,$limit);
                                                        /*åñëè íå ïóñòàÿ îáðåçàåì äî  ïîñëåäíåãî  ïðîáåëà*/
                                                        if(mb_substr($text,mb_strlen($text)-1,1) && mb_strlen($text)==$limit)
                                                        {
                                                                $textret=mb_substr($text,0,mb_strlen($text)-mb_strlen(strrchr($text,' ')));
                                                                if(!empty($textret))
                                                                {
                                                                        return $textret;
                                                                }
                                                        }
                                                        return $text;
                                                }

                    }
         $this->data['description'] = html_entity_decode($article_info['description'], ENT_QUOTES, 'UTF-8');
			$this->data['compare'] = $this->url->link('page/compare');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}
            $this->data['categories'] = array();

			$results = $this->model_catalog_article->getArticleies($article_id);

			foreach ($results as $result) {
				$data = array(
					'filter_article_id'  => $result['article_id'],
					'filter_sub_article' => true
				);

				$page_total = $this->model_catalog_page->getTotalPages($data);

				$this->data['categories'][] = array(
					'name'  => $result['name'] . ' (' . $page_total . ')',
					'href'  => $this->url->link('page/article', 'article_id=' . $this->request->get['article_id'] . '_' . $result['article_id'] . $url)
				);
			}

			$this->data['pages'] = array();

			$data = array(
				'filter_article_id' => $article_id,
				'sort'               => $sort,
				'order'              => $order,
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);

			$page_total = $this->model_catalog_page->getTotalPages($data);

			$results = $this->model_catalog_page->getPages($data);

			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
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

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_commentpage_status')) {
					$rating = (int)$result['rating'];
				} else {
					$rating = false;
				}

				$this->data['pages'][] = array(
					'page_id'  => $result['page_id'],
					'thumb'       => $image,
					'name'        => $result['name'],
					'description' => mb_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
					'price'       => $price,
					'special'     => $special,
					'tax'         => $tax,
					'rating'      => $result['rating'],
					'date_added'        => $result['date_added'],
					'viewed'        => $result['viewed'],
					'commentpages'     => (int)$result['commentpages'],
					'href'        => $this->url->link('page/page', 'article_id=' . $this->request->get['article_id'] . '&page_id=' . $result['page_id'])
				);
			}

			$url = '';

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$this->data['sorts'] = array();

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_default'),
				'value' => 'p.sort_order-ASC',
				'href'  => $this->url->link('page/article', 'article_id=' . $this->request->get['article_id'] .'&sort=p.sort_order&order=ASC' . $url)
			);


			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_date_added_desc'),
				'value' => 'p.date_added-DESC',
				'href'  => $this->url->link('page/article', 'article_id=' . $this->request->get['article_id'] . '&sort=p.date_added&order=DESC' . $url)
			);


			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_date_added_asc'),
				'value' => 'p.date_added-ASC',
				'href'  => $this->url->link('page/article', 'article_id=' . $this->request->get['article_id'] .  '&sort=p.date_added&order=ASC' . $url)
			);




			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_name_asc'),
				'value' => 'pd.name-ASC',
				'href'  => $this->url->link('page/article', 'article_id=' . $this->request->get['article_id'] . '&sort=pd.name&order=ASC' . $url)
			);

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_name_desc'),
				'value' => 'pd.name-DESC',
				'href'  => $this->url->link('page/article', 'article_id=' . $this->request->get['article_id'] . '&sort=pd.name&order=DESC' . $url)
			);



			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_desc'),
				'value' => 'rating-DESC',
				'href'  => $this->url->link('page/article', 'article_id=' . $this->request->get['article_id'] . '&sort=rating&order=DESC' . $url)
			);

			$this->data['sorts'][] = array(
				'text'  => $this->language->get('text_rating_asc'),
				'value' => 'rating-ASC',
				'href'  => $this->url->link('page/article', 'article_id=' . $this->request->get['article_id'] . '&sort=rating&order=ASC' . $url)
			);



			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			$this->data['limits'] = array();

			$this->data['limits'][] = array(
				'text'  => $this->config->get('config_catalog_limit'),
				'value' => $this->config->get('config_catalog_limit'),
				'href'  => $this->url->link('page/article', 'article_id=' . $this->request->get['article_id']. $url . '&limit=' . $this->config->get('config_catalog_limit'))
			);

			$this->data['limits'][] = array(
				'text'  => 25,
				'value' => 25,
				'href'  => $this->url->link('page/article', 'article_id=' . $this->request->get['article_id'] . $url . '&limit=25')
			);

			$this->data['limits'][] = array(
				'text'  => 50,
				'value' => 50,
				'href'  => $this->url->link('page/article', 'article_id=' . $this->request->get['article_id'] . $url . '&limit=50')
			);

			$this->data['limits'][] = array(
				'text'  => 75,
				'value' => 75,
				'href'  => $this->url->link('page/article', 'article_id=' . $this->request->get['article_id'] . $url . '&limit=75')
			);

			$this->data['limits'][] = array(
				'text'  => 100,
				'value' => 100,
				'href'  => $this->url->link('page/article', 'article_id=' . $this->request->get['article_id'] . $url . '&limit=100')
			);

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$pagination = new Pagination();
			$pagination->total = $page_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('page/article', 'article_id=' . $this->request->get['article_id']. $url . '&page={page}');

			$this->data['pagination'] = $pagination->render();

			$this->data['sort'] = $sort;
			$this->data['order'] = $order;
			$this->data['limit'] = $limit;

			$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/page/article.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/page/article.tpl';
			} else {
				$this->template = 'default/template/page/article.tpl';
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

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('page/article', $url),
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
}
?>