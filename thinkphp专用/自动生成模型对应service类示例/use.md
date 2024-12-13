注册命令： 在application/command.php文件中注册这个命令：

```shell
   <?php
   return [
       'app\command\GenerateModelService',
   ];
   
```

运行命令： 使用ThinkPHP的命令行工具运行生成命令：

```shell
运行命令： 使用ThinkPHP的命令行工具运行生成命令：
```

这个脚本会遍历数据库中的所有表，并为每个表生成一个对应的ModelService.php文件。生成的文件位于application/service目录下，并且包含一个构造函数来实例化相应的模型。
你可以根据需要进一步扩展这个脚本，例如添加更多的服务方法模板，或者处理特定的表结构