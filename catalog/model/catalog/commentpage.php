<?php
class ModelCatalogCommentpage extends Model {
	public function addCommentpage($page_id, $data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "commentpage SET
		author = '" . $this->db->escape($data['name']) . "',
		customer_id = '" . (int)$this->customer->getId() . "',
		page_id = '" . (int)$page_id . "',
		text = '" . $this->db->escape(strip_tags($data['text'])) . "',
		status = '" . $this->db->escape(strip_tags($data['status'])) . "',
		rating = '" . (int)$data['rating'] . "', date_added = NOW()");
	}

	public function getCommentpagesByPageId($page_id, $start = 0, $limit = 20) {
		$query = $this->db->query("SELECT r.commentpage_id, r.author, r.rating, r.text, p.page_id, pd.name, p.price, p.image, r.date_added FROM " . DB_PREFIX . "commentpage r LEFT JOIN " . DB_PREFIX . "page p ON (r.page_id = p.page_id) LEFT JOIN " . DB_PREFIX . "page_description pd ON (p.page_id = pd.page_id) WHERE p.page_id = '" . (int)$page_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY r.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getAverageRating($page_id) {
		$query = $this->db->query("SELECT AVG(rating) AS total FROM " . DB_PREFIX . "commentpage WHERE status = '1' AND page_id = '" . (int)$page_id . "' GROUP BY page_id");

		if (isset($query->row['total'])) {
			return (int)$query->row['total'];
		} else {
			return 0;
		}
	}

	public function getTotalCommentpages() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "commentpage r LEFT JOIN " . DB_PREFIX . "page p ON (r.page_id = p.page_id) WHERE p.date_available <= NOW() AND p.status = '1' AND r.status = '1'");

		return $query->row['total'];
	}

	public function getTotalCommentpagesByPageId($page_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "commentpage r LEFT JOIN " . DB_PREFIX . "page p ON (r.page_id = p.page_id) LEFT JOIN " . DB_PREFIX . "page_description pd ON (p.page_id = pd.page_id) WHERE p.page_id = '" . (int)$page_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
}
?>