
# 開發環境
#### 本機
- 系統 Windows 10
- 編輯器 VSCODE

#### Docker 容器內
- Ubuntu 22
- Laravel 10
- PHP    8.1
- MySQL 8.0

![image](https://user-images.githubusercontent.com/12877999/223581437-75d4aa89-b829-4e22-a0e6-ba821d6c1a38.png)

---

# 第一部分 主機上建設容器

## 用 Ubuntu 映像創建容器 並指定 3000 轉到容器80
```docker run -d -it -p 3000:80 --name nueiptest1 ubuntu:22.04```
## 進入容器內部 ( 意外關機可以用 docker start nueiptest1 )
```docker attach nueiptest1```


# 第二部分 容器內操作
```
apt-get update && apt-get install -y git php8.1-fpm php8.1-dom php8.1-xml php8.1-curl php8.1-mysql php8.1-gd mysql-server nginx composer
```
# Set SQL Root Password
```
service mysql start

mysql -u root -p

CREATE DATABASE nueip_php_local;
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'a3SoifvRDU2qc2Peb';
FLUSH PRIVILEGES;

exit


service mysql stop
service mysql start
```

# Git Project
```
cd /var/www/html
git clone https://github.com/zxc88645/NUEIP-PHP.git
chown -R www-data:www-data NUEIP-PHP
chown -R www-data:www-data NUEIP-PHP/storage/logs
chmod -R 775 NUEIP-PHP/storage/logs
chown -R www-data:www-data NUEIP-PHP/storage/app/public
chmod -R 775 NUEIP-PHP/storage/app/public
cd NUEIP-PHP
composer install
```

# Set NGINX config & Laravel
```
cp .env.example .env
cp nginx/default /etc/nginx/sites-available/default

service php8.1-fpm stop 
service nginx stop
service mysql stop

service php8.1-fpm start 
service nginx start
service mysql start

service mysql reload 
service php8.1-fpm reload 
service nginx reload

php artisan cache:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache


php artisan migrate
```
# RUN
```
http://localhost:3000/NUEIP/accounts
```
