#Redis

[TOC]

##基本

默认端口：6379

源码安装的重启方式：redis-cli -h 127.0.0.1 -p 6379 shutdown

##特点

Redis是完全开源的免费的，高性能的key-value数据库，其主要特点如下：
1. 支持数据值就化，可以将内存中的数据保存在磁盘中，重启的时候可以再次加载进行使用
2. 支持多种数据类型，比如list，set，zset，hash等
3. 支持数据备份，即master-slave模式的数据备份
4. 所有的操作都是原子性的，即要么成功执行，要是失败完全不执行
5. 丰富的特性，还指出订阅，推送，通知，key过期等操作

##客户端连接

linux上基本的客户端打开方式

**本机客户端**

```
root@ubuntu:~# redis-cli 
127.0.0.1:6379> 
```

**远程客户端**

语法：redis-cli -h host -p port -a password

注意：默认redis是没有开启远程连接的，需要修改redis.conf

注释配置文件中的`bind 127.0.0.1`，以及修改`protected-mode yes`为`protected-mode no`

完成上面的修改之后，重启redis就能远程连到redis服务器了

```
root@(none):/home/ubuntu# redis-cli -h 192.168.119.90 -p 6379
192.168.119.90:6379> 
```

但是可以看到这样是不安全的，因为可能会被非维护人员进行入侵操作，所以需要设置密码

依旧是修改`redis.conf`，找到`requirepass foobared`并去掉前面的注释，然后修改后面的参数为你想要设置的密码
例如: `requirepass saki123456`
接着重启redis

接下来你会发现虽然你能通过命令连接上redis，但是无法进行操作
```
root@(none):/home/ubuntu# redis-cli -h 192.168.119.90 -p 6379
192.168.119.90:6379> keys *
(error) NOAUTH Authentication required.
```
因为你需要在连接的时候加上密码的参数：
```
root@(none):/home/ubuntu# redis-cli -h 192.168.119.90 -p 6379 -a 'saki123456'
192.168.119.90:6379> keys *
 1) "raw_addr:new_product_list:id2"
 2) "APPLISTSTATE:PRODUCTID:CHANNELID:26:70"
 3) "status:new_app_list:product_id:channel_id:2:1"
 4) "status:new_app_list:product_id:channel_id:5:3"
```
这样就能安全的进行远程redis操作了

【重要】要注意的是，设置了密码之后在本机使用redis-cli命令也需要加上密码参数才能使用了
如果你不加上密码参数，可以在进入客户端之后使用auth命令进行操作授权
如下：
```
root@ubuntu:/# redis-cli
127.0.0.1:6379> auth 'saki123456'
OK
127.0.0.1:6379> keys *
 1) "raw_addr:new_product_list:id2"
```




##数据类型

见对应文件夹中的内容

