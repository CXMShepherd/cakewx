<?php

namespace TwigPlugin\Extension;

class HtmlExtension extends \Twig_Extension
{
    /**
     * @var \HtmlHelper
     */
    protected $htmlHelper;

    public function __construct($view)
    {
        \App::import('Helper', 'Html');
        $this->htmlHelper = new \HtmlHelper($view);	
		$this->view = $view;
        $this->request = $this->htmlHelper->request;
        $this->response = $this->htmlHelper->response;
    }

    public function getFunctions()
    {
        return array(
            'link' => new \Twig_Function_Method($this, 'link',
                array(
                    'pre_escape'    => 'html',
                    'is_safe'       => array('html'),
                )
            ),
            'link_unless_current' => new \Twig_Function_Method($this, 'linkUnlessCurrent',
                array(
                    'pre_escape'    => 'html',
                    'is_safe'       => array('html'),
                )
            ),
            'url' => new \Twig_Function_Method($this, 'url',
                array(
                    'pre_escape'    => 'html',
                    'is_safe'       => array('html'),
                )
            ),
            'css' => new \Twig_Function_Method($this, 'css',
                array(
                    'pre_escape'    => 'html',
                    'is_safe'       => array('html'),
                )
            ),
            'script' => new \Twig_Function_Method($this, 'script',
                array(
                    'pre_escape'    => 'html',
                    'is_safe'       => array('html'),
                )
            ),
			'image' => new \Twig_Function_Method($this, 'image',
                array(
                    'pre_escape'    => 'html',
                    'is_safe'       => array('html'),
                )
            ),
			'fetch' => new \Twig_Function_Method($this, 'fetch',
                array(
                    'pre_escape'    => 'html',
                    'is_safe'       => array('html'),
                )
            ),
			'wxUrl' => new \Twig_Function_Method($this, 'wxUrl',
                array(
                    'pre_escape'    => 'html',
                    'is_safe'       => array('html'),
                )
            ),
			'contact' => new \Twig_Filter_Method($this, 'contact',
                array(
                    'is_safe'       => array('html'),
                )
            ),
			'md5' => new \Twig_Filter_Method($this, 'md5',
                array(
                    'is_safe'       => array('html'),
                )
            )
        );
    }

    /**
     * Provides link_to function which wraps HtmlHelper::link().
     *
     * @param $title
     * @param $url
     * @param array $options
     * @param bool $confirmMessage
     * @return string Html link.
     */
    public function link($title, $url, $options = array(), $confirmMessage = false)
    {
        return $this->htmlHelper->link($title, $url, $options, $confirmMessage);
    }

    public function linkUnlessCurrent($title, $url, $options = array(), $confirmMessage = false)
    {
        $current = false;
        $expecting = $this->url($url);

        if ($this->request->here === $expecting) {
            return $title;
        }

        return $this->link($title, $expecting, $options, $confirmMessage);
    }

    public function url($path, $full = false)
    {
        return $this->htmlHelper->url($path, $full);
    }

    public function script($url, $options = array())
    {
        return $this->htmlHelper->script($url, $options);
    }

    public function css($path, $rel = null, $options = array())
    {
		return $this->htmlHelper->css($path, $rel, $options);
		
    }
	
	public function image($url, $options = array()) {
		return $this->htmlHelper->image($url, $options);
	}
	
	public function fetch($name) {
		return $this->view->fetch($name);
	}
	
	public function wxUrl($url, $options = array()) {
		$url = urlencode($url);
		$rdurl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$options['appid']}&redirect_uri={$url}&response_type=code&scope=snsapi_base&state=liunian#wechat_redirect";
		return $rdurl;
	}
	
	public function contact($str, $str2)
    {
        return $str.$str2;
    }

	public function md5($str)
    {
        return md5($str);
    }
	
    public function getName()
    {
        return 'HtmlHelper';
    }
}