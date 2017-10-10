<?php

App::uses('LoggerAppMode', 'Logger.Model');
App::uses('CakeRequest', 'Network');

class SuckerLog extends LoggerAppModel {

	/**
	 * Logs every user who visits the application into the sucker_logs table
	 *
	 * @return void
	 */
	public function log() {
		$this->save(array(
			'ip'=>$_SERVER['REMOTE_ADDR'],
			'ip_name'=>$this->_reverse_dns($_SERVER['HTTP_HOST']) ,
			'domain'=>$_SERVER['HTTP_HOST'],
			'url_decoded'=>urldecode($_SERVER['REQUEST_URI']),
			'user_agent'=>$_SERVER['HTTP_USER_AGENT'],
			'referer'=>CakeRequest::referer(),
			'cookie_return'=>'',
			'last_usage'=>strtotime(date('Y-m-d H:m:s')),
			'last_usage_human'=>date('Y-m-d H:m:s')
		));
	}

	/**
	 * Returns back reverse dns or IP if one is not available
	 *
	 * @return string
	 */
	private function _reverse_dns($domain) {
		$dns = dns_get_record($domain, DNS_ALL);
		if (empty($dns) || !isset($dns)) {
			return $_SERVER['REMOTE_ADDR'];
		}
		return $dns[0]['target'];
	}
}