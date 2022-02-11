#   说明

> 此文件包含了一些开发过程中经常使用的函数,所以做成全局助手函数使用
项目最好设置在 app目录下

[**laravel-项目设置助手函数方式**](https://www.cnblogs.com/yaoliuyang/p/12841715.html)


# 使用步骤
**添加配置**
> 在 `composer.json`中的`autoload`中配置
```php
 "autoload": {
        "files": [
            "app/Helpers/function.php",
        ]
    },
```
**生成自动加载**
> 请终端中使用composer命令
```php
composer dump-autoload
```