<?php
Router::connect('/lnys', array('plugin' => 'liunian', 'controller' => 'basic', 'action' => 'index'));
Router::connect('/admin/app/liunian', array('plugin' => 'liunian', 'controller' => 'basic'));