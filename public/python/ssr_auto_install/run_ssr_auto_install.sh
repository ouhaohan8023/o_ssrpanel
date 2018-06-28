#!/bin/bash
host=$1
port=$2
user=$3
passwd=$4
dbname=$5
node_id=$6
transfer_mul=$7
#节点信息,ip:端口:用户名:密码
node_ip=$8
node_port=$9 
node_username=${10}
node_password=${11}
#root_dir="/home/wwwroot/shadow3.com/public/python/ssr_auto_install"
root_dir=${12}

#ps -ef|grep ssr_auto_install.py|grep $node_ip|grep -v grep| awk '{print $2}'| xargs kill -9
cd $root_dir
/usr/bin/python ssr_auto_install.py $host $port $user $passwd $dbname $node_id $transfer_mul $node_ip $node_port $node_username $node_password