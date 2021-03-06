<?php
class ModelCatalogRecord extends Model {
	public function updateViewed($record_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "record SET viewed = (viewed + 1) WHERE record_id = '" . (int)$record_id . "'");
	}

	public function getRecord($record_id) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer,   (SELECT price FROM " . DB_PREFIX . "record_discount pd2 WHERE pd2.record_id = p.record_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "record_special ps WHERE ps.record_id = p.record_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points FROM " . DB_PREFIX . "record_reward pr WHERE pr.record_id = p.record_id AND customer_group_id = '" . (int)$customer_group_id . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "comment r1 WHERE r1.record_id = p.record_id AND r1.status = '1' GROUP BY r1.record_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "comment r2 WHERE r2.record_id = p.record_id AND r2.status = '1' GROUP BY r2.record_id) AS comments, p.sort_order FROM " . DB_PREFIX . "record p LEFT JOIN " . DB_PREFIX . "record_description pd ON (p.record_id = pd.record_id) LEFT JOIN " . DB_PREFIX . "record_to_store p2s ON (p.record_id = p2s.record_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.record_id = '" . (int)$record_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			$query->row['price'] = ($query->row['discount'] ? $query->row['discount'] : $query->row['price']);
			$query->row['rating'] = (int)$query->row['rating'];

			return $query->row;
		} else {
			return false;
		}
	}

	public function getRecords($data = array()) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$cache = md5(http_build_query($data));

		$record_data = $this->cache->get('record.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$customer_group_id . '.' . $cache);

		if (!$record_data) {
			$sql = "SELECT p.record_id, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "comment rc WHERE rc.record_id = p.record_id AND rc.status = '1' GROUP BY rc.record_id) AS comments, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "comment r1 WHERE r1.record_id = p.record_id AND r1.status = '1' GROUP BY r1.record_id) AS rating FROM " . DB_PREFIX . "record p LEFT JOIN " . DB_PREFIX . "record_description pd ON (p.record_id = pd.record_id) LEFT JOIN " . DB_PREFIX . "record_to_store p2s ON (p.record_id = p2s.record_id)";

			if (!empty($data['filter_tag'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "record_tag pt ON (p.record_id = pt.record_id)";
			}

			if (!empty($data['filter_blog_id'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "record_to_blog p2c ON (p.record_id = p2c.record_id)";
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

			if (!empty($data['filter_blog_id'])) {
				if (!empty($data['filter_sub_blog'])) {
					$implode_data = array();

					$implode_data[] = "p2c.blog_id = '" . (int)$data['filter_blog_id'] . "'";

					$this->load->model('catalog/blog');

					$blogies = $this->model_catalog_blog->getBlogiesByParentId($data['filter_blog_id']);

					foreach ($blogies as $blog_id) {
						$implode_data[] = "p2c.blog_id = '" . (int)$blog_id . "'";
					}

					$sql .= " AND (" . implode(' OR ', $implode_data) . ")";
				} else {
					$sql .= " AND p2c.blog_id = '" . (int)$data['filter_blog_id'] . "'";
				}
			}

			if (!empty($data['filter_manufacturer_id'])) {
				$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
			}

			$sql .= " GROUP BY p.record_id";

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

			$record_data = array();

			$query = $this->db->query($sql);

			foreach ($query->rows as $result) {
				$record_data[$result['record_id']] = $this->getRecord($result['record_id']);
			}

			$this->cache->set('record.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$customer_group_id . '.' . $cache, $record_data);
		}

		return $record_data;
	}


	public function getRecordCategories($record_id) {
		$record_blog_data = array();
        $sql="SELECT * FROM " . DB_PREFIX . "record_to_blog WHERE record_id = '" . (int)$record_id . "'";
		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$record_blog_data[] = $result['blog_id'];
		}

		return $record_blog_data;
	}



	public function getRecordSpecials($data = array()) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$sql = "SELECT DISTINCT ps.record_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "comment r1 WHERE r1.record_id = ps.record_id AND r1.status = '1' GROUP BY r1.record_id) AS rating FROM " . DB_PREFIX . "record_special ps LEFT JOIN " . DB_PREFIX . "record p ON (ps.record_id = p.record_id) LEFT JOIN " . DB_PREFIX . "record_description pd ON (p.record_id = pd.record_id) LEFT JOIN " . DB_PREFIX . "record_to_store p2s ON (p.record_id = p2s.record_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) GROUP BY ps.record_id";

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

		$record_data = array();

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$record_data[$result['record_id']] = $this->getRecord($result['record_id']);
		}

		return $record_data;
	}

	public function getLatestRecords($limit) {
		$record_data = $this->cache->get('record.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$limit);

		if (!$record_data) {
			$query = $this->db->query("SELECT p.record_id FROM " . DB_PREFIX . "record p LEFT JOIN " . DB_PREFIX . "record_to_store p2s ON (p.record_id = p2s.record_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.date_added DESC LIMIT " . (int)$limit);

			foreach ($query->rows as $result) {
				$record_data[$result['record_id']] = $this->getRecord($result['record_id']);
			}

			$this->cache->set('record.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$limit, $record_data);
		}

		return $record_data;
	}

	public function getPopularRecords($limit) {
		$record_data = array();

		$query = $this->db->query("SELECT p.record_id FROM " . DB_PREFIX . "record p LEFT JOIN " . DB_PREFIX . "record_to_store p2s ON (p.record_id = p2s.record_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.viewed, p.date_added DESC LIMIT " . (int)$limit);

		foreach ($query->rows as $result) {
			$record_data[$result['record_id']] = $this->getRecord($result['record_id']);
		}

		return $record_data;
	}

	public function getBestSellerRecords($limit) {
		$record_data = $this->cache->get('record.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$limit);

		if (!$record_data) {
			$record_data = array();

			$query = $this->db->query("SELECT op.record_id, COUNT(*) AS total FROM " . DB_PREFIX . "order_record op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "record` p ON (op.record_id = p.record_id) LEFT JOIN " . DB_PREFIX . "record_to_store p2s ON (p.record_id = p2s.record_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.record_id ORDER BY total DESC LIMIT " . (int)$limit);

			foreach ($query->rows as $result) {
				$record_data[$result['record_id']] = $this->getRecord($result['record_id']);
			}

			$this->cache->set('record.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . (int)$limit, $record_data);
		}

		return $record_data;
	}

	public function getRecordAttributes($record_id) {
		$record_attribute_group_data = array();

		$record_attribute_group_query = $this->db->query("SELECT ag.attribute_group_id, agd.name FROM " . DB_PREFIX . "record_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_group ag ON (a.attribute_group_id = ag.attribute_group_id) LEFT JOIN " . DB_PREFIX . "attribute_group_description agd ON (ag.attribute_group_id = agd.attribute_group_id) WHERE pa.record_id = '" . (int)$record_id . "' AND agd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY ag.attribute_group_id ORDER BY ag.sort_order, agd.name");

		foreach ($record_attribute_group_query->rows as $record_attribute_group) {
			$record_attribute_data = array();

			$record_attribute_query = $this->db->query("SELECT a.attribute_id, ad.name, pa.text FROM " . DB_PREFIX . "record_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.record_id = '" . (int)$record_id . "' AND a.attribute_group_id = '" . (int)$record_attribute_group['attribute_group_id'] . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pa.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name");

			foreach ($record_attribute_query->rows as $record_attribute) {
				$record_attribute_data[] = array(
					'attribute_id' => $record_attribute['attribute_id'],
					'name'         => $record_attribute['name'],
					'text'         => $record_attribute['text']
				);
			}

			$record_attribute_group_data[] = array(
				'attribute_group_id' => $record_attribute_group['attribute_group_id'],
				'name'               => $record_attribute_group['name'],
				'attribute'          => $record_attribute_data
			);
		}

		return $record_attribute_group_data;
	}

	public function getRecordOptions($record_id) {
		$record_option_data = array();

		$record_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "record_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.record_id = '" . (int)$record_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

		foreach ($record_option_query->rows as $record_option) {
			if ($record_option['type'] == 'select' || $record_option['type'] == 'radio' || $record_option['type'] == 'checkbox' || $record_option['type'] == 'image') {
				$record_option_value_data = array();

				$record_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "record_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.record_id = '" . (int)$record_id . "' AND pov.record_option_id = '" . (int)$record_option['record_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order");

				foreach ($record_option_value_query->rows as $record_option_value) {
					$record_option_value_data[] = array(
						'record_option_value_id' => $record_option_value['record_option_value_id'],
						'option_value_id'         => $record_option_value['option_value_id'],
						'name'                    => $record_option_value['name'],
						'image'                   => $record_option_value['image'],
						'quantity'                => $record_option_value['quantity'],
						'subtract'                => $record_option_value['subtract'],
						'price'                   => $record_option_value['price'],
						'price_prefix'            => $record_option_value['price_prefix'],
						'weight'                  => $record_option_value['weight'],
						'weight_prefix'           => $record_option_value['weight_prefix']
					);
				}

				$record_option_data[] = array(
					'record_option_id' => $record_option['record_option_id'],
					'option_id'         => $record_option['option_id'],
					'name'              => $record_option['name'],
					'type'              => $record_option['type'],
					'option_value'      => $record_option_value_data,
					'required'          => $record_option['required']
				);
			} else {
				$record_option_data[] = array(
					'record_option_id' => $record_option['record_option_id'],
					'option_id'         => $record_option['option_id'],
					'name'              => $record_option['name'],
					'type'              => $record_option['type'],
					'option_value'      => $record_option['option_value'],
					'required'          => $record_option['required']
				);
			}
      	}

		return $record_option_data;
	}

	public function getRecordDiscounts($record_id) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "record_discount WHERE record_id = '" . (int)$record_id . "' AND customer_group_id = '" . (int)$customer_group_id . "' AND quantity > 1 AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity ASC, priority ASC, price ASC");

		return $query->rows;
	}

	public function getRecordImages($record_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "record_image WHERE record_id = '" . (int)$record_id . "' ORDER BY sort_order ASC");

		return $query->rows;
	}

	public function getRecordRelated($record_id) {
		$record_data = array();
        $sql="SELECT * FROM " . DB_PREFIX . "record_related pr
		LEFT JOIN " . DB_PREFIX . "record p ON (pr.related_id = p.record_id)
		LEFT JOIN " . DB_PREFIX . "record_to_store p2s ON (p.record_id = p2s.record_id)
		 WHERE pr.record_id = '" . (int)$record_id . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$record_data[$result['related_id']] = $this->getRecord($result['related_id']);
		}

		return $record_data;
	}

	public function getRecordTags($record_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "record_tag WHERE record_id = '" . (int)$record_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->rows;
	}

	public function getRecordLayoutId($record_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "record_to_layout WHERE record_id = '" . (int)$record_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return  $this->config->get('config_layout_record');
		}
	}

	public function getBlogies($record_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "record_to_blog WHERE record_id = '" . (int)$record_id . "'");

		return $query->rows;
	}

	public function getTotalRecords($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.record_id) AS total FROM " . DB_PREFIX . "record p
		LEFT JOIN " . DB_PREFIX . "record_description pd ON (p.record_id = pd.record_id)
		LEFT JOIN " . DB_PREFIX . "record_to_store p2s ON (p.record_id = p2s.record_id)";

		if (!empty($data['filter_blog_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "record_to_blog p2c ON (p.record_id = p2c.record_id)
					  LEFT JOIN " . DB_PREFIX . "blog pb ON (p2c.blog_id = pb.blog_id)
			";
		}

		if (!empty($data['filter_tag'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "record_tag pt ON (p.record_id = pt.record_id)";
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

		if (!empty($data['filter_blog_id'])) {
			if (!empty($data['filter_sub_blog'])) {
				$implode_data = array();

				$implode_data[] = "p2c.blog_id = '" . (int)$data['filter_blog_id'] . "'";

				$this->load->model('catalog/blog');

				$blogies = $this->model_catalog_blog->getBlogiesByParentId($data['filter_blog_id']);

				foreach ($blogies as $blog_id) {
					$implode_data[] = "p2c.blog_id = '" . (int)$blog_id . "'";
				}

				$sql .= " AND (" . implode(' OR ', $implode_data) . ")";
			} else {
				$sql .= " AND p2c.blog_id = '" . (int)$data['filter_blog_id'] . "'";
			}
		}

		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}


		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalRecordSpecials() {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}

		$query = $this->db->query("SELECT COUNT(DISTINCT ps.record_id) AS total FROM " . DB_PREFIX . "record_special ps LEFT JOIN " . DB_PREFIX . "record p ON (ps.record_id = p.record_id) LEFT JOIN " . DB_PREFIX . "record_to_store p2s ON (p.record_id = p2s.record_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW()))");

		if (isset($query->row['total'])) {
			return $query->row['total'];
		} else {
			return 0;
		}
	}
}
?>