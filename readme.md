#donkeyli

##安装环境
php5.4以上
redis 软件安装
openOffice 软件安装
java 环境安装 （路径加入环境变量）
jodconverter-2.2.2 jar工具包下载//用来转换word文件成pdf，通过使用openoffice转变，运行jodconverter必须安装java环境，转换文件必须安装openOffice软件
安装完成进入openOffice根目录执行 soffice -headless -accept="socket,host=127.0.0.1,port=8100;urp;" -nofirststartwizard

##常驻进程
openOffice
redis
queue:listen 队列监听
