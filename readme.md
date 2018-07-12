SSR后台部署与使用8
========

### 市面上的SSR服务端版本太多，由于本项目是公司使用，所以需要搭配后台。挑选之下，选用了开源项目[SSR](https://github.com/ouhaohan8023/SSR_server)与[SSRPanel](https://github.com/ouhaohan8023/shadow.com)
### [博客地址](http://www.ohh.ink/#/novel?id=30)
### [Github](https://github.com/ouhaohan8023/SSR_server)
### 在此，衷心感谢作者：
### 1.[Bruskyii Panda](https://github.com/ssrpanel)

### 因为站在巨人的肩膀上才有的此项目，谢谢各位的奉献！

### 本项目搭建完毕以后，需要在大陆以外的vps上搭建服务端，[传送门](https://github.com/ouhaohan8023/SSR_server)

### 后台客户端展示
![client](https://github.com/ouhaohan8023/shadow.com/raw/master/pre/client.png)

### 后台管理员展示
![server](https://github.com/ouhaohan8023/shadow.com/raw/master/pre/admin.png)

### 项目描述
````
1.多节点账号管理面板，兼容SS、SSRR
2.需配合SSR或SSRR版后端使用
3.强大的管理后台、美观的界面、简单易用的开关、支持移动端自适应
4.内含简单的购物、卡券、邀请码、推广返利&提现、文章管理、工单（回复带邮件提醒）等模块
5.用户、节点标签化，不同用户可见不同节点
6.SS配置转SSR(R)配置，轻松一键导入SS账号
7.单机单节点日志分析功能
8.账号、节点24小时和近30天内的流量监控
9.邮件、serverChan投递都有记录
10.账号临近到期、流量不够会自动发邮件提醒，自动禁用到期、流量异常的账号，自动清除日志等各种强大的定时任务
11.后台一键添加加密方式、混淆、协议、等级
12.强大的后台一键配置功能
13.屏蔽常见爬虫、屏蔽机器人
14.支持单端口多用户
15.支持节点订阅功能，可自由更换订阅地址、封禁账号订阅地址
16.节点宕机提醒（邮件、ServerChan微信提醒）
17.支持多国语言，自带英文语言包
18.订阅防投毒机制
19.自动释放端口机制，防止端口被大量长期占用
20.封特定国家、地区、封IP段
21.有赞云支付
22.开放API，方便自行定制改造客户端
````

### 官方演示&交流
````
官方站：http://www.ssrpanel.com
演示站：http://demo.ssrpanel.com （用户名：admin 密码：123456，请勿修改密码）
telegram订阅频道：https://t.me/ssrpanel
````

#### 环境要求
````
PHP 7.1 （必须）
MYSQL 5.5 （推荐5.6+）
内存 1G+ 
磁盘空间 10G+
PHP必须开启curl、gd、fileinfo、openssl、mbstring组件
安装完成后记得编辑config/app.php中 'debug' => true, 改为 false
````


### 本项目部署方式如下：

##### 1.安装`lnmp`，`mysql`版本选择`5.7`，`php`版本选择`7.1`，其他可以直接回车。[官方文档传送门](https://lnmp.org/)
>wget -c http://soft.vpser.net/lnmp/lnmp1.4.tar.gz && tar zxf lnmp1.4.tar.gz && cd lnmp1.4 && ./install.sh

##### 2.`lnmp`安装的`php7.1`版本不含`fileinfo`组件，具体可以在`lnmp`安装结束以后，查看`phpinfo`。解决方法为[补充]()
##### 3.lnmp添加虚拟站点，本示例中，虚拟站点为`shadow3.com`
>lnmp vhost add

![增加虚拟站点](https://github.com/ouhaohan8023/shadow.com/raw/master/pre/addvhost.png)
##### 4.在`nginx`中加入`url`重写规则和根目录(不会用`vi`编辑器的同学，自行百度操作方法)
```$xslt
vi /usr/local/nginx/conf/vhost/shadow3.com.conf
root  /home/wwwroot/shadow3.com/public;
location / {
     try_files $uri $uri/ /index.php$is_args$args;
 }
保存退出
```

![nginx配置](https://github.com/ouhaohan8023/shadow.com/raw/master/pre/nginx.png)

##### 5.修改`php.ini`目录，取消`proc`函数限制
```$xslt
vi /usr/local/php/etc/php.ini
/proc
上一部找到proc的函数(一般是两个)，删除即可
```

![删除proc函数示例](https://github.com/ouhaohan8023/shadow.com/raw/master/pre/disable.png)

##### 6.修改`open_basedir`限制
```$xslt
vi /usr/local/nginx/conf/fastcgi.conf
修改为
fastcgi_param PHP_ADMIN_VALUE "open_basedir=/home/wwwroot/ssmanager/:/tmp/:/proc/";

```

![修改fastcgi_param示例](https://github.com/ouhaohan8023/shadow.com/raw/master/pre/fastcgi.png)

##### 7.进入项目根目录（系统自动生成），拉取`github`项目
```$xslt
cd /home/wwwroot/shadow3.com
git clone https://github.com/ouhaohan8023/shadow.com.git tmp && mv tmp/.git . && rm -rf tmp && git reset --hard
```


##### 8.`composer`加载拓展（如果提示没有`fileinfo`组件，[传送门]()）
>composer install

##### 9.配置项目目录权限
```$xslt
cd /home/wwwroot/shadow3.com
php artisan key:generate
chown -R www:www storage/
chmod -R 777 storage/
```

##### 10.配置数据库
```$xslt
1.创建一个`utf8mb4`,`general_ci`的数据库
2.导入shadow3_cons.sql文件
3.在项目根目录下，生成.env文件，配置数据库信息，内容如下
```

```$xslt
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shadow3
DB_USERNAME=root
DB_PASSWORD=root
```
##### 11.重启`lnmp`
>lnmp restart

##### 12.截至到这一步，项目是可以正常打开的，浏览器中访问
>shadow3.com

```$xslt
这一步有两种情况：
1.项目搭建在本地：
    此种情况下，需要在hosts文件中，加入
    127.0.0.1   shadow3.com
2.项目搭建在服务器上，但是暂时没有域名指向（国内云主机是不开放80端口的，所以你需要将后台站点设置成8088或者其他可用端口）
    此种情况下，需要在hosts文件中，加入
    服务器ip   shadow3.com
    国外vps，直接访问shadow3.com
    国内云主机，设置nginx监听的端口，然后访问shadow3.com:8088（这一步的成功，是基于nginx的配置的，nginx默认配置端口80，需要改成8088）
3.项目搭建在国外vps，并且有域名指向；或者项目搭建在国内，已通过备案
    可以直接访问
```

##### 13.定时任务设置
```$xslt
* * * * * php /home/wwwroot/shadow3.com/artisan schedule:run >> /dev/null 2>&1
```
##### 14.邮件配置
````
编辑 config\mail.php

请自行配置如下内容
'driver' => 'smtp',
'host' => 'smtp.exmail.qq.com',
'port' => 465,
'from' => [
    'address' => 'xxx@qq.com',
    'name' => 'SSRPanel',
],
'encryption' => 'ssl',
'username' => 'xxx@qq.com',
'password' => 'xxxxxx',
````


#### 常见问题
```$xslt
1.提示找不到 `App\Sms\REST`类
    将Sms文件夹复制到/app/下
    在composer.json->autoload->classmap下加入
    "app/Sms"
    然后在根目录下运行`composer dumpautoload`即可
    
2.工单回复，图片上传失败

    chmod -R 777 /public/upload
```

## 更新内容
#### 1.增加手机号注册功能（验证码）
#### 2.增加个人资料手机号/邮箱绑定功能
#### 3.配合python脚本，实现后台节点一件安装功能
```angular2html
由于调用python脚本，需要提前安装python2.7以及相应拓展
拓展如下

yum remove python-gssapi.x86_64
wget https://bootstrap.pypa.io/get-pip.py
python get-pip.py
pip install paramiko

需要给public下python文件夹777权限

```

### 注意
```angular2html
再数据库删除用户的时候，记得清空对应的工单，不然会报错
```
```angular2html
php版本问题
亲测7.2.6有问题，只能用7.1
```
```angular2html
异地备份(用不上)
#生成公钥
ssh-keygen -t rsa
#将公钥传到存储备份文件的服务器上指定（默认都是root用户，如果是a用户，将root改成a即可）
例如：root@ip
scp id_rsa.pub root@154.85.192.90:/root/.ssh/authorized_keys_01
#输入密码
#登陆备份机，进行公钥导入（这一步的目的是，防止覆盖了你现有的公钥，如果现在没有，可以直接覆盖）
cat authorized_keys_01 >> authorized_keys
#ssh，scp就不需要输入密码了
```
```angular2html
加入定时任务
sh -x /home/wwwroot/shadow3.com/backUpDatabase.sh

```
```angular2html
将注册时候的邮件改成队列，提升响应速度
安装redis
cd ~
wget http://download.redis.io/releases/redis-4.0.10.tar.gz
tar -xzf redis-4.0.10.tar.gz
make
make install
安装predis
composer require predis/predis

# 不需要执行
php artisan make:job MailQueue
#需要执行
php artisan queue:work
#更改程序后
php artisan queue:restart
php artisan queue:work
#只运行某个队列
php artisan queue:work redis --queue=email
#检查进程是否运行
 ps aux | grep  artisan

```
```angular2html
centos7 安装supervisor
yum install python-setuptools
easy_install supervisor
cd /etc/
mkdir supervisord.d
echo_supervisord_conf > supervisord.conf
vim /etc/supervisord.conf
#加入以下配置信息
[include]
files = /etc/supervisord.d/*.conf

#创建文件
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=/usr/local/php7.1/bin/php  /home/wwwroot/XXX/artisan queue:work redis --queue=email
autostart=true
autorestart=true
#注意运行的用户，可能会造成用户无权限写入日志，报错，退出进程
user=root
#运行几个进程
numprocs=8
redirect_stderr=true
#日志记入地址
stdout_logfile=/home/wwwlogs/laravel-work.log

#关闭
/usr/bin/supervisorctl stop all    
#先关闭supervisor启动脚本，之后再关闭supervisord服务
ps ax | grep supervisor
kill pid

#启动
supervisord -c /etc/supervisord.conf

#查看进程
ps ax | grep supervisor
ps ax | grep artisan
```

```angular2html
与App对接时的一些考虑
现状：平台启用的都是ssr服务，但是再ios上，我们只找到了支持ss服务的客户端，怎样将将两者结合，成为了一个问题。
发现：在节点上启用的时候，会去调用数据库内的用户信息，其中包括了加密方式，协议，混淆。而在节点上配置的协议混淆是无效的。获取到参数后，在对应端口启动服务。所以说，可以给每个用户配置不同的参数。然后又了解到了_compatible。
解决：修改创建用户时候的默认协议，混淆参数，例如协议：auth_sha1_v4_compatible，混淆：tls1.2_ticket_auth_compatible；或者采用无协议：origin，无混淆：plain

```