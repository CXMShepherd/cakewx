<?php

 /**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */

class MainHelper extends AppHelper {
	
	public function __construct(View $view, $settings = array())
	{
		parent::__construct($view, $settings);
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function sns_url($rurl = '')
	{
		$url = ClassRegistry::init('XyhSetting')->getSettingsUrl();
		$url = $this->Array->element('sns_url', $url['sns_url']);
		return $url.$rurl;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function menuSearch($arr, $type = 'hmenu', $router = 0)
	{
		//echo '<pre>';print_r($this->request);exit;
		if ($type == 'hmenu')
		{
			$action = $this->request->params['action'] == 'index' ? '' : '/'.$this->request->params['action'];
			$psac = reset($this->request->params['pass']);
			$psac = $psac ? "/{$psac}" : ''; 
			$url = Router::url('/'.$this->request->params['controller'].$action.$psac);
		}
		else
		{
			$id = $this->request->params['pass'][0];
			$ac = $this->request->params['pass'][1];
			$url = Router::url("/admin/wc/{$id}/{$ac}");
		}
		$value = $this->Array->MY_arrSearch($arr, $url, 'url', TRUE, 'child', 'action', $router);
		return $value;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function MY_currmenu($arr, $one = FALSE, $child = "child")
	{
		$str = "";
		if (!is_array($arr)) return FALSE;
		$arr_v = array_keys($arr);
		$value1 = reset($arr_v);
		if ($one) 
		{
			$str = $value1;
		}
		else
		{
			$str = $value1;
			if (isset($arr[$value1][$child]))
			{
				$arr_vs = array_keys($arr[$value1][$child]);
				$value2 = reset($arr_vs);
				$str = $str."<small>
					<i class=\"icon-double-angle-right\"></i>
					{$value2}
				</small>";
			}
		}
		return $str;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function formhr_input($name, $arr = array())
	{
		$html = $this->Form->input($name, $arr);
		$html .= "<div class=\"space-4\"></div>";
		return $html;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function formhr_hidden($name, $arr = array())
	{
		$html = $this->Form->hidden($name, $arr);
		$html .= "<div class=\"space-4\"></div>";
		return $html;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function formhr_checkbox($name, $arr = array())
	{
		$arvs = $arr;
		unset($arr['label']);
		unset($arr['div']);
		unset($arr['between']);
		unset($arr['after']);
		$input = $this->Form->checkbox($name, $arr);
		if (isset($arvs['label']) && isset($arvs['between']) && isset($arvs['after'])) {
			$html .= "<div class=\"{$arvs['div']}\">";
			$html .= $this->Form->label($name, '', array('class' => $arvs['label']['class']));
			$html .= $arvs['between'];
			$html .= $input;
			$html .= $this->Form->label($name, $arvs['label']['text']);
			$html .= $arvs['after']."</div>";
		}
		$html .= "<div class=\"space-4\"></div>";
		return $html;
	}
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function formhr_radio($name, $arr = array())
	{
		$arvs = $arr;
		unset($arr['label']);
		unset($arr['div']);
		unset($arr['between']);
		unset($arr['after']);
		unset($arr['options']);
		// unset($arr['beforce']);
		// unset($arr['separator']);
		$input = $this->Form->radio($name, $arvs['options'], $arr);
		if (isset($arvs['label']) && isset($arvs['between']) && isset($arvs['after'])) {
			$html .= "<div class=\"{$arvs['div']}\">";
			$html .= $this->Form->label($name, '', array('class' => $arvs['label']['class']));
			$html .= $input;
			$html .= $this->Form->label($name, $arvs['label']['text']);
			$html .= $arvs['after']."</div>";
		}
		$html .= "<div class=\"space-4\"></div>";
		return $html;
	}
	
	/**************************************************************
       *
       *    使用特定function对数组中所有元素做处理
       *    @param  string  &$array     要处理的字符串
       *    @param  string  $function   要执行的函数
       *    @return boolean $apply_to_keys_also     是否也应用到key上
       *    @access public
       *
     *************************************************************/
    function arrayRecursive(&$array, $function, $apply_to_keys_also = false)
    {
        static $recursive_counter = 0;
        if (++$recursive_counter > 1000) {
            die('possible deep recursion attack');
        }
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->Main->arrayRecursive($array[$key], $function, $apply_to_keys_also);
            } else {
                $array[$key] = $function($value);
            }

            if ($apply_to_keys_also && is_string($key)) {
                $new_key = $function($key);
                if ($new_key != $key) {
                    $array[$new_key] = $array[$key];
                    unset($array[$key]);
                }
            }
        }
        $recursive_counter--;
    }

	function decodeUnicode($str)
	{
		function replace_unicode_escape_sequence($match) {
	    	return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
		}
		$str = preg_replace_callback('/\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $str);
		return $str;
	}

    /**************************************************************
     *
     *    将数组转换为JSON字符串（兼容中文）
     *    @param  array   $array      要转换的数组
     *    @return string      转换得到的json字符串
     *    @access public
     *
     *************************************************************/
    function chs_json_encode($array, $decode = 1) {
        $this->Main->arrayRecursive($array, 'urlencode', true);
        $json = json_encode($array);
        return $decode ? urldecode($json) : $json;
    }
	
	/**
	 * json 编码
	 * 
	 * 解决中文经过 json_encode() 处理后显示不直观的情况
	 * 如默认会将“中文”变成"\u4e2d\u6587"，不直观
	 * 如无特殊需求，并不建议使用该函数，直接使用 json_encode 更好，省资源
	 * json_encode() 的参数编码格式为 UTF-8 时方可正常工作
	 * 
	 * @param array|object $data
	 * @return array|object
	 */
	function ch_json_encode($data, $decode = 1) {	
		$ret = $this->Main->wphp_urlencode($data);
		$ret = json_encode($ret);
		return $decode ? urldecode($ret) : $ret;
	}
	
	
	/**
	 * 对数组和标量进行 urlencode 处理
	 * 通常调用 wphp_json_encode() 
	 * 处理 json_encode 中文显示问题
	 * @param array $data
	 * @return string
	 */
	function wphp_urlencode($data) {
		if (is_array($data) || is_object($data)) {
			foreach ($data as $k => $v) {
				if (is_scalar($v)) {
					if (is_array($data)) {
						$data[$k] = urlencode($v);
					} else if (is_object($data)) {
						$data->$k = urlencode($v);
					}
				} else if (is_array($data)) {
					$data[$k] = $this->Main->wphp_urlencode($v); //递归调用该函数
				} else if (is_object($data)) {
					$data->$k = $this->Main->wphp_urlencode($v);
				}
			}
		}
		return $data;
	}
	
	function randomkeys($length) {
		$pattern='1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
	 	$key = '';
	 	for($i=0; $i<$length; $i++) {
	   		$key .= $pattern{mt_rand(0,35)};    //生成php随机数
	 	}
	 	return $key;
	}
}