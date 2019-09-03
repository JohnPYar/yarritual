<?php
// univernews Module for Opencart v1.5.5, modified by villagedefrance (contact@villagedefrance.net)

class ModelCatalogunivernews extends Model { 

	public function updateViewed($univernews_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "univernews SET viewed = (viewed + 1) WHERE univernews_id = '" . (int)$univernews_id . "'");
	}

	public function getunivernewsStory($univernews_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "univernews n LEFT JOIN " . DB_PREFIX . "univernews_description nd ON (n.univernews_id = nd.univernews_id) LEFT JOIN " . DB_PREFIX . "univernews_to_store n2s ON (n.univernews_id = n2s.univernews_id) WHERE n.univernews_id = '" . (int)$univernews_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND n.status = '1'");
	
		return $query->row;
	}

	public function getunivernews($data) {
				$sql = "SELECT * FROM " . DB_PREFIX . "univernews n LEFT JOIN " . DB_PREFIX . "univernews_description nd ON (n.univernews_id = nd.univernews_id) LEFT JOIN " . DB_PREFIX . "univernews_to_store n2s ON (n.univernews_id = n2s.univernews_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND n.status = '1' ORDER BY n.date_added DESC";
	
				if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
				$data['start'] = 0;
				}		
				if ($data['limit'] < 1) {
				$data['limit'] = 10;
				}	
		
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
				}	
		
				$query = $this->db->query($sql);
	
				return $query->rows;
				}

	public function getunivernewsShorts($limit) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "univernews n LEFT JOIN " . DB_PREFIX . "univernews_description nd ON (n.univernews_id = nd.univernews_id) LEFT JOIN " . DB_PREFIX . "univernews_to_store n2s ON (n.univernews_id = n2s.univernews_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND n.status = '1' ORDER BY n.date_added DESC LIMIT " . (int)$limit); 
	
		return $query->rows;
	}

	public function getTotalunivernews() {
     	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "univernews n LEFT JOIN " . DB_PREFIX . "univernews_to_store n2s ON (n.univernews_id = n2s.univernews_id) WHERE n2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND n.status = '1'");
	
		if ($query->row) {
			return $query->row['total'];
		} else {
			return FALSE;
		}
	}	
}
?>
