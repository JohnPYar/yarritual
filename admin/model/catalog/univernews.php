<?php

class ModelCatalogunivernews extends Model {

	public function addunivernews($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "univernews SET status = '" . (int)$data['status'] . "', date_added = now()");
	
		$univernews_id = $this->db->getLastId();
	
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "univernews SET image = '" . $this->db->escape($data['image']) . "' WHERE univernews_id = '" . (int)$univernews_id . "'");
		}
	
		if (isset($data['date_added'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "univernews SET date_added = '" . $this->db->escape($data['date_added']) . "' WHERE univernews_id = '" . (int)$univernews_id . "'");
		}
	
		foreach ($data['univernews_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "univernews_description SET univernews_id = '" . (int)$univernews_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
	
		if (isset($data['univernews_store'])) {
			foreach ($data['univernews_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "univernews_to_store SET univernews_id = '" . (int)$univernews_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'univernews_id=" . (int)$univernews_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
	
		$this->cache->delete('univernews');
	}

	public function editunivernews($univernews_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "univernews SET status = '" . (int)$data['status'] . "' WHERE univernews_id = '" . (int)$univernews_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "univernews SET image = '" . $this->db->escape($data['image']) . "' WHERE univernews_id = '" . (int)$univernews_id . "'");
		}
		
		if (isset($data['date_added'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "univernews SET date_added = '" . $this->db->escape($data['date_added']) . "' WHERE univernews_id = '" . (int)$univernews_id . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "univernews_description WHERE univernews_id = '" . (int)$univernews_id . "'");
	
		foreach ($data['univernews_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "univernews_description SET univernews_id = '" . (int)$univernews_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
	
		$this->db->query("DELETE FROM " . DB_PREFIX . "univernews_to_store WHERE univernews_id = '" . (int)$univernews_id . "'");
	
		if (isset($data['univernews_store'])) {		
			foreach ($data['univernews_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "univernews_to_store SET univernews_id = '" . (int)$univernews_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
	
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'univernews_id=" . (int)$univernews_id . "'");
	
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'univernews_id=" . (int)$univernews_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
	
		$this->cache->delete('univernews');
	}

	public function deleteunivernews($univernews_id) { 
		$this->db->query("DELETE FROM " . DB_PREFIX . "univernews WHERE univernews_id = '" . (int)$univernews_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "univernews_description WHERE univernews_id = '" . (int)$univernews_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "univernews_to_store WHERE univernews_id = '" . (int)$univernews_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'univernews_id=" . (int)$univernews_id . "'");
	
		$this->cache->delete('univernews');
	}

	public function getunivernewsStory($univernews_id) { 
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'univernews_id=" . (int)$univernews_id . "') AS keyword FROM " . DB_PREFIX . "univernews n LEFT JOIN " . DB_PREFIX . "univernews_description nd ON (n.univernews_id = nd.univernews_id) WHERE n.univernews_id = '" . (int)$univernews_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
	
		return $query->row;
	}

	public function getunivernewsDescriptions($univernews_id) { 
		$univernews_description_data = array();
	
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "univernews_description WHERE univernews_id = '" . (int)$univernews_id . "'");
	
		foreach ($query->rows as $result) {
			$univernews_description_data[$result['language_id']] = array(
				'title'            			=> $result['title'],
				'meta_description' 	=> $result['meta_description'],
				'meta_keyword' 	=> $result['meta_keyword'],
				'description'      		=> $result['description']
			);
		}
	
		return $univernews_description_data;
	}

	public function getunivernewsStores($univernews_id) { 
		$univernewspage_store_data = array();
	
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "univernews_to_store WHERE univernews_id = '" . (int)$univernews_id . "'");
		
		foreach ($query->rows as $result) {
			$univernewspage_store_data[] = $result['store_id'];
		}
	
		return $univernewspage_store_data;
	}

	public function getunivernews() { 
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "univernews n LEFT JOIN " . DB_PREFIX . "univernews_description nd ON (n.univernews_id = nd.univernews_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY n.date_added");

		return $query->rows;
	}

	public function getTotalunivernews() { 
		$this->checkunivernews();
	
     	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "univernews");
	
		return $query->row['total'];
	}

	public function checkunivernews() { 
		$create_univernews = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "univernews` (`univernews_id` int(11) NOT NULL auto_increment, `status` int(1) NOT NULL default '0', `image` VARCHAR(255) COLLATE utf8_general_ci default NULL, `image_size` int(1) NOT NULL default '0', `date_added` date default NULL, `viewed` int(5) NOT NULL DEFAULT '0', PRIMARY KEY (`univernews_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
		$this->db->query($create_univernews);
	
		$create_univernews_descriptions = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "univernews_description` (`univernews_id` int(11) NOT NULL default '0', `language_id` int(11) NOT NULL default '0', `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `meta_description` VARCHAR(255) COLLATE utf8_general_ci NOT NULL, `description` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `meta_keyword` varchar(255) COLLATE utf8_general_ci NOT NULL, PRIMARY KEY (`univernews_id`,`language_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
		$this->db->query($create_univernews_descriptions);
	
		$create_univernews_to_store = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "univernews_to_store` (`univernews_id` int(11) NOT NULL, `store_id` int(11) NOT NULL, PRIMARY KEY (`univernews_id`, `store_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci";
		$this->db->query($create_univernews_to_store);
	}
}
?>