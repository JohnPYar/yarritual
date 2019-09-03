<?php
class ModelCatalogPage extends Model {
	public function addPage($data) {

	   if ($data['sort_order']='')
	   {
	   	$sort_order=(int)$data['sort_order'];
	   }
	   else
	   {

		if (isset($data['page_article'])) {
			foreach ($data['page_article'] as $article_id)
			{
		          $sql="SELECT MAX(sort_order) as maxis
			     FROM " . DB_PREFIX . "page re
			     INNER  JOIN " . DB_PREFIX . "page_to_article r_t_b ON r_t_b.page_id=re.page_id WHERE r_t_b.article_id='".(int)$article_id."'
			     ";

			     $query = $this->db->query($sql);

				 $sort_order= (int)$query->row['maxis']+1;



			}
		}
		else
		{
		 $sort_order=1;
		}
	   }



		$sql="INSERT INTO " . DB_PREFIX . "page SET  date_available = '" . $this->db->escape($data['date_available']) . "',
		commentpage_status = '" . (int)$data['commentpage_status'] . "',
		commentpage_status_reg = '" . (int)$data['commentpage_status_reg'] . "',
		commentpage_status_now = '" . (int)$data['commentpage_status_now'] . "',
		status = '" . (int)$data['status'] . "',
		sort_order = '" . $sort_order . "', date_added = NOW()";

		$this->db->query($sql);

		$page_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "page SET image = '" . $this->db->escape($data['image']) . "' WHERE page_id = '" . (int)$page_id . "'");
		}

		foreach ($data['page_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "page_description SET page_id = '" . (int)$page_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		if (isset($data['page_store'])) {
			foreach ($data['page_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_to_store SET page_id = '" . (int)$page_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['page_attribute'])) {
			foreach ($data['page_attribute'] as $page_attribute) {
				if ($page_attribute['attribute_id']) {
					$this->db->query("DELETE FROM " . DB_PREFIX . "page_attribute WHERE page_id = '" . (int)$page_id . "' AND attribute_id = '" . (int)$page_attribute['attribute_id'] . "'");

					foreach ($page_attribute['page_attribute_description'] as $language_id => $page_attribute_description) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "page_attribute SET page_id = '" . (int)$page_id . "', attribute_id = '" . (int)$page_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($page_attribute_description['text']) . "'");
					}
				}
			}
		}

		if (isset($data['page_option'])) {
			foreach ($data['page_option'] as $page_option) {
				if ($page_option['type'] == 'select' || $page_option['type'] == 'radio' || $page_option['type'] == 'checkbox' || $page_option['type'] == 'image') {
					$this->db->query("INSERT INTO " . DB_PREFIX . "page_option SET page_id = '" . (int)$page_id . "', option_id = '" . (int)$page_option['option_id'] . "', required = '" . (int)$page_option['required'] . "'");

					$page_option_id = $this->db->getLastId();

					if (isset($page_option['page_option_value'])) {
						foreach ($page_option['page_option_value'] as $page_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "page_option_value SET page_option_id = '" . (int)$page_option_id . "', page_id = '" . (int)$page_id . "', option_id = '" . (int)$page_option['option_id'] . "', option_value_id = '" . $this->db->escape($page_option_value['option_value_id']) . "', quantity = '" . (int)$page_option_value['quantity'] . "', subtract = '" . (int)$page_option_value['subtract'] . "', price = '" . (float)$page_option_value['price'] . "', price_prefix = '" . $this->db->escape($page_option_value['price_prefix']) . "', points = '" . (int)$page_option_value['points'] . "', points_prefix = '" . $this->db->escape($page_option_value['points_prefix']) . "', weight = '" . (float)$page_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($page_option_value['weight_prefix']) . "'");
						}
					}
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "page_option SET page_id = '" . (int)$page_id . "', option_id = '" . (int)$page_option['option_id'] . "', option_value = '" . $this->db->escape($page_option['option_value']) . "', required = '" . (int)$page_option['required'] . "'");
				}
			}
		}

		if (isset($data['page_discount'])) {
			foreach ($data['page_discount'] as $page_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_discount SET page_id = '" . (int)$page_id . "', customer_group_id = '" . (int)$page_discount['customer_group_id'] . "', quantity = '" . (int)$page_discount['quantity'] . "', priority = '" . (int)$page_discount['priority'] . "', price = '" . (float)$page_discount['price'] . "', date_start = '" . $this->db->escape($page_discount['date_start']) . "', date_end = '" . $this->db->escape($page_discount['date_end']) . "'");
			}
		}

		if (isset($data['page_special'])) {
			foreach ($data['page_special'] as $page_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_special SET page_id = '" . (int)$page_id . "', customer_group_id = '" . (int)$page_special['customer_group_id'] . "', priority = '" . (int)$page_special['priority'] . "', price = '" . (float)$page_special['price'] . "', date_start = '" . $this->db->escape($page_special['date_start']) . "', date_end = '" . $this->db->escape($page_special['date_end']) . "'");
			}
		}

		if (isset($data['page_image'])) {
			foreach ($data['page_image'] as $page_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_image SET page_id = '" . (int)$page_id . "', image = '" . $this->db->escape($page_image['image']) . "', sort_order = '" . (int)$page_image['sort_order'] . "'");
			}
		}

		if (isset($data['page_download'])) {
			foreach ($data['page_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_to_download SET page_id = '" . (int)$page_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		if (isset($data['page_article'])) {
			foreach ($data['page_article'] as $article_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_to_article SET page_id = '" . (int)$page_id . "', article_id = '" . (int)$article_id . "'");
			}
		}

		if (isset($data['page_related'])) {
			foreach ($data['page_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "page_related WHERE page_id = '" . (int)$page_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_related SET page_id = '" . (int)$page_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "page_related WHERE page_id = '" . (int)$related_id . "' AND related_id = '" . (int)$page_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_related SET page_id = '" . (int)$related_id . "', related_id = '" . (int)$page_id . "'");
			}
		}

		if (isset($data['page_reward'])) {
			foreach ($data['page_reward'] as $customer_group_id => $page_reward) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_reward SET page_id = '" . (int)$page_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$page_reward['points'] . "'");
			}
		}

		if (isset($data['page_layout'])) {
			foreach ($data['page_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "page_to_layout SET page_id = '" . (int)$page_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}

		foreach ($data['page_tag'] as $language_id => $value) {
			if ($value) {
				$tags = explode(',', $value);

				foreach ($tags as $tag) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "page_tag SET page_id = '" . (int)$page_id . "', language_id = '" . (int)$language_id . "', tag = '" . $this->db->escape(trim($tag)) . "'");
				}
			}
		}

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'page_id=" . (int)$page_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('page');
	}

	public function editPage($page_id, $data) {

		$sql="UPDATE " . DB_PREFIX . "page SET  date_available = '" . $this->db->escape($data['date_available']) . "',
		commentpage_status = '" . (int)$data['commentpage_status'] . "',
		commentpage_status_reg = '" . (int)$data['commentpage_status_reg'] . "',
		commentpage_status_now = '" . (int)$data['commentpage_status_now'] . "',
		status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "',
		date_modified = NOW() WHERE page_id = '" . (int)$page_id . "'";

//print_r($sql);

		$this->db->query($sql);

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "page SET image = '" . $this->db->escape($data['image']) . "' WHERE page_id = '" . (int)$page_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "page_description WHERE page_id = '" . (int)$page_id . "'");

		foreach ($data['page_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "page_description SET page_id = '" . (int)$page_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "page_to_store WHERE page_id = '" . (int)$page_id . "'");

		if (isset($data['page_store'])) {
			foreach ($data['page_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_to_store SET page_id = '" . (int)$page_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "page_attribute WHERE page_id = '" . (int)$page_id . "'");

		if (!empty($data['page_attribute'])) {
			foreach ($data['page_attribute'] as $page_attribute) {
				if ($page_attribute['attribute_id']) {
					$this->db->query("DELETE FROM " . DB_PREFIX . "page_attribute WHERE page_id = '" . (int)$page_id . "' AND attribute_id = '" . (int)$page_attribute['attribute_id'] . "'");

					foreach ($page_attribute['page_attribute_description'] as $language_id => $page_attribute_description) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "page_attribute SET page_id = '" . (int)$page_id . "', attribute_id = '" . (int)$page_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($page_attribute_description['text']) . "'");
					}
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "page_option WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_option_value WHERE page_id = '" . (int)$page_id . "'");

		if (isset($data['page_option'])) {
			foreach ($data['page_option'] as $page_option) {
				if ($page_option['type'] == 'select' || $page_option['type'] == 'radio' || $page_option['type'] == 'checkbox' || $page_option['type'] == 'image') {
					$this->db->query("INSERT INTO " . DB_PREFIX . "page_option SET page_option_id = '" . (int)$page_option['page_option_id'] . "', page_id = '" . (int)$page_id . "', option_id = '" . (int)$page_option['option_id'] . "', required = '" . (int)$page_option['required'] . "'");

					$page_option_id = $this->db->getLastId();

					if (isset($page_option['page_option_value'])) {
						foreach ($page_option['page_option_value'] as $page_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "page_option_value SET page_option_value_id = '" . (int)$page_option_value['page_option_value_id'] . "', page_option_id = '" . (int)$page_option_id . "', page_id = '" . (int)$page_id . "', option_id = '" . (int)$page_option['option_id'] . "', option_value_id = '" . $this->db->escape($page_option_value['option_value_id']) . "', quantity = '" . (int)$page_option_value['quantity'] . "', subtract = '" . (int)$page_option_value['subtract'] . "', price = '" . (float)$page_option_value['price'] . "', price_prefix = '" . $this->db->escape($page_option_value['price_prefix']) . "', points = '" . (int)$page_option_value['points'] . "', points_prefix = '" . $this->db->escape($page_option_value['points_prefix']) . "', weight = '" . (float)$page_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($page_option_value['weight_prefix']) . "'");
						}
					}
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "page_option SET page_option_id = '" . (int)$page_option['page_option_id'] . "', page_id = '" . (int)$page_id . "', option_id = '" . (int)$page_option['option_id'] . "', option_value = '" . $this->db->escape($page_option['option_value']) . "', required = '" . (int)$page_option['required'] . "'");
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "page_discount WHERE page_id = '" . (int)$page_id . "'");

		if (isset($data['page_discount'])) {
			foreach ($data['page_discount'] as $page_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_discount SET page_id = '" . (int)$page_id . "', customer_group_id = '" . (int)$page_discount['customer_group_id'] . "', quantity = '" . (int)$page_discount['quantity'] . "', priority = '" . (int)$page_discount['priority'] . "', price = '" . (float)$page_discount['price'] . "', date_start = '" . $this->db->escape($page_discount['date_start']) . "', date_end = '" . $this->db->escape($page_discount['date_end']) . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "page_special WHERE page_id = '" . (int)$page_id . "'");

		if (isset($data['page_special'])) {
			foreach ($data['page_special'] as $page_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_special SET page_id = '" . (int)$page_id . "', customer_group_id = '" . (int)$page_special['customer_group_id'] . "', priority = '" . (int)$page_special['priority'] . "', price = '" . (float)$page_special['price'] . "', date_start = '" . $this->db->escape($page_special['date_start']) . "', date_end = '" . $this->db->escape($page_special['date_end']) . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "page_image WHERE page_id = '" . (int)$page_id . "'");

		if (isset($data['page_image'])) {
			foreach ($data['page_image'] as $page_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_image SET page_id = '" . (int)$page_id . "', image = '" . $this->db->escape($page_image['image']) . "', sort_order = '" . (int)$page_image['sort_order'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "page_to_download WHERE page_id = '" . (int)$page_id . "'");

		if (isset($data['page_download'])) {
			foreach ($data['page_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_to_download SET page_id = '" . (int)$page_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "page_to_article WHERE page_id = '" . (int)$page_id . "'");

		if (isset($data['page_article'])) {
			foreach ($data['page_article'] as $article_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_to_article SET page_id = '" . (int)$page_id . "', article_id = '" . (int)$article_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "page_related WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_related WHERE related_id = '" . (int)$page_id . "'");

		if (isset($data['page_related'])) {
			foreach ($data['page_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "page_related WHERE page_id = '" . (int)$page_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_related SET page_id = '" . (int)$page_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "page_related WHERE page_id = '" . (int)$related_id . "' AND related_id = '" . (int)$page_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_related SET page_id = '" . (int)$related_id . "', related_id = '" . (int)$page_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "page_reward WHERE page_id = '" . (int)$page_id . "'");

		if (isset($data['page_reward'])) {
			foreach ($data['page_reward'] as $customer_group_id => $value) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "page_reward SET page_id = '" . (int)$page_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$value['points'] . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "page_to_layout WHERE page_id = '" . (int)$page_id . "'");

		if (isset($data['page_layout'])) {
			foreach ($data['page_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "page_to_layout SET page_id = '" . (int)$page_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "page_tag WHERE page_id = '" . (int)$page_id. "'");

		foreach ($data['page_tag'] as $language_id => $value) {
			if ($value) {
				$tags = explode(',', $value);

				foreach ($tags as $tag) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "page_tag SET page_id = '" . (int)$page_id . "', language_id = '" . (int)$language_id . "', tag = '" . $this->db->escape(trim($tag)) . "'");
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'page_id=" . (int)$page_id. "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'page_id=" . (int)$page_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('page');
	}

	public function copyPage($page_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "page p LEFT JOIN " . DB_PREFIX . "page_description pd ON (p.page_id = pd.page_id) WHERE p.page_id = '" . (int)$page_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		if ($query->num_rows) {
			$data = array();

			$data = $query->row;

			$data['keyword'] = '';

			$data['status'] = '0';

			$data['commentpage_status'] = '0';
			$data['commentpage_status_reg'] = '0';
			$data['commentpage_status_now'] = '0';

			$data = array_merge($data, array('page_attribute' => $this->getPageAttributes($page_id)));
			$data = array_merge($data, array('page_description' => $this->getPageDescriptions($page_id)));
			$data = array_merge($data, array('page_discount' => $this->getPageDiscounts($page_id)));
			$data = array_merge($data, array('page_image' => $this->getPageImages($page_id)));

			$data['page_image'] = array();

			$results = $this->getPageImages($page_id);

			foreach ($results as $result) {
				$data['page_image'][] = $result['image'];
			}

			$data = array_merge($data, array('page_option' => $this->getPageOptions($page_id)));
			$data = array_merge($data, array('page_related' => $this->getPageRelated($page_id)));
			$data = array_merge($data, array('page_reward' => $this->getPageRewards($page_id)));
			$data = array_merge($data, array('page_special' => $this->getPageSpecials($page_id)));
			$data = array_merge($data, array('page_tag' => $this->getPageTags($page_id)));
			$data = array_merge($data, array('page_article' => $this->getPageCategories($page_id)));
			$data = array_merge($data, array('page_download' => $this->getPageDownloads($page_id)));
			$data = array_merge($data, array('page_layout' => $this->getPageLayouts($page_id)));
			$data = array_merge($data, array('page_store' => $this->getPageStores($page_id)));

			$this->addPage($data);
		}
	}

	public function deletePage($page_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "page WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_attribute WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_description WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_discount WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_image WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_option WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_option_value WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_related WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_related WHERE related_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_reward WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_special WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_tag WHERE page_id='" . (int)$page_id. "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_to_article WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_to_download WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_to_layout WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "page_to_store WHERE page_id = '" . (int)$page_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "commentpage WHERE page_id = '" . (int)$page_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'page_id=" . (int)$page_id. "'");

		$this->cache->delete('page');
	}

	public function getPage($page_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'page_id=" . (int)$page_id . "') AS keyword FROM " . DB_PREFIX . "page p LEFT JOIN " . DB_PREFIX . "page_description pd ON (p.page_id = pd.page_id) WHERE p.page_id = '" . (int)$page_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getPages($data = array()) {
		if ($data) {
			$sql = "SELECT p.*,pd.*, bd.name as article_name FROM " . DB_PREFIX . "page p
			LEFT JOIN " . DB_PREFIX . "page_description pd ON (p.page_id = pd.page_id)
			LEFT JOIN " . DB_PREFIX . "page_to_article p2c ON (p.page_id = p2c.page_id)
			LEFT JOIN " . DB_PREFIX . "article_description bd ON (p2c.article_id = bd.article_id)
			";

			/*
			if (!empty($data['filter_article_id'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "page_to_article p2c ON (p.page_id = p2c.page_id)";
			}
            */
			$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

			if (!empty($data['filter_name'])) {
				$sql .= " AND LCASE(pd.name) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
			}

			if (!empty($data['filter_article'])) {
				$sql .= " AND LCASE(bd.name) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_article'])) . "%'";
			}

			if (!empty($data['filter_price'])) {
				$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
			}

			if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
				$sql .= " AND p.quantity = '" . $this->db->escape($data['filter_quantity']) . "'";
			}

			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
			}

			if (!empty($data['filter_article_id'])) {
				if (!empty($data['filter_sub_article'])) {
					$implode_data = array();

					$implode_data[] = "article_id = '" . (int)$data['filter_article_id'] . "'";

					$this->load->model('catalog/article');

					$categories = $this->model_catalog_article->getCategories($data['filter_article_id']);

					foreach ($categories as $article) {
						$implode_data[] = "p2c.article_id = '" . (int)$article['article_id'] . "'";
					}

					$sql .= " AND (" . implode(' OR ', $implode_data) . ")";
				} else {
					$sql .= " AND p2c.article_id = '" . (int)$data['filter_article_id'] . "'";
				}
			}

			$sql .= " GROUP BY p.page_id";

			$sort_data = array(
				'pd.name',
				'p.model',
				'p.price',
				'p.quantity',
				'p.status',
				'p.commentpage_status',
				'p.sort_order'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY pd.name";
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

			$query = $this->db->query($sql);

			return $query->rows;
		} else {
			$page_data = $this->cache->get('page.' . (int)$this->config->get('config_language_id'));

			if (!$page_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page p LEFT JOIN " . DB_PREFIX . "page_description pd ON (p.page_id = pd.page_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY pd.name ASC");

				$page_data = $query->rows;

				$this->cache->set('page.' . (int)$this->config->get('config_language_id'), $page_data);
			}

			return $page_data;
		}
	}

	public function getPagesByArticleId($article_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page p LEFT JOIN " . DB_PREFIX . "page_description pd ON (p.page_id = pd.page_id) LEFT JOIN " . DB_PREFIX . "page_to_article p2c ON (p.page_id = p2c.page_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.article_id = '" . (int)$article_id . "' ORDER BY pd.name ASC");

		return $query->rows;
	}

	public function getPageDescriptions($page_id) {
		$page_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_description WHERE page_id = '" . (int)$page_id . "'");

		foreach ($query->rows as $result) {
			$page_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description']
			);
		}

		return $page_description_data;
	}

	public function getPageAttributes($page_id) {
		$page_attribute_data = array();

		$page_attribute_query = $this->db->query("SELECT pa.attribute_id, ad.name FROM " . DB_PREFIX . "page_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.page_id = '" . (int)$page_id . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY pa.attribute_id");

		foreach ($page_attribute_query->rows as $page_attribute) {
			$page_attribute_description_data = array();

			$page_attribute_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_attribute WHERE page_id = '" . (int)$page_id . "' AND attribute_id = '" . (int)$page_attribute['attribute_id'] . "'");

			foreach ($page_attribute_description_query->rows as $page_attribute_description) {
				$page_attribute_description_data[$page_attribute_description['language_id']] = array('text' => $page_attribute_description['text']);
			}

			$page_attribute_data[] = array(
				'attribute_id'                  => $page_attribute['attribute_id'],
				'name'                          => $page_attribute['name'],
				'page_attribute_description' => $page_attribute_description_data
			);
		}

		return $page_attribute_data;
	}

	public function getPageOptions($page_id) {
		$page_option_data = array();

		$page_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.page_id = '" . (int)$page_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		foreach ($page_option_query->rows as $page_option) {
			if ($page_option['type'] == 'select' || $page_option['type'] == 'radio' || $page_option['type'] == 'checkbox' || $page_option['type'] == 'image') {
				$page_option_value_data = array();

				$page_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.page_option_id = '" . (int)$page_option['page_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

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
						'points'                  => $page_option_value['points'],
						'points_prefix'           => $page_option_value['points_prefix'],
						'weight'                  => $page_option_value['weight'],
						'weight_prefix'           => $page_option_value['weight_prefix']
					);
				}

				$page_option_data[] = array(
					'page_option_id'    => $page_option['page_option_id'],
					'option_id'            => $page_option['option_id'],
					'name'                 => $page_option['name'],
					'type'                 => $page_option['type'],
					'page_option_value' => $page_option_value_data,
					'required'             => $page_option['required']
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

	public function getPageImages($page_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_image WHERE page_id = '" . (int)$page_id . "'");

		return $query->rows;
	}

	public function getPageDiscounts($page_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_discount WHERE page_id = '" . (int)$page_id . "' ORDER BY quantity, priority, price");

		return $query->rows;
	}

	public function getPageSpecials($page_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_special WHERE page_id = '" . (int)$page_id . "' ORDER BY priority, price");

		return $query->rows;
	}

	public function getPageRewards($page_id) {
		$page_reward_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_reward WHERE page_id = '" . (int)$page_id . "'");

		foreach ($query->rows as $result) {
			$page_reward_data[$result['customer_group_id']] = array('points' => $result['points']);
		}

		return $page_reward_data;
	}

	public function getPageDownloads($page_id) {
		$page_download_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_to_download WHERE page_id = '" . (int)$page_id . "'");

		foreach ($query->rows as $result) {
			$page_download_data[] = $result['download_id'];
		}

		return $page_download_data;
	}

	public function getPageStores($page_id) {
		$page_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_to_store WHERE page_id = '" . (int)$page_id . "'");

		foreach ($query->rows as $result) {
			$page_store_data[] = $result['store_id'];
		}

		return $page_store_data;
	}

	public function getPageLayouts($page_id) {
		$page_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_to_layout WHERE page_id = '" . (int)$page_id . "'");

		foreach ($query->rows as $result) {
			$page_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $page_layout_data;
	}

	public function getPageCategories($page_id) {
		$page_article_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_to_article WHERE page_id = '" . (int)$page_id . "'");

		foreach ($query->rows as $result) {
			$page_article_data[] = $result['article_id'];
		}

		return $page_article_data;
	}

	public function getPageRelated($page_id) {
		$page_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_related WHERE page_id = '" . (int)$page_id . "'");

		foreach ($query->rows as $result) {
			$page_related_data[] = $result['related_id'];
		}

		return $page_related_data;
	}

	public function getPageTags($page_id) {
		$page_tag_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "page_tag WHERE page_id = '" . (int)$page_id . "'");

		$tag_data = array();

		foreach ($query->rows as $result) {
			$tag_data[$result['language_id']][] = $result['tag'];
		}

		foreach ($tag_data as $language => $tags) {
			$page_tag_data[$language] = implode(',', $tags);
		}

		return $page_tag_data;
	}

	public function getTotalPages($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.page_id) AS total FROM " . DB_PREFIX . "page p LEFT JOIN " . DB_PREFIX . "page_description pd ON (p.page_id = pd.page_id)";

		if (!empty($data['filter_article_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "page_to_article p2c ON (p.page_id = p2c.page_id)";
		}

		$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND LCASE(pd.name) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
		}
       /*
		if (!empty($data['filter_model'])) {
			$sql .= " AND LCASE(p.model) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_model'])) . "%'";
		}
        */
		if (!empty($data['filter_price'])) {
			$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}

		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			$sql .= " AND p.quantity = '" . $this->db->escape($data['filter_quantity']) . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_article_id'])) {
			if (!empty($data['filter_sub_article'])) {
				$implode_data = array();

				$implode_data[] = "p2c.article_id = '" . (int)$data['filter_article_id'] . "'";

				$this->load->model('catalog/article');

				$categories = $this->model_catalog_article->getCategories($data['filter_article_id']);

				foreach ($categories as $article) {
					$implode_data[] = "p2c.article_id = '" . (int)$article['article_id'] . "'";
				}

				$sql .= " AND (" . implode(' OR ', $implode_data) . ")";
			} else {
				$sql .= " AND p2c.article_id = '" . (int)$data['filter_article_id'] . "'";
			}
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalPagesByTaxClassId($tax_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "page WHERE tax_class_id = '" . (int)$tax_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalPagesByStockStatusId($stock_status_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "page WHERE stock_status_id = '" . (int)$stock_status_id . "'");

		return $query->row['total'];
	}

	public function getTotalPagesByWeightClassId($weight_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "page WHERE weight_class_id = '" . (int)$weight_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalPagesByLengthClassId($length_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "page WHERE length_class_id = '" . (int)$length_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalPagesByDownloadId($download_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "page_to_download WHERE download_id = '" . (int)$download_id . "'");

		return $query->row['total'];
	}

	public function getTotalPagesByManufacturerId($manufacturer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "page WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		return $query->row['total'];
	}

	public function getTotalPagesByAttributeId($attribute_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "page_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");

		return $query->row['total'];
	}

	public function getTotalPagesByOptionId($option_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "page_option WHERE option_id = '" . (int)$option_id . "'");

		return $query->row['total'];
	}

	public function getTotalPagesByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "page_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}
}
?>