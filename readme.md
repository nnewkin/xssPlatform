# xss_platform

## about

自用xss平台，偷的雨师傅的js代码，包含截图功能，源码截取等常规功能。

pi2@chamd5.org

## install

- 服务器配置ssl参考<https://github.com/teddysun/lamp>

- 配置conn.php里面的参数

- 导入sql.sql到数据库

- 配置 xss、null 文件夹 为777权限

- 自行更改文件1中第69行代码 xhr.open() 地址为你的域名

如果采用 teddysun/lamp 默认配置，需要删除```/usr/local/apache/conf/vhost/virtual_host.conf```的默认header后重启服务。

请自行更改php.ini max_size大一点。(因为图片太大了,不大的话可能接收不到数据，从而漏收xss结果信息)。

## usege

访问 <https://domain.io/?xss=xss>

- 如需更改访问方式，请全局搜索 ```$_GET['xss']```进行更改。

- 如果邮件通知域名为空，请查看null文件夹下记录的请求。
