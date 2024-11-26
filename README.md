<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Test Backend MGE Backend with Laravel


## Documentation Postman API
https://documenter.getpostman.com/view/12266282/2sAYBVgqr8

- Export postman berada di folder api_postman

## Fitur 

- Autentikasi (Login, Register, Logout)
- CRUD Master Barang
- Update (tambah & kurang stok)
- Cari data harga berdasarkan tanggal
- Cari data stok berdasarkan tanggal
- Search barang dengan parameter (seperti pada tes frontend)

## Data seeder User

**Admin**

- username: Admin
- Password: password

**User**

- username: User
- Password: password

## Install

**Clone Repository**

```bash
git clone https://github.com/TeddyFirman/test_mge_backend_API.git
```

**Download zip**

```bash
extract file zip
```

## Buka di kode editor


## Install composer

```bash
composer install
```

## Copy .Env

```bash
copy .env.example menjadi .env
```

## Buka Web Server


## Buat database di localhost 

```bash
nama database : mge_backend (atau pilihan pengguna)
```

## Setting database di .env

```bash
DB_PORT=3306
DB_DATABASE=mge_backend
DB_USERNAME=root
DB_PASSWORD=
```

## Generate key

```bash
php artisan key:generate
```

## Jalankan migrate dan seeder

```bash
php artisan migrate --seed 
```

- ATAU bisa mengimport database yang sudah saya export di folder database

## Buat Storage Link

```bash
php artisan storage:link
```


## Jalankan Serve

```bash
php artisan serve
```

## License

- Copyright © 2024 TeddyFirman.
