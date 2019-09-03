<?php
class ControllerCommonSeoPro extends Controller {
    private $cache_data = null;
    private $languages = array();
    private $config_language;

    public function __construct($registry) {
        parent::__construct($registry);
        $this->cache_data = $this->cache->get('seo_pro');
        if (!$this->cache_data) {
            $query = $this->db->query("SELECT LOWER(`keyword`) as 'keyword', `query` FROM " . DB_PREFIX . "url_alias");
            $this->cache_data = array();
            foreach ($query->rows as $row) {
                $this->cache_data['keywords'][$row['keyword']] = $row['query'];
                $this->cache_data['queries'][$row['query']] = $row['keyword'];
            }
            $this->cache->set('seo_pro', $this->cache_data);
        }

        $query = $this->db->query("SELECT `value` FROM `" . DB_PREFIX . "setting` WHERE `key` = 'config_language'");
        $this->config_language = $query->row['value'];

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "language WHERE status = '1'");

        foreach ($query->rows as $result) {
            $this->languages[$result['code']] = $result;
        }

    }

    public function index() {

// language
        $code = $this->config_language;

        if(isset($this->request->get['_route_'])) {
            $tokens = explode('/', $this->request->get['_route_']);

            if(array_key_exists($tokens[0], $this->languages)) {
                $code = $tokens[0];
                $this->request->get['_route_'] = substr($this->request->get['_route_'], strlen($code) + 1);
            }

            if(trim($this->request->get['_route_']) == '' || trim($this->request->get['_route_']) == 'index.php') {
                unset($this->request->get['_route_']);
            }
        }


        if(!isset($this->session->data['language']) || $this->session->data['language'] != $code) {
            $this->session->data['language'] = $code;
        }

        if(!isset($this->request->cookie['language']) || $this->request->cookie['language'] != $code) {
            setcookie('language', $code, time() + 60 * 60 * 24 * 30, '/', $this->request->server['HTTP_HOST']);
        }

        $this->config->set('config_language_id', $this->languages[$code]['language_id']);
        $this->config->set('config_language', $this->languages[$code]['code']);

        $language = new Language($this->languages[$code]['directory']);
        $language->load($this->languages[$code]['filename']);
        $this->registry->set('language', $language);


        // Add rewrite to url class
        if ($this->config->get('config_seo_url')) {
            $this->url->addRewrite($this);
        } else {
            return;
        }

        // Decode URL
        if (!isset($this->request->get['_route_'])) {
            $this->validate();
        } else {
            $route = $this->request->get['_route_'];
            unset($this->request->get['_route_']);
            $parts = explode('/', trim(utf8_strtolower($route), '/'));
            list($last_part) = explode('.', array_pop($parts));
            array_push($parts, $last_part);

            $rows = array();
            foreach ($parts as $keyword) {
                if (isset($this->cache_data['keywords'][$keyword])) {
                    $rows[] = array('keyword' => $keyword, 'query' => $this->cache_data['keywords'][$keyword]);
                }
            }

            if (count($rows) == sizeof($parts)) {
                $queries = array();
                foreach ($rows as $row) {
                    $queries[utf8_strtolower($row['keyword'])] = $row['query'];
                }

                reset($parts);
                foreach ($parts as $part) {
                    $url = explode('=', $queries[$part], 2);


                    if ($url[0] == 'page_id') {
                        $this->request->get['page_id'] = $url[1];
                    }
                    if ($url[0] == 'record1g22_id') {
                        $this->request->get['record1g22_id'] = $url[1];
                    }
                    if ($url[0] == 'record1g23_id') {
                        $this->request->get['record1g23_id'] = $url[1];
                    }
                    if ($url[0] == 'record1g24_id') {
                        $this->request->get['record1g24_id'] = $url[1];
                    }
                    if ($url[0] == 'record1g25_id') {
                        $this->request->get['record1g25_id'] = $url[1];
                    }
                    if ($url[0] == 'record1g26_id') {
                        $this->request->get['record1g26_id'] = $url[1];
                    }
                    if ($url[0] == 'record1g27_id') {
                        $this->request->get['record1g27_id'] = $url[1];
                    }
                    if ($url[0] == 'record1g28_id') {
                        $this->request->get['record1g28_id'] = $url[1];
                    }
                    if ($url[0] == 'record1g29_id') {
                        $this->request->get['record1g29_id'] = $url[1];
                    }
                    if ($url[0] == 'record1g30_id') {
                        $this->request->get['record1g30_id'] = $url[1];
                    }
                    if ($url[0] == 'record1g31_id') {
                        $this->request->get['record1g31_id'] = $url[1];
                    }
                    if ($url[0] == 'record1g32_id') {
                        $this->request->get['record1g32_id'] = $url[1];
                    }

                    if ($url[0] == 'article_id') {
                        if (!isset($this->request->get['article_id'])) {
                            $this->request->get['article_id'] = $url[1];
                        } else {
                            $this->request->get['article_id'] .= '_' . $url[1];
                        }
                    }
                    if ($url[0] == 'blog1g22_id') {
                        if (!isset($this->request->get['blog1g22_id'])) {
                            $this->request->get['blog1g22_id'] = $url[1];
                        } else {
                            $this->request->get['blog1g22_id'] .= '_' . $url[1];
                        }
                    }
                    if ($url[0] == 'blog1g23_id') {
                        if (!isset($this->request->get['blog1g23_id'])) {
                            $this->request->get['blog1g23_id'] = $url[1];
                        } else {
                            $this->request->get['blog1g23_id'] .= '_' . $url[1];
                        }
                    }
                    if ($url[0] == 'blog1g24_id') {
                        if (!isset($this->request->get['blog1g24_id'])) {
                            $this->request->get['blog1g24_id'] = $url[1];
                        } else {
                            $this->request->get['blog1g24_id'] .= '_' . $url[1];
                        }
                    }
                    if ($url[0] == 'blog1g25_id') {
                        if (!isset($this->request->get['blog1g25_id'])) {
                            $this->request->get['blog1g25_id'] = $url[1];
                        } else {
                            $this->request->get['blog1g25_id'] .= '_' . $url[1];
                        }
                    }
                    if ($url[0] == 'blog1g26_id') {
                        if (!isset($this->request->get['blog1g26_id'])) {
                            $this->request->get['blog1g26_id'] = $url[1];
                        } else {
                            $this->request->get['blog1g26_id'] .= '_' . $url[1];
                        }
                    }
                    if ($url[0] == 'blog1g27_id') {
                        if (!isset($this->request->get['blog1g27_id'])) {
                            $this->request->get['blog1g27_id'] = $url[1];
                        } else {
                            $this->request->get['blog1g27_id'] .= '_' . $url[1];
                        }
                    }
                    if ($url[0] == 'blog1g28_id') {
                        if (!isset($this->request->get['blog1g28_id'])) {
                            $this->request->get['blog1g28_id'] = $url[1];
                        } else {
                            $this->request->get['blog1g28_id'] .= '_' . $url[1];
                        }
                    }
                    if ($url[0] == 'blog1g29_id') {
                        if (!isset($this->request->get['blog1g29_id'])) {
                            $this->request->get['blog1g29_id'] = $url[1];
                        } else {
                            $this->request->get['blog1g29_id'] .= '_' . $url[1];
                        }
                    }
                    if ($url[0] == 'blog1g30_id') {
                        if (!isset($this->request->get['blog1g30_id'])) {
                            $this->request->get['blog1g30_id'] = $url[1];
                        } else {
                            $this->request->get['blog1g30_id'] .= '_' . $url[1];
                        }
                    }
                    if ($url[0] == 'blog1g31_id') {
                        if (!isset($this->request->get['blog1g31_id'])) {
                            $this->request->get['blog1g31_id'] = $url[1];
                        } else {
                            $this->request->get['blog1g31_id'] .= '_' . $url[1];
                        }
                    }
                    if ($url[0] == 'blog1g32_id') {
                        if (!isset($this->request->get['blog1g32_id'])) {
                            $this->request->get['blog1g32_id'] = $url[1];
                        } else {
                            $this->request->get['blog1g32_id'] .= '_' . $url[1];
                        }
                    }
                    
                    if ($url[0] == 'category_id') {
                        if (!isset($this->request->get['path'])) {
                            $this->request->get['path'] = $url[1];
                        } else {
                            $this->request->get['path'] .= '_' . $url[1];
                        }
                    } elseif (count($url) > 1) {
                        $this->request->get[$url[0]] = $url[1];
                    }
                }
            } else {
                $this->request->get['route'] = 'error/not_found';
            }

            if (isset($this->request->get['product_id'])) {
                $this->request->get['route'] = 'product/product';
                if (!isset($this->request->get['path'])) {
                    $path = $this->getPathByProduct($this->request->get['product_id']);
                    if ($path) $this->request->get['path'] = $path;
                }
            } elseif (isset($this->request->get['path'])) {
                $this->request->get['route'] = 'product/category';
            } elseif (isset($this->request->get['manufacturer_id'])) {
                $this->request->get['route'] = 'product/manufacturer/product';
            } elseif (isset($this->request->get['page_id'])) {
                $this->request->get['route'] = 'page/page';
            } elseif (isset($this->request->get['record1g22_id'])) {
                $this->request->get['route'] = 'record1g22/record1g22';
            } elseif (isset($this->request->get['record1g23_id'])) {
                $this->request->get['route'] = 'record1g23/record1g23';
            } elseif (isset($this->request->get['record1g24_id'])) {
                $this->request->get['route'] = 'record1g24/record1g24';
            } elseif (isset($this->request->get['record1g25_id'])) {
                $this->request->get['route'] = 'record1g25/record1g25';
            } elseif (isset($this->request->get['record1g26_id'])) {
                $this->request->get['route'] = 'record1g26/record1g26';
            } elseif (isset($this->request->get['record1g27_id'])) {
                $this->request->get['route'] = 'record1g27/record1g27';
            } elseif (isset($this->request->get['record1g28_id'])) {
                $this->request->get['route'] = 'record1g28/record1g28';
            } elseif (isset($this->request->get['record1g29_id'])) {
                $this->request->get['route'] = 'record1g29/record1g29';
            } elseif (isset($this->request->get['record1g30_id'])) {
                $this->request->get['route'] = 'record1g30/record1g30';
            } elseif (isset($this->request->get['record1g31_id'])) {
                $this->request->get['route'] = 'record1g31/record1g31';
            } elseif (isset($this->request->get['record1g32_id'])) {
                $this->request->get['route'] = 'record1g32/record1g32';
            } elseif (isset($this->request->get['article_id'])) {
                $this->request->get['route'] = 'page/article';
            } elseif (isset($this->request->get['blog1g22_id'])) {
                $this->request->get['route'] = 'record1g22/blog1g22';
            } elseif (isset($this->request->get['blog1g23_id'])) {
                $this->request->get['route'] = 'record1g23/blog1g23';
            } elseif (isset($this->request->get['blog1g24_id'])) {
                $this->request->get['route'] = 'record1g24/blog1g24';
            } elseif (isset($this->request->get['blog1g25_id'])) {
                $this->request->get['route'] = 'record1g25/blog1g25';
            } elseif (isset($this->request->get['blog1g26_id'])) {
                $this->request->get['route'] = 'record1g26/blog1g26';
            } elseif (isset($this->request->get['blog1g27_id'])) {
                $this->request->get['route'] = 'record1g27/blog1g27';
            } elseif (isset($this->request->get['blog1g28_id'])) {
                $this->request->get['route'] = 'record1g28/blog1g28';
            } elseif (isset($this->request->get['blog1g29_id'])) {
                $this->request->get['route'] = 'record1g29/blog1g29';
            } elseif (isset($this->request->get['blog1g30_id'])) {
                $this->request->get['route'] = 'record1g30/blog1g30';
            } elseif (isset($this->request->get['blog1g31_id'])) {
                $this->request->get['route'] = 'record1g31/blog1g31';
            } elseif (isset($this->request->get['blog1g32_id'])) {
                $this->request->get['route'] = 'record1g32/blog1g32';
            } elseif (isset($this->request->get['information_id'])) {
                $this->request->get['route'] = 'information/information';

        
			} elseif (isset($this->request->get['univernews_id'])) {
				$this->request->get['route'] = 'information/univernews';
        
      
            } else {
                if (isset($queries[$parts[0]])) {
                    $this->request->get['route'] = $queries[$parts[0]];
                }
            }


            $this->validate();

            if (isset($this->request->get['route'])) {
                return $this->forward($this->request->get['route']);
            }
        }
    }

    public function rewrite($link, $code = '') {
        if(!$code) {
            $code = $this->session->data['language'];
        }
        if (!$this->config->get('config_seo_url')) return $link;

        $seo_url = '';

        $component = parse_url(str_replace('&amp;', '&', $link));

        $data = array();
        parse_str($component['query'], $data);

        $route = $data['route'];
        unset($data['route']);

        switch ($route) {
            case 'product/product':
                if (isset($data['product_id'])) {
                    $tmp = $data;
                    $data = array();
                    if ($this->config->get('config_seo_url_include_path')) {
                        $data['path'] = $this->getPathByProduct($tmp['product_id']);
                        if (!$data['path']) return $link;
                    }
                    $data['product_id'] = $tmp['product_id'];
                    if (isset($tmp['tracking'])) {
                        $data['tracking'] = $tmp['tracking'];
                    }
                }
                break;

            case 'product/category':
                if (isset($data['path'])) {
                    $category = explode('_', $data['path']);
                    $category = end($category);
                    $data['path'] = $this->getPathByCategory($category);
                    if (!$data['path']) return $link;
                }
                break;
            case 'page/article':
                if (isset($data['article_id'])) {
                    $article = explode('_', $data['article_id']);
                    $article = end($article);
                    $data['article_id'] = $this->getPathByArticle($article);
                    if (!$data['article_id']) return $link;
                }
                break;

            case 'product/product/review':
            case 'information/information/info':
                return $link;
                break;

            default:
                break;
        }

        if ($component['scheme'] == 'https') {
            $link = $this->config->get('config_ssl');
        } else {
            $link = $this->config->get('config_url');
        }

        if ($code != $this->config_language){
            $link .= $code . '/index.php?route=' . $route;
        } else{
            $link .= 'index.php?route=' . $route;
        }

        if (count($data)) {
            $link .= '&amp;' . urldecode(http_build_query($data, '', '&amp;'));
        }

        $queries = array();
        foreach ($data as $key => $value) {
            switch ($key) {
                case 'product_id':
                case 'manufacturer_id':
                case 'category_id':
                case 'page_id':
                case 'record1g22_id':
                case 'record1g23_id':
                case 'record1g24_id':
                case 'record1g25_id':
                case 'record1g26_id':
                case 'record1g27_id':
                case 'record1g28_id':
                case 'record1g29_id':
                case 'record1g30_id':
                case 'record1g31_id':
                case 'record1g32_id':
                case 'article_id':
                case 'blog1g22_id':
                case 'blog1g23_id':
                case 'blog1g24_id':
                case 'blog1g25_id':
                case 'blog1g26_id':
                case 'blog1g27_id':
                case 'blog1g28_id':
                case 'blog1g29_id':
                case 'blog1g30_id':
                case 'blog1g31_id':
                case 'blog1g32_id':
                case 'information_id':

        
				case 'univernews_id':
        
      
                    $queries[] = $key . '=' . $value;
                    unset($data[$key]);
                    $postfix = 1;
                    break;

                case 'path':
                    $categories = explode('_', $value);
                    foreach ($categories as $category) {
                        $queries[] = 'category_id=' . $category;
                    }
                    unset($data[$key]);
                    break;

                case 'article_id':
                    $categories = explode('_', $value);
                    foreach ($categories as $category) {
                        $queries[] = 'article=' . $category;
                    }
                    unset($data[$key]);
                    break;
                case 'blog1g22_id':
                    $categories = explode('_', $value);
                    foreach ($categories as $category) {
                        $queries[] = 'blog1g22=' . $category;
                    }
                    unset($data[$key]);
                    break;
                case 'blog1g23_id':
                    $categories = explode('_', $value);
                    foreach ($categories as $category) {
                        $queries[] = 'blog1g23=' . $category;
                    }
                    unset($data[$key]);
                    break;
                case 'blog1g24_id':
                    $categories = explode('_', $value);
                    foreach ($categories as $category) {
                        $queries[] = 'blog1g24=' . $category;
                    }
                    unset($data[$key]);
                    break;
                case 'blog1g25_id':
                    $categories = explode('_', $value);
                    foreach ($categories as $category) {
                        $queries[] = 'blog1g25=' . $category;
                    }
                    unset($data[$key]);
                    break;
                case 'blog1g26_id':
                    $categories = explode('_', $value);
                    foreach ($categories as $category) {
                        $queries[] = 'blog1g26=' . $category;
                    }
                    unset($data[$key]);
                    break;
                case 'blog1g27_id':
                    $categories = explode('_', $value);
                    foreach ($categories as $category) {
                        $queries[] = 'blog1g27=' . $category;
                    }
                    unset($data[$key]);
                    break;
                case 'blog1g28_id':
                    $categories = explode('_', $value);
                    foreach ($categories as $category) {
                        $queries[] = 'blog1g28=' . $category;
                    }
                    unset($data[$key]);
                    break;
                case 'blog1g29_id':
                    $categories = explode('_', $value);
                    foreach ($categories as $category) {
                        $queries[] = 'blog1g29=' . $category;
                    }
                    unset($data[$key]);
                    break;
                case 'blog1g30_id':
                    $categories = explode('_', $value);
                    foreach ($categories as $category) {
                        $queries[] = 'blog1g30=' . $category;
                    }
                    unset($data[$key]);
                    break;
                case 'blog1g31_id':
                    $categories = explode('_', $value);
                    foreach ($categories as $category) {
                        $queries[] = 'blog1g31=' . $category;
                    }
                    unset($data[$key]);
                    break;
                case 'blog1g32_id':
                    $categories = explode('_', $value);
                    foreach ($categories as $category) {
                        $queries[] = 'blog1g32=' . $category;
                    }
                    unset($data[$key]);
                    break;
              

                default:
                    break;
            }
        }

        if(empty($queries)) {
            $queries[] = $route;
        }

        $rows = array();
        foreach($queries as $query) {
            if(isset($this->cache_data['queries'][$query])) {
                $rows[] = array('query' => $query, 'keyword' => $this->cache_data['queries'][$query]);
            }
        }

        if(count($rows) == count($queries)) {
            $aliases = array();
            foreach($rows as $row) {
                $aliases[$row['query']] = $row['keyword'];
            }
            foreach($queries as $query) {
                $seo_url .= '/' . rawurlencode($aliases[$query]);
            }
        }

        if ($seo_url == '') return $link;

        if($code != $this->config_language) {
            $seo_url = $code . '/' . trim($seo_url, '/');
        } else {
            $seo_url = trim($seo_url, '/');
        }

        if ($component['scheme'] == 'https') {
            $seo_url = $this->config->get('config_ssl') . $seo_url;
        } else {
            $seo_url = $this->config->get('config_url') . $seo_url;
        }

        if (isset($postfix)) {
            $seo_url .= trim($this->config->get('config_seo_url_postfix'));
        } else {
            $seo_url .= '/';
        }

        if(substr($seo_url, -2) == '//') {
            $seo_url = substr($seo_url, 0, -1);
        }

        if (count($data)) {
            $seo_url .= '?' . urldecode(http_build_query($data, '', '&amp;'));
        }

        return $seo_url;
    }

    private function getPathByProduct($product_id) {
        $product_id = (int)$product_id;
        if ($product_id < 1) return false;

        static $path = null;
        if (!is_array($path)) {
            $path = $this->cache->get('product.seopath');
            if (!is_array($path)) $path = array();
        }

        if (!isset($path[$product_id])) {
            $query = $this->db->query("SELECT category_id FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . $product_id . "' ORDER BY main_category DESC LIMIT 1");

            $path[$product_id] = $this->getPathByCategory($query->num_rows ? (int)$query->row['category_id'] : 0);

            $this->cache->set('product.seopath', $path);
        }

        return $path[$product_id];
    }

    private function getPathByCategory($category_id) {
        $category_id = (int)$category_id;
        if ($category_id < 1) return false;

        static $path = null;
        if (!is_array($path)) {
            $path = $this->cache->get('category.seopath');
            if (!is_array($path)) $path = array();
        }

        if (!isset($path[$category_id])) {
            $max_level = 10;

            $sql = "SELECT CONCAT_WS('_'";
            for ($i = $max_level-1; $i >= 0; --$i) {
                $sql .= ",t$i.category_id";
            }
            $sql .= ") AS path FROM " . DB_PREFIX . "category t0";
            for ($i = 1; $i < $max_level; ++$i) {
                $sql .= " LEFT JOIN " . DB_PREFIX . "category t$i ON (t$i.category_id = t" . ($i-1) . ".parent_id)";
            }
            $sql .= " WHERE t0.category_id = '" . $category_id . "'";

            $query = $this->db->query($sql);

            $path[$category_id] = $query->num_rows ? $query->row['path'] : false;

            $this->cache->set('category.seopath', $path);
        }

        return $path[$category_id];
    }
    private function getPathByArticle($article_id) {
        $article_id = (int)$article_id;
        if ($article_id < 1) return false;

        static $article_id = null;
        if (!is_array($article_id)) {
            $article_id = $this->cache->get('article.seopath');
            if (!is_array($article_id)) $article_id = array();
        }

        if (!isset($article_id[$article_id])) {
            $max_level = 10;

            $sql = "SELECT CONCAT_WS('_'";
            for ($i = $max_level-1; $i >= 0; --$i) {
                $sql .= ",t$i.article_id";
            }
            $sql .= ") AS path FROM " . DB_PREFIX . "article t0";
            for ($i = 1; $i < $max_level; ++$i) {
                $sql .= " LEFT JOIN " . DB_PREFIX . "article t$i ON (t$i.article_id = t" . ($i-1) . ".parent_id)";
            }
            $sql .= " WHERE t0.article_id = '" . $article_id . "'";

            $query = $this->db->query($sql);

            $article_id[$article_id] = $query->num_rows ? $query->row['path'] : false;

            $this->cache->set('article.seopath', $article_id);
        }

        return $article_id[$article_id];
    }



    private function validate() {
        if (isset($this->request->get['route']) && $this->request->get['route'] == 'error/not_found') {
            return;
        }
        if(empty($this->request->get['route'])) {
            $this->request->get['route'] = 'common/home';
        }

        if (isset($this->request->server['HTTP_X_REQUESTED_WITH']) && strtolower($this->request->server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return;
        }

        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $url = str_replace('&amp;', '&', $this->config->get('config_ssl') . ltrim($this->request->server['REQUEST_URI'], '/'));
            $seo = str_replace('&amp;', '&', $this->url->link($this->request->get['route'], $this->getQueryString(array('route')), 'SSL'));
        } else {
            $url = str_replace('&amp;', '&', $this->config->get('config_url') . ltrim($this->request->server['REQUEST_URI'], '/'));
            $seo = str_replace('&amp;', '&', $this->url->link($this->request->get['route'], $this->getQueryString(array('route')), 'NONSSL'));
        }

        if (rawurldecode($url) != rawurldecode($seo)) {

            header($this->request->server['SERVER_PROTOCOL'] . ' 301 Moved Permanently');

            $this->response->redirect($seo);
        }
    }

    private function getQueryString($exclude = array()) {
        if (!is_array($exclude)) {
            $exclude = array();
            }

        return urldecode(http_build_query(array_diff_key($this->request->get, array_flip($exclude))));
        }
    }
?>