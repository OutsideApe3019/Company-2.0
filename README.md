# Company
Company 2.0 is a Laravel 10 template, to help users create a website easly

## How to install
```bash
git clone https://github.com/OutsideApe3019/Company-2.0
cd Company-2.0
composer install
npm install
# on windows:
copy .env.example .env
# on linux:
cp .env.example .env
```
modify the `.env` file

migrate:
```bash
php artisan migrate
```
seed:
```bash
php artisan db:seed
```
seeding the database will be created:
- an user:
  - name: admin
  - email: admin@company.com
  - password: admin
- two roles:
  - user:
    - name:user
    - color: #aaaaaa (gray)
    - prefix: User
    - 0 permissions
  - admin:
    - name: admin
    - color: #ff5555 (red)
    - prefix: Admin
    - all the permissions
- some default permissions

modify the admin's password