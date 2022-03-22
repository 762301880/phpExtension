# 说明

> 说明  如果是tp5.1的话，封装的返回器 明明success error 会与继承的父类Controller 中的 
> **\thinkphp\library\traits\controller\Jump.php** 方法重叠所以请自定义更换命名 例如 resSuccess

# 注意事项

##  目录命名必须小写

> 像**traits**扩展目录，因为tp框架规定目录要小写开头的规范，这次吃了个大亏，使用了自定义封装
>
> 的返回器上传到服务器就是找不到这个类，最后瞎猫碰上死耗子，把目录修改为小写，执行成功