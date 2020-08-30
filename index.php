<?php
/**
 * 入口文件
 */

// 导入框架的基础类
require './framework/Base.php';
// 实例化框架类
$app = new Base();
// 让框架跑起来
$app -> run();