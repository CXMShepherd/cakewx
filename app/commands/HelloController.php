<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use mustangostang\spyc\Spyc;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
    	// $message = $this->ansiFormat($message, Console::FG_YELLOW);
        echo $message . "\n";
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function actionYaml()
    {
    	print_r(Spyc::YAMLLoad('/tmp/demo.yml'));
    }
}
