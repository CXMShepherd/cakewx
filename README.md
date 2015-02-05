# CakeWX

## 简介

**CakeWX**是一个开源，高效，敏捷的微信开发平台采用PHP语言，它是基于CakePHP这个企业级快速开发框架实现的。
**CakeWX**的目的是最大化的简化微信开发的流程，使用开发者能把最好的精力放到微信具体业务开发，并能以最快的时间完成。把一些常规而频繁的工作交由**CakeWX**来处理即可，**CakeWX**有方便搭建，扩展性强，轻松入手，管理方便等优点，利用她您可以轻松搭建一个属于自己的微信公众账号运营平台，完成企业应用。为此**CakeWX**提供了详细的二次开发文档，关键代码里还是相关的注释说明。

* **CakeWX** 微信公众平台开发框架

* 基于[CakePHP](http://www.cakephp.org)，开源免费。

* 多公众号管理, 一个后台可同时管理多个公众号。

* 自定义拖拽菜单，个性化对接公众帐号菜单。

* 关键字匹配、自动回复、多图文编辑等功能无缝对接。

* 遵循 [MIT License](https://github.com/niancode/CakeWX/blob/master/LICENSE) 


## 安装及配置说明

1. APACHE设置
    + 进入 `Apache安装目录`下 `/conf/httpd.conf`  开启支持.htaccess
    + 去掉  #LoadModule rewrite_module modules/mod_rewrite.so  之前的 `#`号注释
    + AllowOverride None 改成  `AllowOverride All `

2. PHP、MySql 设置
  * PHP 5.2.8 及以上版本
  * MySQL 4.1 及以上版本
  * 配置 `php.ini` 文件
  * 去掉 extension=php_curl.dll 之前的 `#`号注释
  * 去掉 extension=php_pdo_mysql.dll 之前的 `#`号注释
  * 设置 short_open_tag = On

3. 重启 Apache


## 升级说明

v1.5 预计要更新的功能

1. 新增微店铺。
2. 新增微会员。（认证微信号）
3. 新增消息群发。（认证微信号）
4. 新增短信接口。
5. 素材库新增商品和活动的类型。
6. 诸多bug的修复和页面样式的优化。
7. 更新旧的微信API接口与微信公众平台同步。

## 链接

  * **官方网站**: [http://cakewx.com](http://cakewx.com)
  * 微社区-豆芽 [http://www.zaiwx.com/](http://www.zaiwx.com)
  * Apche [http://www.apache.org](http://www.apache.org)
  * PHP [http://www.php.net](http://www.php.net)
  * MySql [http://www.mysql.com](http://www.mysql.com)
  * CakePhp [http://www.cakephp.org](http://www.cakephp.org)