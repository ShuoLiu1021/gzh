 **步骤** 

1、需要了解一定的编程知识，本代码PHP实现

2、注册微信公众号平台，进入测试（个人开发者无法发送模版消息，只能借助测试号）
https://mp.weixin.qq.com/debug/cgi-bin/sandboxinfo?action=showinfo&t=sandbox/index

3、新增模版消息配置，内容可参考下面，{{}}里面的变量需要在脚本里声明赋值

4、一句情话使用的网上随便找的api

5、定时发送需要使用羊小小_定时程序.exe 这个软件


 **需要修改的地方** 

1、Main.php里面的template_id需要改成在微信公众测试页面新建的模版的模版Id！！！！
![输入图片说明](1.png)


2、WeiChat.php的APPID、APPSECRET改成微信公众测试页面提供的对应内容！！！
![输入图片说明](2.png)


3、Main.php里面的userList需要改成在微信公众测试页面让女朋友扫完码之后的用户微信号那一栏的内容，想给多个女朋友发就配置多个～～～
![输入图片说明](3.png)


4、纪念日、生日之类的也是Main.php里面改，应该能看到

 **模版消息配置内容:** 

今天是：{{date.DATA}} {{week.DATA}}
城市：{{city.DATA}}
天气：{{weather.DATA}}
最低温度：{{low.DATA}}
最高温度：{{high.DATA}}
天气建议：{{tip.DATA}}
今天是我们恋爱的第{{shengri.DATA}}天
距离乖乖的生日还有{{shengri.DATA}}天
{{xingzuo.DATA}}
{{yunshi.DATA}}





