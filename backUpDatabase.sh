#!/bin/bash
#
file_name=$(cat /home/www/nowJob)
ip_addr=154.85.192.90
path='/home/www/chuanYunTiBackUp'
scp /home/www/$file_name root@$ip_addr:$path
