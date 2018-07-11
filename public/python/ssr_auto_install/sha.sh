#!/bin/bash
netstat -ntl | grep 10010 >> /dev/null
if [ $? -ne 0 ]
then
/root/SSR_server/stop.sh
/root/SSR_server/run.sh
fi
