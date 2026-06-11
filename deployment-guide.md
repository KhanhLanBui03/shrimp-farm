# Hướng dẫn Cài đặt Máy chủ EC2, cấu hình LEMP & Thiết lập CI/CD cho dự án Laravel

Tài liệu này cung cấp quy trình chuẩn từng bước để cài đặt máy chủ ảo (AWS EC2 hoặc VPS bất kỳ), cài đặt môi trường chạy Laravel (PHP, Nginx, MySQL, Node.js, Composer), thiết lập tên miền + SSL miễn phí, và tự động hóa triển khai (CI/CD) qua GitHub Actions.

---

## PHẦN 1: KHỞI TẠO MÁY CHỦ VPS / AWS EC2

1. **Khởi tạo Instance**:
   - Chọn hệ điều hành: **Ubuntu Server (LTS)** (khuyên dùng bản mới nhất như 22.04 hoặc 24.04).
   - Chọn loại máy chủ: `t2.micro` hoặc `t3.micro` (đối với AWS Free Tier).
   - Tạo và tải về file khóa SSH Key Pair dạng `.pem`.

2. **Cấu hình Tường lửa (Security Groups)**:
   Mở các cổng sau để máy chủ hoạt động trên internet:
   - `Port 22` (SSH): Cho phép kết nối và điều khiển máy chủ từ xa.
   - `Port 80` (HTTP): Cho phép truy cập trang web thông thường.
   - `Port 443` (HTTPS): Cho phép truy cập trang web bảo mật mã hóa SSL.

---

## PHẦN 2: KẾT NỐI SSH & CÀI ĐẶT HỆ THỐNG (LEMP STACK)

### 1. Kết nối SSH vào Server
Mở Terminal trên máy local và chạy lệnh:
```bash
ssh -i "duong/dan/den/key.pem" ubuntu@IP_CUA_SERVER
```

### 2. Cài đặt Bộ nhớ ảo SWAP (Bắt buộc với máy chủ RAM 1GB)
Để tránh tình trạng đứng máy, treo server khi chạy `npm install` hoặc build các tài nguyên nặng:
```bash
sudo fallocate -l 2G /swapfile
sudo chmod 600 /swapfile
sudo mkswap /swapfile
sudo swapon /swapfile
echo '/swapfile none swap sw 0 0' | sudo tee -a /etc/fstab
```

### 3. Cài đặt PHP & Các thư viện cần thiết
Đối với các phiên bản Ubuntu mới, PHP đã tích hợp sẵn trong kho chính thức (gõ `sudo apt update` trước):
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install php-fpm php-cli php-mysql php-curl php-xml php-mbstring php-zip php-gd php-bcmath unzip -y
```
*(Nếu muốn chỉ định bản PHP cố định, bạn cần add PPA: `sudo add-apt-repository ppa:ondrej/php -y`)*

### 4. Cài đặt Web Server Nginx & MySQL
```bash
sudo apt install nginx mysql-server -y
```

### 5. Cấu hình Database cho dự án
Đăng nhập MySQL:
```bash
sudo mysql
```
Chạy các câu lệnh SQL bên trong dấu nhắc `mysql>`:
```sql
CREATE DATABASE ten_database CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'ten_user'@'localhost' IDENTIFIED BY 'MatKhauBaoMat123@';
GRANT ALL PRIVILEGES ON ten_database.* TO 'ten_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 6. Cài đặt Composer & Node.js
```bash
# Cài đặt Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Cài đặt Node.js & NPM
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

---

## PHẦN 3: ĐƯA SOURCE CODE LÊN SERVER & CẤU HÌNH DỰ ÁN

1. **Cấp quyền ghi thư mục Web cho tài khoản SSH**:
   ```bash
   sudo chown -R ubuntu:www-data /var/www
   ```

2. **Kéo mã nguồn về máy chủ**:
   ```bash
   git clone REPO_URL_CUA_BAN /var/www/ten-thu-muc-du-an
   ```

3. **Cấu hình file môi trường `.env`**:
   ```bash
   cd /var/www/ten-thu-muc-du-an
   cp .env.example .env
   nano .env
   ```
   *Chỉnh sửa cấu hình Database, `APP_ENV=production`, `APP_DEBUG=false`, và `APP_URL=http://ten-mien-cua-ban`*.

4. **Cài đặt dependencies và tạo Key cho Laravel**:
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan key:generate
   php artisan migrate --seed # (Hoặc bỏ --seed nếu không cần nạp dữ liệu mẫu)
   npm install
   npm run build
   ```

5. **Phân quyền các thư mục động của Laravel**:
   ```bash
   # Tạo các thư mục con nếu chưa có
   mkdir -p storage/app/public storage/framework/cache/data storage/framework/sessions storage/framework/views storage/logs
   
   # Cấp quyền cho Nginx đọc ghi
   sudo chown -R ubuntu:www-data storage bootstrap/cache
   sudo chmod -R 775 storage bootstrap/cache
   ```

---

## PHẦN 4: CẤU HÌNH WEB SERVER NGINX & SSL (HTTPS)

### 1. Tạo File cấu hình Nginx
```bash
sudo nano /etc/nginx/sites-available/ten-du-an
```
*Dán đoạn cấu hình Nginx chuẩn cho Laravel sau:*
```nginx
server {
    listen 80;
    server_name ten-mien-cua-ban.com;
    root /var/www/ten-thu-muc-du-an/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        # Lưu ý: Sửa lại đường dẫn socket php-fpm đúng với phiên bản PHP cài trên máy
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock; 
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 2. Kích hoạt cấu hình Nginx
```bash
# Liên kết file
sudo ln -s /etc/nginx/sites-available/ten-du-an /etc/nginx/sites-enabled/
# Xóa cấu hình default cũ
sudo rm /etc/nginx/sites-enabled/default
# Kiểm tra lỗi cú pháp
sudo nginx -t
# Khởi động lại Nginx
sudo systemctl restart nginx
```

### 3. Cài đặt SSL (HTTPS) miễn phí qua Certbot
Sau khi bạn đã trỏ tên miền (ví dụ tên miền mua riêng hoặc từ DuckDNS) về IP của VPS thành công:
```bash
sudo apt install certbot python3-certbot-nginx -y
sudo certbot --nginx -d ten-mien-cua-ban.com
```
*Làm theo hướng dẫn trên màn hình (nhập email, chọn Đồng ý điều khoản `Y`) để hoàn tất cài đặt SSL tự động.*

---

## PHẦN 5: TỰ ĐỘNG HÓA DEPLOY (CI/CD) QUA GITHUB ACTIONS

### 1. Tạo file Workflow trong dự án của bạn
Tại máy tính local, tạo một file cấu hình tại thư mục dự án:
`.github/workflows/deploy.yml`

*Nội dung file:*
```yaml
name: Deploy Application to Server

on:
  push:
    branches: [ main ] # Nhánh kích hoạt tự động deploy (ví dụ: main hoặc master)

jobs:
  deploy:
    runs-on: ubuntu-latest

    steps:
    - name: Checkout code
      uses: actions/checkout@v3

    - name: Set up PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.2' # Phiên bản PHP dùng để build

    - name: Install Composer Dependencies
      run: composer install --no-progress --prefer-dist --optimize-autoloader

    - name: Setup Node.js
      uses: actions/setup-node@v3
      with:
        node-version: '20'

    - name: Install NPM & Compile Assets
      run: |
        npm install
        npm run build

    - name: Deploy to Server via SSH
      uses: appleboy/ssh-action@master
      with:
        host: ${{ secrets.EC2_HOST }}
        username: ubuntu
        key: ${{ secrets.EC2_SSH_KEY }}
        script: |
          cd /var/www/ten-thu-muc-du-an
          git pull origin main
          composer install --optimize-autoloader
          php artisan migrate --force
          npm install
          npm run build
          php artisan config:cache
          php artisan route:cache
          php artisan view:cache
          sudo chown -R ubuntu:www-data storage bootstrap/cache
          sudo chmod -R 775 storage bootstrap/cache
```

### 2. Cấu hình Secrets trên GitHub Repository
Truy cập kho GitHub dự án của bạn -> **Settings** -> **Secrets and variables** -> **Actions** -> **New repository secret**:
* **`EC2_HOST`**: Điền IP công cộng của server (VPS).
* **`EC2_SSH_KEY`**: Sao chép toàn bộ nội dung file key bí mật `.pem` dùng để SSH của bạn và dán vào đây.

Bây giờ, chỉ cần chạy lệnh `git push` từ máy local, GitHub Actions sẽ tự động thực hiện từ khâu build asset đến deploy hoàn tất lên server trong vài phút!
