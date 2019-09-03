<?php

/**
 * Created by PhpStorm.
 * User: Tantacula
 * Date: 27.10.2014
 * Time: 0:05
 */
class ControllerModuleSingleclick extends Controller
{
    private $error = array();


    public function singleHeader()
    {
        $this->language->load('module/fast_order');
		 $this->data['text_order']= $this->language->get('text_order');
        $this->data['text_name'] = $this->language->get('text_name');
        $this->data['text_phone'] = $this->language->get('text_phone');
        $this->data['text_comment'] = $this->language->get('text_comment');
        $this->data['text_captcha'] = $this->language->get('text_captcha');
        $this->data['text_helptext']= $this->language->get('text_helptext');
		 $this->data['text_send']= $this->language->get('text_send');

        /*
         * $singleclick = ControllerModuleSingleclick::primaryFunction();
         */
    }

    public function index()
    {
        $this->language->load('module/fast_order');

        $this->data['email_subject'] = $this->language->get('email_subject');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')
            && $this->validate()
        ) {

            $product = trim($this->request->post['product_name']);
            $price = trim($this->request->post['product_price']);
            $name = trim($this->request->post['customer_name']);
            $phone = trim($this->request->post['customer_phone']);
            $comment = trim($this->request->post['customer_message']);
			$captcha = trim($_POST['captcha']);
	        $pr = trim($_POST['pr']);


            $message = $product . " (" . $price . ")" . PHP_EOL . PHP_EOL .
                $this->language->get('text_date') . date('d.m.Y H:i') . PHP_EOL .
                $this->language->get('text_client') . $name . PHP_EOL .
                $this->language->get('text_phone') . $phone . PHP_EOL .
                $this->language->get('text_comment') . $comment;

            /*
             * Looks like кому-то было лень написать модель
             */
            $time = time();
            $sql = "INSERT INTO " . DB_PREFIX . "singleclick SET id='',name = '"
                . $this->db->escape($name) . "',phone = '"
                . $this->db->escape($phone) . "',message='"
                . $this->db->escape($message) . "',date='" . $time . "'";
            $query = $this->db->query($sql);


            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->hostname = $this->config->get('config_smtp_host');
            $mail->username = $this->config->get('config_smtp_username');
            $mail->password = $this->config->get('config_smtp_password');
            $mail->port = $this->config->get('config_smtp_port');
            $mail->timeout = $this->config->get('config_smtp_timeout');
            $mail->setTo($this->config->get('config_email'));
            $mail->setFrom('order@yourstore.ru');
            $mail->setSender($name);
            $mail->setSubject(html_entity_decode(sprintf($this->language->get('email_subject'),
                $name, ENT_QUOTES, 'UTF-8')));
            $mail->setText(strip_tags(html_entity_decode($message, ENT_QUOTES,
                'UTF-8')));
            $mail->send();

            $this->redirect($this->url->link('module/singleclick/success'));
            // return 'Done';
        } else {

            //header("HTTP/1.0 400 Bad Request");
            $resp = array('error' => $this->error);
            $this->response->setOutput(json_encode($resp));

        }

    }

    public function success()
    {
        $success = array('success' => '1');
        $this->response->setOutput(json_encode($success));
    }

    private function validate()
    {

        $this->language->load('module/fast_order');

        if (!isset($this->request->post['customer_name'])
            || (utf8_strlen($this->request->post['customer_name']) < 3)
            || (utf8_strlen($this->request->post['customer_name']) > 32)
        ) {
            $this->error = $this->language->get('error_name');
        }

        if (!isset($this->request->post['customer_phone'])
            || (utf8_strlen($this->request->post['customer_phone']) < 5)
            || (utf8_strlen($this->request->post['customer_phone']) > 32)
        ) {
            $this->error = $this->language->get('error_phone');
        }
		
		if (!isset($this->request->post['captcha']) || (!isset($this->request->post['pr'])) || ($this->request->post['captcha'] != $this->request->post['pr'])) {
              $this->error = $this->language->get('error_captcha');
        }
		

        /*
        if (!preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
            $this->error['email'] = $this->language->get('error_email');
        }
        */



        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}