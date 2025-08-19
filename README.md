# Deploying Laravel on AWS

## 1. Set up an EC2 instance

1. Log in to your AWS Management Console.
2. Navigate to the EC2 Dashboard.
3. Click on "Launch Instance."
4. Choose an Amazon Machine Image (AMI) - select an Ubuntu Server 22.04 LTS (HVM), SSD Volume Type.
5. Choose an Instance Type - select t3.small.
6. Key pair (Login) - select an existing key pair or create a new one.
7. Network settings - tick all boxes (Allow SSH, HTTPS, HTTP).
8. Configure storage - leave defaults.
9. Launch instance.


## 2. Connect to EC2 instance

### Open Windows Powershell.

### Connect to your instance using SSH:

   ```bash
   ssh -i /path/to/your-key.pem ubuntu@your-public-ip
   ```
> Replace `/path/to/your-key.pem` with the path to your key pair file and `your-public-ip` with the public IPv4 address

### Update your package manager:
   
   ```bash
   sudo apt update
   ```


## 3. Adds PHP repository

- adds a new software source (repository) to Ubuntu.
- unlocks more PHP versions for you to install via apt.

```bash
sudo add-apt-repository ppa:ondrej/php
```


## 4. Install PHP and required extensions

### Install PHP 8.3 and commonly used extensions
    
```bash
sudo apt install php8.3 php8.3-cli php8.3-{bz2,curl,mbstring,intl,xml,zip} unzip
sudo apt-get install php8.3-mysql
```

### Install PHP 8.3 FPM (FastCGI Process Manager)
- a service that lets your web server (Apache/Nginx) *run PHP apps seperately but efficiently*
    
```bash
sudo apt install php8.3-fpm
```

### Enable PHP 8.3 FPM configuration
- enables the PHP 8.3 FPM configuration for Apache

```bash
sudo a2enconf php8.3-fpm
sudo systemctl reload apache2
sudo systemctl restart apache2
```

### Install additional PHP extensions
- installs a few PHP extensions that are not install by default (Laravel commonly require these)
```bash
sudo apt install php8.3-{calendar,ctype,exif,ffi,fileinfo,ftp,gettext,iconv,pdo,phar,posix,shmop,sockets,sysvmsg,sysvsem,sysvshm,tokenizer}
```

### Install web php packages
- these packages are commonly required when developing and running Laravel applications.
```bash
sudo apt install apache2 libapache2-mod-php8.3
```

### List installed PHP packages
- lists all installed PHP packages

```bash
dpkg -l | grep php | tee packages.txt
```

### Check PHP version

```bash
php -v
```

### Check Apache version
- verifies the installed Apache version

```bash
apache2 -v
```

### enable apache's rewrite engine 
- to prevent 404 Not Found
```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```


## 5. Install Composer

### Download and install Composer

```bash
curl -sS https://getcomposer.org/installer | php
```

### Move Composer to a global location
- moves the Composer binary to `/usr/local/bin` so you can run it from anywhere

```bash
sudo mv composer.phar /usr/local/bin/composer
```

### Set permissions for Composer
- sets the appropriate permissions for the Composer binary

```bash
sudo chmod +x /usr/local/bin/composer
```

### Check Composer version

```bash
composer -v
```

## 6. Install Git

### Check Git version

```bash
git --version
```

### Install Git (if not installed)

```bash
sudo apt install git -y
```


## 7. Install MySQL

### Install MySQL Server

```bash
sudo apt install mysql-server -y
```

### Check MySQL version

```bash
mysql --version
```

### Start MySQL
- starts the MySQL service

```bash
sudo systemctl start mysql
```

### Enable MySQL 
- enables MySQL service everytime server run

```bash
sudo systemctl enable mysql
```

### Check MySQL status
- checks if MySQL is running

```bash
sudo systemctl status mysql
```


## 8. Configure MySQL

### Allowing remote connections

```bash
sudo nano /etc/mysql/mysql.conf.d/mysqld.cnf
```
> Change bind-address to 0.0.0.0

- Restarts MySQL to apply changes
```bash
sudo systemctl restart mysql
```

### Log into MySQL
- log into the MySQL server as the root user

```bash
sudo mysql -u root -p
```

### Create a new MySQL user
- creates a new user with privileges
```bash
CREATE USER '<your_name>'@'%' IDENTIFIED BY '<your_password>';
```
> Replace `<your_name>` and `<your_password>` with your desired username and password

### Grant privileges to the new user
- grants the new user permissions to create, alter, drop, insert, update, delete, select, and reference databases and tables

```bash
GRANT CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT, REFERENCES, RELOAD on *.* TO '<your_name>'@'%' WITH GRANT OPTION;
```
> Replace `<your_name>` with the username you created earlier

### Apply changes
- applies the changes made to user privileges

```bash
FLUSH PRIVILEGES;
```

### Exit MySQL

```bash
exit
```


## 9. Firewall Configuration

### Check UFW status
- verifies if UFW (Uncomplicated Firewall) is active

```bash
sudo ufw status
```

### Enable UFW

```bash
sudo ufw enable
```

### Allow port 22 & 80 & 3306
- allows incoming traffic on ports 22 (SSH), 80 (HTTP), and 3306 (MySQL)

```bash
sudo ufw allow 22
sudo ufw allow 80
sudo ufw allow 3306
```

### Recheck UFW status
- make sure all ports (22, 80, 3306) are active

```bash
sudo ufw status
```


## 10. Connect to database

### Add inbound rules in your instance
1. Open instance
2. Click security -> security groups
3. Click Edit inbound rule
4. Add rule -> select Type: MySQL/Aurora and Source: 0.0.0.0/0 (for open access)
5. Click on save rules

### Add MySQL connection in DBeaver
1. Open DBeaver
2. Create new connection
3. Select MySQL
4. Enter Server Host: your-public-ip
5. Enter Username and Password based on MySQL Details you created before
6. Go to Driver Properties
7. Change allowPublicKeyRetrieval to TRUE
8. Click Test Connection
9. Click Finish

## 11. Laravel Setup

### Access the default document root
- navigates to the default document root for Apache

```bash
cd /var/www/html
```

### Set web server ownership
- Gives Apache (`www-data`) full access to the project folder

```bash
sudo chown -R www-data:www-data .
```

### Clone your Laravel project
- clones your Laravel project from a Git repository

```bash
sudo git clone <repo-url>
```
> Replace `<repo-url>` with the URL of your Git repository

### Access your project directory
- navigates into the project directory

```bash
cd <repo-name>
```
> Replace `<repo-name>` with the name of your cloned repository

- Change the owner of your Laravel project folder (root->user)
```bash
sudo chown -R $(whoami) /var/www/html/<repo-name>
```

### Copy and configure .env file
```bash
sudo nano .env
cp .env.example .env
sudo nano .env
```
- change APP_URL=http://`your-public-ip`
- uncomment lines below and replace `your_database`, `your_username`, and `your_password` with your MySQL details
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Ensure dependencies are ready
- to make sure your project has all its dependencies ready, use
```bash
composer install
```

### Ownership and permission change
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data /var/www/html/<repo-name>/storage /var/www/html/<repo-name>/bootstrap/cache
sudo chmod -R 775 /var/www/html/<repo-name>/storage /var/www/html/<repo-name>/bootstrap/cache
```

### Generate app key and create table
- generates a new application key for your Laravel project
- builds your database tables according to Laravel’s migration files.
```bash
php artisan key:generate
php artisan migrate
```


## 11. Configure Apache for Laravel

### Goes into Apache’s site configuration directory.
```bash
cd /etc/apache2/sites-available
sudo nano <repo-name>.conf
```
- Copy all the line below and paste in ticketing-system.conf
```
<VirtualHost *:80>
   ServerName <ip>
   DocumentRoot /var/www/html/<repo-name>/public

   <Directory /var/www/html/<repo-name>>
       AllowOverride All
        Require all granted
   </Directory>
   ErrorLog ${APACHE_LOG_DIR}/error.log
   CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

### Disable default site
```bash
sudo a2dissite 000-default.conf
sudo systemctl reload apache2
```

### Create and enable new site
```bash
sudo a2ensite <repo-name>.conf
sudo systemctl reload apache2
```

## 12. Open your project
1. Go to web browser
2. Serve `ip/tickets`
