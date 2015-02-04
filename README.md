# CakeWX

**CakeWX** 是一个由PHP写的的免费的开源微信公众号管理平台,遵循 [MIT License](https://github.com/niancode/CakeWX/blob/master/LICENSE).

他是基于 [CakePHP](http://www.cakephp.org) MVC 框架.

## 安装及配置说明

1. APACHE设置
    + 进入 `Apache安装目录`下 `/conf/httpd.conf`  开启支持.htaccess
    +去掉  #LoadModule rewrite_module modules/mod_rewrite.so  之前的 `#`号注释
    + AllowOverride None 改成  `AllowOverride All `

2. PHP、MySql 设置
  * PHP 5.2.8 及以上版本
  * MySQL 4.1 及以上版本
  * 配置 `php.ini` 文件
  * 去掉 extension=php_curl.dll 之前的 `#`号注释
  * 设置 short_open_tag = On

3. 重启 Apache

## Links

  * **官方网站**: [http://cakewx.com](http://cakewx.com)
  * Apche [http://www.apache.org](http://www.apache.org)
  * PHP [http://www.php.net](http://www.php.net)
  * MySql [http://www.mysql.com](http://www.mysql.com)