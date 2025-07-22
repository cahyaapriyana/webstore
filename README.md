# Laravel Webstore

Aplikasi Webstore berbasis Laravel, dilengkapi dengan fitur manajemen produk, pesanan, user, integrasi pembayaran (Moota), pengiriman, dan dashboard admin berbasis Filament.

## Fitur Utama

-   **Manajemen Produk**: CRUD produk, kategori, tag, dan stok.
-   **Keranjang & Checkout**: User dapat menambah produk ke keranjang dan melakukan checkout.
-   **Manajemen Pesanan**: Lacak status pesanan, pembayaran, dan pengiriman.
-   **Integrasi Pembayaran Moota**: Otomatisasi verifikasi pembayaran via webhook Moota.
-   **Integrasi Pengiriman**: Mendukung beberapa metode pengiriman (API & offline).
-   **Dashboard Admin (Filament)**: UI admin modern untuk mengelola produk, pesanan, user, dan role/permission.
-   **Role & Permission**: Manajemen hak akses dengan Filament Shield.
-   **Notifikasi Email**: Konfirmasi pesanan, update status, dan lainnya.
-   **Region & Shipping Service**: Pengelolaan wilayah dan layanan pengiriman.

## Struktur Folder Penting

-   `app/Models/` — Model utama (Product, SalesOrder, User, dsb)
-   `app/Services/` — Service layer untuk bisnis logic (Checkout, Payment, Shipping, dsb)
-   `app/Jobs/` — Queue jobs (misal: MootaPaymentJob)
-   `app/Filament/Resources/` — Resource untuk dashboard admin Filament
-   `app/Livewire/` — Komponen Livewire untuk frontend interaktif
-   `routes/web.php` — Definisi rute web & webhook
-   `config/webhook-client.php` — Konfigurasi webhook (Moota, dsb)
-   `resources/views/` — Blade templates untuk frontend & email

## Instalasi

1. **Clone repository**

    ```bash
    git clone <repo-url>
    cd webstore
    ```

2. **Install dependencies**

    ```bash
    composer install
    npm install && npm run build
    ```

3. **Copy file environment**

    ```bash
    cp .env.example .env
    ```

4. **Atur konfigurasi .env**

    - Database, mail, dan variabel lain sesuai kebutuhan.
    - Contoh untuk webhook Moota:
        ```
        WEBHOOK_CLIENT_SECRET=secret
        MOOTA_ACCESS_TOKEN=...
        ```

5. **Generate key & migrate database**

    ```bash
    php artisan key:generate
    php artisan migrate --seed
    ```

6. **Jalankan server**

    ```bash
    php artisan serve
    ```

7. **Akses dashboard admin**
    - Buka `http://localhost:8000/admin` (atau sesuai konfigurasi Filament)
    - Login dengan user yang sudah di-seed atau buat user baru.

---

## Setup & Pengembangan

### 1. **Install/Update Livewire**

Aplikasi ini menggunakan Livewire untuk komponen interaktif.

```bash
composer require livewire/livewire
```

Untuk publish asset Livewire (jika perlu):

```bash
php artisan livewire:publish --assets
```

### 2. **Menambah Komponen Livewire**

Buat komponen baru:

```bash
php artisan make:livewire NamaKomponen
```

File akan muncul di `app/Livewire/` dan view-nya di `resources/views/livewire/`.

### 3. **Menambah Resource Filament**

```bash
php artisan make:filament-resource NamaResource
php artisan optimize:clear
```

Agar resource baru muncul di menu admin.

### 4. **Menambah Custom Command**

Jika menambah command di `app/Console/Commands/`, jalankan dengan:

```bash
php artisan nama:command
```

Contoh:

```bash
php artisan salesorder:check-due
```

Lihat semua command:

```bash
php artisan list
```

### 5. **Menambah Seeder**

```bash
php artisan make:seeder NamaSeeder
php artisan db:seed --class=NamaSeeder
```

### 6. **Menambah Migration**

```bash
php artisan make:migration nama_migration
php artisan migrate
```

### 7. **Testing**

Jalankan semua test:

```bash
php artisan test
```

Atau test spesifik:

```bash
php artisan test --filter=NamaTest
```

---

## Webhook Moota

-   Endpoint: `/moota/callback`
-   Validasi signature menggunakan header `Signature` (HMAC-SHA256 dari body dengan secret di `.env`)
-   Otomatis memproses pembayaran jika data valid.

---

## Troubleshooting

-   **Resource Filament tidak muncul di menu:**  
    Jalankan `php artisan optimize:clear` setelah membuat resource baru.
-   **Perubahan tidak muncul:**  
    Jalankan `php artisan cache:clear` dan refresh browser.
-   **Error permission (Filament Shield):**  
    Pastikan user punya permission yang sesuai, atau update permission di menu Roles.

---

## Kontribusi

1. Fork repo ini
2. Buat branch fitur/bugfix baru
3. Pull request ke branch `main`

## Lisensi

MIT

---

> **Catatan:**  
> Untuk integrasi webhook dan signature di Postman, lihat dokumentasi di bagian atas README ini atau di folder `docs/`.
