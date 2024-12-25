<?php

namespace app\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;

class AutoCreateModelDao extends Command
{

    protected function configure()
    {
        // 指令配置
        $this->setName('autocreatemodeldao')
            ->setDescription("自定义模型Dao类");
        // 设置参数

    }

    protected function execute(Input $input, Output $output)
    {

        $tableName = 'users';
        $modelName = ucfirst($tableName);

        $createFunction = $this->generateCreateFunction($tableName, $modelName);
        echo $createFunction;

        // 指令输出
        $output->writeln("自定义模型Dao类:{$modelName}类成功");
    }

    protected function generateCreateFunction($tableName, $modelName)
    {
        try {
            // 表名
            $fields = self::getTableText($tableName);
            // 构建 create 方法
            $methodName = 'create';
            $methodParams = ['$data=[]'];
            $methodBody = "    \$model = new $modelName();\n";

            foreach ($fields as $field) {
                $fieldName = $field['Field'];
                // 跳过主键字段
                if ($field['Key'] === 'PRI') continue;
                // 添加方法体
                $methodBody .= "    \$model->$fieldName = \$data['$fieldName'] ?? \"\";\n";
            }

            $methodBody .= "    \$model->save();\n";
            $methodBody .= "    return \$model;\n";

            // 构建完整的方法
            $method = "public static function $methodName(" . implode(', ', $methodParams) . ") {\n";
            $method .= $methodBody;
            $method .= "}\n";

            // 输出生成的方法
            return $method;

        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    /**
     * 获取表名称
     * @param $tableName
     * @return array
     */
    public static function getTableText($tableName)
    {
        if (!extension_loaded('pdo')) {  //判断pdo扩展是否安装
            die('PDO extension is not loaded');
        }
        $host = config('database.hostname');
        $dbname = config('database.database');
        $username = config('database.username');
        $password = config('database.password');
        try {
            // 创建 PDO 实例
            $pdo = new \PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            // 查询表的字段信息
            $query = "DESCRIBE $tableName";
            $stmt = $pdo->query($query);
            $fields = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $fields;
    }
}
