<?php
class ModelCatalogArticle extends Model {
	public function getArticle($article_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "article c LEFT JOIN " . DB_PREFIX . "article_description cd ON (c.article_id = cd.article_id) LEFT JOIN " . DB_PREFIX . "article_to_store c2s ON (c.article_id = c2s.article_id) WHERE c.article_id = '" . (int)$article_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

		return $query->row;
	}

	public function getArticleies($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "article c LEFT JOIN " . DB_PREFIX . "article_description cd ON (c.article_id = cd.article_id) LEFT JOIN " . DB_PREFIX . "article_to_store c2s ON (c.article_id = c2s.article_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");

		return $query->rows;
	}





	public function getArticleiesByParentId($article_id) {
		$article_data = array();

		$article_query = $this->db->query("SELECT article_id FROM " . DB_PREFIX . "article WHERE parent_id = '" . (int)$article_id . "'");

		foreach ($article_query->rows as $article) {
			$article_data[] = $article['article_id'];

			$children = $this->getArticleiesByParentId($article['article_id']);

			if ($children) {
				$article_data = array_merge($children, $article_data);
			}
		}

		return $article_data;
	}

	public function getArticleLayoutId($article_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "article_to_layout WHERE article_id = '" . (int)$article_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return $this->config->get('config_layout_article');
		}
	}

	public function getTotalArticleiesByArticleId($parent_id = 0) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "article c LEFT JOIN " . DB_PREFIX . "article_to_store c2s ON (c.article_id = c2s.article_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

		return $query->row['total'];
	}
}
?>