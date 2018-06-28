# coding=utf-8
import os,sys
import ConfigParser
import logging
import paramiko

#写日志函数
def wr_log(lv,msg):
    cf = ConfigParser.ConfigParser()
    curr_dir = os.path.split(os.path.realpath(__file__))[0]
    confile = curr_dir + '/conf/init.conf'
    cf.read(confile)
    logfile = cf.get("log", "logfile")
    logging.basicConfig(level=logging.INFO,
                    #format='%(asctime)s %(filename)s[line:%(lineno)d] %(levelname)s %(message)s',
                    format='%(asctime)s %(levelname)s %(message)s',
                    datefmt='%Y-%m-%d %H:%M:%S',
                    filename=logfile,
                    filemode='a')
    if lv == 'info':
        logging.info(msg)
    elif lv == 'debug':
        logging.debug(msg)
    elif lv == 'warning':
        logging.warning(msg)
    else:
        pass

#上传文件
