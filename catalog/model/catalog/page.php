<?php
class ModelCatalogPage extends Model {
	public function updateViewed($page_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "page SET viewed = (viewed + 1) WHERE page_id = '" . (int)$page_id . "'");
	}

	public function getPage($page_id) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer,   (SELECT price FROM " . DB_PREFIX . "page_discount pd2 WHERE pd2.page_id = p.page_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "page_special ps WHERE ps.page_id = p.page_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "page_reward pr WHERE pr.page_id = p.page_id AND customer_group_id = '" . (int)$customer_group_id . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "commentpage r1 WHERE r1.page_id = p.page_id AND r1.status = '1' GROUP BY r1.page_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "commentpage r2 WHERE r2.page_id = p.page_id AND r2.status = '1' GROUP BY r2.page_id) AS commentpages, p.sort_order FROM " . DB_PREFIX . "page p LEFT JOIN " . DB_PREFIX . "page_description pd ON (p.page_id = pd.page_id) LEFT JOIN " . DB_PREFIX . "page_to_store p2s ON (p.page_id = p2s.page_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.page_id = '" . (int)$page_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			$query->row['price'] = ($query->row['discount'] ? $query->row['discount'] : $query->row['price']);
			$query->row['rating'] = (int)$query->row['rating'];

			return $query->row;
		} else {
			return false;
		}
	}

	public function getPages($data = array()) {

		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$cache = md5(http_build_query($data));

		$page_data = $this->cache->get('page.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$customer_group_id . '.' . $cache);

		if (!$page_data) {
			$sql = "SELECT p.page_id, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "commentpage rc WHERE rc.page_id = p.page_id AND rc.status = '1' GROUP BY rc.page_id) AS commentpages, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "commentpage r1 WHERE r1.page_id = p.page_id AND r1.status = '1' GROUP BY r1.page_id) AS rating FROM " . DB_PREFIX . "page p LEFT JOIN " . DB_PREFIX . "page_description pd ON (p.page_id = pd.page_id) LEFT JOIN " . DB_PREFIX . "page_to_store p2s ON (p.page_id = p2s.page_id)";

			if (!empty($data['filter_tag'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "page_tag pt ON (p.page_id = pt.page_id)";
			}

			if (!empty($data['filter_article_id'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "page_to_article p2c ON (p.page_id = p2c.page_id)";
			}

			$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

			if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
				$sql .= " AND (";

				if (!empty($data['filter_name'])) {
					$implode = array();

					$words = explode(' ', $data['filter_name']);

					foreach ($words as $word) {
						if (!empty($data['filter_description'])) {
							$implode[] = "LCASE(pd.name) LIKE '%" . $this->db->escape(utf8_strtolower($word)) . "%' OR LCASE(pd.description) LIKE '%" . $this->db->escape(utf8_strtolower($word)) . "%'";
						} else {
							$implode[] = "LCASE(pd.name) LIKE '%" . $this->db->escape(utf8_strtolower($word)) . "%'";
						}
					}

					if ($implode) {
						$sql .= " " . implode(" OR ", $implode) . "";
					}
				}

				if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
					$sql .= " OR ";
				}

				if (!empty($data['filter_tag'])) {
					$implode = array();

					$words = explode(' ', $data['filter_tag']);

					foreach ($words as $word) {
						$implode[] = "LCASE(pt.tag) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_tag'])) . "%' AND pt.language_id = '" . (int)$this->config->get('config_language_id') . "'";
					}

					if ($implode) {
						$sql .= " " . implode(" OR ", $implode) . "";
					}
				}

				$sql .= ")";
			}

			if (!empty($data['filter_article_id'])) {
				if (!empty($data['filter_sub_article'])) {
					$implode_data = array();

					$implode_data[] = "p2c.article_id = '" . (int)$data['filter_article_id'] . "'";

					$this->load->model('catalog/article');

					$articleies = $this->model_catalog_article->getArticleiesByParentId($data['filter_article_id']);

					foreach ($articleies as $article_id) {
						$implode_data[] = "p2c.article_id = '" . (int)$article_id . "'";
					}

					$sql .= " AND (" . implode(' OR ', $implode_data) . ")";
				} else {
					$sql .= " AND p2c.article_id = '" . (int)$data['filter_article_id'] . "'";
				}
			}

			if (!empty($data['filter_manufacturer_id'])) {
				$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
			}

			$sql .= " GROUP BY p.page_id";

			$sort_data = array(
				'pd.name',
				'p.model',
				'p.quantity',
				'p.price',
				'rating',
				'p.sort_order',
				'p.date_added'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
					$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
				} else {
					$sql .= " ORDER BY " . $data['sort'];
				}
			} else {
				$sql .= " ORDER BY p.sort_order DESC";
			}

			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}

			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}

				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}

			$page_data = array();

			$query = $this->db->query($sql);

			foreach ($query->rows as $result) {
				$page_data[$result['page_id']] = $this->getPage($result['page_id']);
			}

			$this->cache->set('page.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$customer_group_id . '.' . $cache, $page_data);
		}

		return $page_data;
	}


	public function getPageCategories($page_id) {
		$page_article_data = array();
        $sql="SELECT * FROM " . DB_PREFIX . "page_to_article WHERE page_id = '" . (int)$page_id . "'";
		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$page_article_data[] = $result['article_id'];
		}

		return $page_article_data;
	}



	public function getPageSpecials($data = array()) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$sql = "SELECT DISTINCT ps.page_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "commentpage r1 WHERE r1.page_id = ps.page_id AND r1.status = '1' GROUP BY r1.page_id) AS rating FROM " . DB_PREFIX . "page_special ps LEFT JOIN " . DB_PREFIX . "page p ON (ps.page_id = p.page_id) LEFT JOIN " . DB_PREFIX . "page_description pd ON (p.page_id = pd.page_id) LEFT JOIN " . DB_PREFIX . "page_to_store p2s ON (p.page_id = p2s.page_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) GROUP BY ps.page_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'ps.price',
			'rating',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$page_data = array();

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$page_data[$result['page_id']] = $this->getPage($result['page_id']);
		}

		return $page_data;
	}

	public function getLatestPages($limit) {
		$page_data = $this->cache->get('page.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$limit);

		if (!$page_data) {
			$query = $this->db->query("SELECT p.page_id FROM " . DB_PREFIX . "page p LEFT JOIN " . DB_PREFIX . "page_to_store p2s ON (p.page_id = p2s.page_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.date_added DESC LIMIT " . (int)$limit);

			foreach ($query->rows as $result) {
				$page_data[$result['page_id']] = $this->getPage($result['page_id']);
			}

			$this->cache->set('page.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$limit, $page_data);
		}

		return $page_data;
	}

	public function getPopularPages($limit) {
		$page_data = array();

		$query = $this->db->query("SELECT p.page_id FROM " . DB_PREFIX . "page p LEFT JOIN " . DB_PREFIX . "page_to_store p2s ON (p.page_id = p2s.page_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.viewed, p.date_added DESC LIMIT " . (int)$limit);

		foreach ($query->rows as $result) {
			$page_data[$result['page_id']] = $this->getPage($result['page_id']);
		}

		return $page_data;
	}

	public function getBestSellerPages($limit) {
		$page_data = $this->cache->get('page.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$limit);

		if (!$page_data) {
			$page_data = array();

			$query = $this->db->query("SELECT op.page_id, COUNT(*) AS total FROM " . DB_PREFIX . "order_page op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "page` p ON (op.page_id = p.page_id) LEFT JOIN " . DB_PREFIX . "page_to_store p2s ON (p.page_id = p2s.page_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.page_id ORDER BY total DESC LIMIT " . (int)$limit);

			foreach ($query->rows as $result) {
				$page_data[$result['page_id']] = $this->getPage($result['page_id']);
			}

			$this->cache->set('page.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$limit, $page_data);
		}

		return $page_data;
	}

	public function getPageAttributes($page_id) {
		$page_attribute_group_data = array();

		$page_attribute_group_query = $this->db->query("SELECT ag.attribute_group_id, agd.name FROM " . DB_PREFIX . "page_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_group ag ON (a.attribute_group_id = ag.attribute_group_id) LEFT JOIN " . DB_PREFIX . "attribute_group_description agd ON (ag.attribute_group_id = agd.attribute_group_id) WHERE pa.page_id = '" . (int)$page_id . "' AND agd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY ag.attribute_group_id ORDER BY ag.sort_order, agd.name");

		foreach ($page_attribute_group_query->rows as $page_attribute_group) {
			$page_attribute_data = array();

			$page_attribute_query = $this->db->query("SELECT a.attribute_id, ad.name, pa.text FROM " . DB_PREFIX . "page_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.page_id = '" . (int)$page_id . "' AND a.attribute_group_id = '" . (int)$page_attribute_group['attribute_group_id'] . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pa.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name");

			foreach ($page_attribute_query->rows as $page_attribute) {
				$page_attribute_data[] = array(
					'attribute_id' => $page_attribute['attribute_id'],
					'name'         => $page_attribute['name'],
					'text'         => $page_attribute['text']
				);
			}

			$page_attribute_group_data[] = array(
				'attribute_group_id' => $page_attribute_group['attribute_group_id'],
				'name'               => $page_attribute_group['name'],
				'attribute'          => $page_attribute_data
			);
		}

		return $page_attribute_group_data;
	}

	public function getPageOptions($page_id) {
		$page_option_data = array();

		$page_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.page_id = '" . (int)$page_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

		foreach ($page_option_query->rows as $page_option) {
			if ($page_option['type'] == 'select' || $page_option['type'] == 'radio' || $page_option['type'] == 'checkbox' || $page_option['type'] == 'image') {
				$page_option_value_data = array();

				$page_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.page_id = '" . (int)$page_id . "' AND pov.page_option_id = '" . (int)$page_option['page_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order");

				foreach ($page_option_value_query->rows as $page_option_value) {
					$page_option_value_data[] = array(
						'page_option_value_id' => $page_option_value['page_option_value_id'],
						'option_value_id'         => $page_option_value['option_value_id'],
						'name'                    => $page_option_value['name'],
						'image'                   => $page_option_value['image'],
						'quantity'                => $page_option_value['quantity'],
						'subtract'                => $page_option_value['subtract'],
						'price'                   => $page_option_value['price'],
						'price_prefix'            => $page_option_value['price_prefix'],
						'weight'                  => $page_option_value['weight'],
						'weight_prefix'           => $page_option_value['weight_prefix']
					);
				}

				$page_option_data[] = array(
					'page_option_id' => $page_option['page_option_id'],
					'option_id'         => $page_option['option_id'],
					'name'              => $page_option['name'],
					'type'              => $page_option['type'],
					'option_value'      => $page_option_value_data,
					'required'          => $page_option['required']
				);
			} else {
				$page_option_data[] = array(
					'page_option_id' => $page_option['page_option_id'],
					'option_id'         => $page_option['option_id'],
					'name'              => $page_option['name'],
					'type'              => $page_option['type'],
					'option_value'      => $page_option['option_value'],
					'required'          => $page_option['required']
				);
			}
      	}

		return $page_option_data;
	}

	public function getPageDiscounts($page_id) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_discount WHERE page_id = '" . (int)$page_id . "' AND customer_group_id = '" . (int)$customer_group_id . "' AND quantity > 1 AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity ASC, priority ASC, price ASC");

		return $query->rows;
	}

	public function getPageImages($page_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_image WHERE page_id = '" . (int)$page_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getPageRelated($page_id) {
		$page_data = array();
        $sql="SELECT * FROM " . DB_PREFIX . "page_related pr
		LEFT JOIN " . DB_PREFIX . "page p ON (pr.related_id = p.page_id)
		LEFT JOIN " . DB_PREFIX . "page_to_store p2s ON (p.page_id = p2s.page_id)
		 WHERE pr.page_id = '" . (int)$page_id . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$page_data[$result['related_id']] = $this->getPage($result['related_id']);
		}

		return $page_data;
	}

	public function getPageTags($page_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_tag WHERE page_id = '" . (int)$page_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->rows;
	}

	public function getPageLayoutId($page_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_to_layout WHERE page_id = '" . (int)$page_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return  $this->config->get('config_layout_page');
		}
	}

	public function getArticleies($page_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_to_article WHERE page_id = '" . (int)$page_id . "'");

		return $query->rows;
	}

	public function getTotalPages($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.page_id) AS total FROM " . DB_PREFIX . "page p
		LEFT JOIN " . DB_PREFIX . "page_description pd ON (p.page_id = pd.page_id)
		LEFT JOIN " . DB_PREFIX . "page_to_store p2s ON (p.page_id = p2s.page_id)";

		if (!empty($data['filter_article_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "page_to_article p2c ON (p.page_id = p2c.page_id)
					  LEFT JOIN " . DB_PREFIX . "article pb ON (p2c.article_id = pb.article_id)
			";
		}

		if (!empty($data['filter_tag'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "page_tag pt ON (p.page_id = pt.page_id)";
		}

		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', $data['filter_name']);

				foreach ($words as $word) {
					if (!empty($data['filter_description'])) {
						$implode[] = "LCASE(pd.name) LIKE '%" . $this->db->escape(utf8_strtolower($word)) . "%' OR LCASE(pd.description) LIKE '%" . $this->db->escape(utf8_strtolower($word)) . "%'";
					} else {
						$implode[] = "LCASE(pd.name) LIKE '%" . $this->db->escape(utf8_strtolower($word)) . "%'";
					}
				}

				if ($implode) {
					$sql .= " " . implode(" OR ", $implode) . "";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$implode = array();

				$words = explode(' ', $data['filter_tag']);

				foreach ($words as $word) {
					$implode[] = "LCASE(pt.tag) LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_tag'])) . "%' AND pt.language_id = '" . (int)$this->config->get('config_language_id') . "'";
				}

				if ($implode) {
					$sql .= " " . implode(" OR ", $implode) . "";
				}
			}

			$sql .= ")";
		}

		if (!empty($data['filter_article_id'])) {
			if (!empty($data['filter_sub_article'])) {
				$implode_data = array();

				$implode_data[] = "p2c.article_id = '" . (int)$data['filter_article_id'] . "'";

				$this->load->model('catalog/article');

				$articleies = $this->model_catalog_article->getArticleiesByParentId($data['filter_article_id']);

				foreach ($articleies as $article_id) {
					$implode_data[] = "p2c.article_id = '" . (int)$article_id . "'";
				}

				$sql .= " AND (" . implode(' OR ', $implode_data) . ")";
			} else {
				$sql .= " AND p2c.article_id = '" . (int)$data['filter_article_id'] . "'";
			}
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}


		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalPageSpecials() {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$query = $this->db->query("SELECT COUNT(DISTINCT ps.page_id) AS total FROM " . DB_PREFIX . "page_special ps LEFT JOIN " . DB_PREFIX . "page p ON (ps.page_id = p.page_id) LEFT JOIN " . DB_PREFIX . "page_to_store p2s ON (p.page_id = p2s.page_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW()))");

		if (isset($query->row['total'])) {
			return $query->row['total'];
		} else {
			return 0;
		}
	}
}
?>