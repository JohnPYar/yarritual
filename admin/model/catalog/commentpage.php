<?php
class ModelCatalogCommentpage extends Model {
	public function addCommentpage($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "commentpage
		SET author = '" . $this->db->escape($data['author']) . "',
		page_id = '" . $this->db->escape($data['page_id']) . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', rating = '" . (int)$data['rating'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
	}

	public function editCommentpage($commentpage_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "commentpage SET
		author = '" . $this->db->escape($data['author']) . "',
		page_id = '" . $this->db->escape($data['page_id']) . "',
		text = '" . $this->db->escape(strip_tags($data['text'])) . "',
		rating = '" . (int)$data['rating'] . "',
		status = '" . (int)$data['status'] . "',
		date_added = '" . $this->db->escape($data['date_available']) . "'
		WHERE commentpage_id = '" . (int)$commentpage_id . "'");
	}

	public function deleteCommentpage($commentpage_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "commentpage WHERE commentpage_id = '" . (int)$commentpage_id . "'");
	}

	public function getCommentpage($commentpage_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT pd.name FROM " . DB_PREFIX . "page_description pd WHERE pd.page_id = r.page_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS page FROM " . DB_PREFIX . "commentpage r WHERE r.commentpage_id = '" . (int)$commentpage_id . "'");

		return $query->row;
	}

	public function getCommentpages($data = array()) {
		$sql = "SELECT r.commentpage_id, pd.name, r.author, r.rating, r.status, r.date_added FROM " . DB_PREFIX . "commentpage r
		LEFT JOIN " . DB_PREFIX . "page_description pd ON (r.page_id = pd.page_id)
		WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$sort_data = array(
			'pd.name',
			'r.author',
			'r.rating',
			'r.status',
			'r.date_added'
		);

			if (!empty($data['filter_name'])) {
				$sql .= " AND LCASE(pd.name) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
			}

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY r.date_added";
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
	}

	public function getTotalCommentpages() {
        $sql="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "commentpage";


		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalCommentpagesAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "commentpage WHERE status = '0'");

		return $query->row['total'];
	}
}
?>