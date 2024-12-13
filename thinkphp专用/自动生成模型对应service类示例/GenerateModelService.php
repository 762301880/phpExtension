<?php

namespace app\common\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use think\Db;

class GenerateModelService extends Command
{
    const DEFAULT_PATH = 'common'; // 移动到类的顶部

    /**
     * 自动生成模型服务类
     */
    protected function configure()
    {
        $this->setName('generate:model-service')
            ->setDescription('Generate ModelService files for all tables in the database');
    }

    protected function execute(Input $input, Output $output)
    {
        $tables = Db::query('SHOW TABLES');
        foreach ($tables as $table) {
            $tableName = current($table);
            $modelName = ucfirst($this->camel_case(str_replace(config('database.prefix'), '', $tableName)));
            $serviceName = $modelName . 'Service';
            $appPath = app()->getAppPath();//应用根目录
            $filePath = $appPath . self::DEFAULT_PATH . '/service/' . $serviceName . '.php';
            if (file_exists($filePath)) {
                $output->writeln("<info>Service file already exists: $filePath</info>");
                continue;
            }

            $content = $this->generateServiceContent($serviceName, $modelName);
            file_put_contents($filePath, $content);
            $output->writeln("<info>Service file created: $filePath</info>");
            break;
        }
    }

    private function generateServiceContent($serviceName, $modelName)
    {
        //return "<?php\n\nnamespace app\\service;\n\nuse app\\model\\$modelName;\n\nclass $serviceName\n{\n    protected \$model;\n\n    public function __construct()\n    {\n        \$this->model = new $modelName();\n    }\n\n    // Add your service methods here\n}\n";
        return "<?php\n\nnamespace app\\common\\service;\n\nclass $serviceName{\n}";
    }

    /**
     * camel_case 方法：这个方法将输入字符串转换为驼峰命名格式。具体步骤如下：
     * 使用 str_replace 将 - 和 _ 替换为空格。
     * 使用 ucwords 将每个单词的首字母大写。
     * 使用 str_replace 移除空格。
     * 使用 lcfirst 将整个字符串的首字母小写。
     * 通过这种方式，你可以确保 camel_case 函数在 GenerateModelService 类中可用，从而避免未定义函数的错误
     * @param $value
     * @return string
     */
    private function camel_case($value)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace(['-', '_'], ' ', $value))));
    }
}
   