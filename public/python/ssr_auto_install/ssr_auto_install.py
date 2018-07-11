#!/usr/local/bin/python
#coding=utf-8
__author__ = 'larry'
import sys,os
import paramiko
import threading
import json
import time
import ConfigParser
from func import *
reload(sys)
sys.setdefaultencoding('utf-8')

#mysql配置信息,从命令行输入
host = sys.argv[1]
port = int(sys.argv[2])
user = sys.argv[3]
passwd = sys.argv[4]
dbname = sys.argv[5]
node_id = int(sys.argv[6])
transfer_mul = float(sys.argv[7])
#节点信息,ip:端口:用户名:密码
node_ip = sys.argv[8]     
node_port = int(sys.argv[9])
node_username = sys.argv[10]
node_password = sys.argv[11]

#获取其他配置参数
cf = ConfigParser.ConfigParser()
curr_dir = os.path.split(os.path.realpath(__file__))[0]
confile = curr_dir + '/conf/init.conf'
#confile ='./conf/init.conf'
cf.read(confile)
timeout = int(cf.get("param", "timeout")) #ssh超时时间


#将msyql配置信息写入本地文件
def wrt_json_file(dest_dir,dest_file,str_json):
    with open(os.path.join(dest_dir,dest_file),"w") as f:
        f.write(str_json)    

#上传mysql配置文件到节点服务器
def put_mysql_json_file(src_dir,src_file,dest_dir,dest_file):
    t = paramiko.Transport((node_ip, node_port)) 
    t.connect(username=node_username, password=node_password) 
    sftp = paramiko.SFTPClient.from_transport(t) 
    sftp.put(os.path.join(src_dir,src_file), os.path.join(dest_dir,dest_file)) 
    t.close()

#建立ssh连接
def get_ssh_client():
    client = paramiko.SSHClient()
    client.set_missing_host_key_policy(paramiko.AutoAddPolicy())
    client.load_system_host_keys()
    client.connect(node_ip, port=node_port,username=node_username, password=node_password,timeout=timeout)
    return client

#输出执行结果
def print_output(code,msg):
    d = {'code':code,'msg':msg}
    output = json.dumps(d) 
    print(output)

command = "\'*/5 * * * * root sh /bin/sha.sh >& /dev/null\'"
#需要在节点上执行的命令
l_cmd = ['cd ~',
         'yum install -y git',
         'git clone https://github.com/ouhaohan8023/SSR_server.git',
         'cd SSR_server;cp config.json user-config.json;cp apiconfig.py userapiconfig.py;chmod +x run.sh',
         'systemctl status firewalld|if [ $? == 0 ];then systemctl stop firewalld; fi;',
         'cat <(fgrep -i -v %s <(crontab -l)) <(echo %s) | crontab' % (command,command)
        ]


wr_log('info','节点%s开始安装...'%(node_ip))

#获取ssh连接
try:
    client = get_ssh_client()
except Exception as e:
    lno = sys.exc_info()[-1].tb_lineno
    msg = 'Failed to get ssh connection:line no {},error message:{}'.format(lno,str(e))
    wr_log('warning',msg)
    print_output(1,msg)
    sys.exit(1)

#开始执行命令列表
try:
    for cmd in l_cmd:
        stdin, stdout, stderr = client.exec_command(cmd)
        exit_status = stdout.channel.recv_exit_status()  
        wr_log('info',cmd)
        str_out = ''.join(stdout.readlines())
        str_error = ''.join(stderr.readlines())
        if exit_status == 0:
            msg = str_out
            level = 'info'
            wr_log(level,msg)
        else:
            msg = '\n'.join([str_out,str_error])
            msg = 'error occurred while executing command:{},error message:{}'.format(cmd,msg)
            level = 'warning'
            wr_log(level,msg)
            print_output(1,msg)
            sys.exit(1)



except Exception as e:
    lno = sys.exc_info()[-1].tb_lineno
    msg = 'error occurred while executing command:line no {},error message:{}'.format(lno,str(e))
    wr_log('warning',msg)
    print_output(1,msg)
    sys.exit(1)

#生成连接db配置文件信息
s_my_config = '''{
             "host":"%s",
             "port":%s,
             "user":"%s",
             "password":"%s",
             "db":"%s",
             "node_id":%s,
             "transfer_mul":%s,
             "ssl_enable": 0,
             "ssl_ca": "",
             "ssl_cert": "",
             "ssl_key": ""\n}'''%(host,port,user,passwd,dbname,node_id,transfer_mul)

#写入到本地
src_dir = '.'
src_file = 'usermysql_{}.json'.format(node_ip)
try:
    wrt_json_file(src_dir,src_file,s_my_config)
except Exception as e:
    lno = sys.exc_info()[-1].tb_lineno
    msg = 'Failed to write mysql configuration to local file:line no {},error message:{}'.format(lno,str(e))
    wr_log('warning',msg)
    print_output(1,msg)
    sys.exit(1)

#上传到节点
dest_dir = '/root/SSR_server'
dest_file = 'usermysql.json'

try:
    put_mysql_json_file(src_dir,src_file,dest_dir,dest_file)
    put_mysql_json_file('.', 'sha.sh', '/bin', 'sha.sh')
except Exception as e:
    lno = sys.exc_info()[-1].tb_lineno
    msg = 'Failed to upload mysql configuration file to remote node:line no {},error message:{}'.format(lno,str(e))
    wr_log('warning',msg)
    print_output(1,msg)
    sys.exit(1)
#运行run.sh
cmd = 'cd /root/SSR_server;./run.sh'
try:
    wr_log('info',cmd)
    stdin, stdout, stderr = client.exec_command(cmd)
    l = stderr.readlines()
    assert len(l) == 0,l[0]
except Exception as e:
    lno = sys.exc_info()[-1].tb_lineno
    msg = 'error occur when running script run.sh:line no {},error message:{}'.format(lno,str(e))
    wr_log('warning',msg)
    print_output(1,msg)
    sys.exit(1)
#部署完成
msg = 'node {} deployment was successful!'.format(node_ip)
wr_log('info',msg)
print_output(0,msg)

