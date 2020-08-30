<?php
/**
 * 数据库的基本操作
 */
class Db {
    private $dbConfig = [
        'db'        => 'mysql',     // 数据库类型
        'host'      => 'localhost', // 主机名称
        'port'      => '3306',      // 默认端口
        'user'      => 'root',      // 用户名
        'pass'      => '',          // 密码
        'charset'   => 'utf8',      // 默认字符集
        'dbname'    => 'edu'        // 默认数据库
    ];

    // 新增主键id
    public $insertId = null;

    // 受影响的记录数量
    public $num = 0;

    // 单例模式，本类的实例
    private static $instance = null;

    // 数据库的连接
    private  $conn = null;

    /**
     * Db 构造方法
     * 私有化以防止外部实例化
     */
    private function __construct($params) {
        // 初始化连接参数
        $this->dbConfig = array_merge($this->dbConfig, $params);
        // 连接数据库
        $this -> connect();
    }

    /**
     * 禁止外部克隆该实例
     */
    private function __clone() {}

    /**
     * 获取当前类的单一实例
     */
    public static function getInstance($params=[]) {
        if(!self::$instance instanceof self) {
            self::$instance = new self($params);
        }
        return self::$instance;
    }

    /**
     * 数据库的连接
     */
    private function connect() {
        try {
            // 配置数据源DSN
            $dsn = "{$this->dbConfig['db']}:host={$this->dbConfig['host']};dbname={$this->dbConfig['dbname']};charset={$this->dbConfig['charset']}";
            
            // 创建PDO对象
            $this->conn = new PDO($dsn,$this->dbConfig['user'],$this->dbConfig['pass']);

            // 设置客户端的默认字符集
            $this->conn->query("set names {$this->dbConfig['charset']}");
        } catch (PDOException $e) {
            die('数据库连接失败'.$e->getMessage());
        }
    }

    // 完成数据表的写操作：新增，更新，删除
    // 返回受影响的记录，如果新增还返回新增主键id
    public function exec($sql) {
        $num = $this->conn->exec($sql);
        // 如果有受影响的记录
        if($num > 0) {
            // 如果是新增操作，初始化新增主键id属性
            if(null !== $this->conn->lastInsertId()) {
                $this->insertId = $this->conn->lastInsertId();
            }
            $this->num = $num;  // 返回受影响的记录数量
        }else {
            $error = $this->conn->errorInfo();  // 获取最后操作数据库的错误信息的数组
            // [0]错误标识符[1]错误代码[2]错误信息
            print '操作失败'.$error[0].':'.$error[1].':'.$error[2].'<br>';
        }
    }
    
    // 获取单条查询结果
    public function fetch($sql) {
        return $this->conn->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    // 获取多条查询结果
    public function fetchAll($sql) {
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}