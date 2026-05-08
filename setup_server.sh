#!/bin/bash

sudo yum update -y
sudo yum install httpd php php-mysqli mariadb105-server git -y

sudo systemctl start httpd
sudo systemctl enable httpd

sudo systemctl start mariadb
sudo systemctl enable mariadb

cd /var/www/html
sudo rm -rf *

sudo git clone https://github.com/RicardoDomi/Cut-Adoption .

sudo mysql -e "CREATE DATABASE IF NOT EXISTS adopta_cut;"
sudo mysql -e "CREATE USER IF NOT EXISTS 'adopta_user'@'localhost' IDENTIFIED BY 'Adopta123';"
sudo mysql -e "GRANT ALL PRIVILEGES ON adopta_cut.* TO 'adopta_user'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

sudo mysql adopta_cut < Proyecto/adopta_cut.sql

sudo systemctl restart httpd

echo "Proyecto desplegado correctamente"