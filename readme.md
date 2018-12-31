# **Catatan yang dirasa Perlu**

# Library Aplikasi

1. `sentinel` = untuk login Sentinel
2. `laravel-toast` = pemberitahuan dengan toast
3. `laravelcollective/html` = untuk menggunakan *Form Open*
4. `simple-qrcode` = untuk qr-code

# Instalasi

Sebelum melakukan instalasi, pastikan composer telah terinstall.

1. Download source code dalam bentuk zip atau menggunakan git

   `git clone https://github.com/reshap0318/SIMASSET.git`

2. Install php package dengan perintah

   `composer install`

3. copy file `env.example` dan ubah namanya menjadi `.env`. Konfigurasi file `.env` tersebut terutama untuk database

4. Buat key untuk aplikasi melalui peintah

   `php artisan key:generate`

5. Jalankan perintah migrate untuk membuat databasenya

   `php artisan migrate --seed`

6. Buka aplikasi dengan menggunakan browser dan login dengan menggunakan username `admin` password `4dm1n#123`

# Catatan Untuk Sentinel :
`Sentinel Menggunakan Array, jadi Usahakan Selalu Menggunakan Array, disini saya menggunakan array dengan nama creadentials

$credentials = [

    'email'    => 'john.doe@example.com',

    'password' => 'password',

];
`

1. untuk *Login* menggunakan `Sentinel::authenticate($creadentials)`

2. untuk *Registrasi* menggunakan `Sentinel::register($creadentials)` karena sentinel membutuhkan Aktivasi user maka untuk regis gampangnya seperti ini `Sentinel::registerAndActivate($creadentials)`

3. untuk *cek ada yang login atau tidak*, menggunakan `Sentinel::check()` gunakan didalam if

4. untuk *Cek yang membuka halaman adalam tamu*, menggunakan `Sentinel::guest()` gunakan didalam if

5. untuk *Mengambil data user(sendiri)*, menggunakan `Sentinel::getUser()`, misalkan `Sentinel::getUser()->id`

6. untuk *logout*, menggunakan `Sentinel::logout()`

7. untuk *menglogoutkan user lain yang login*, menggunakan

    `$user = Sentinel::findUserById(1)

      Sentinel::logout($user, true)
      `

8. untuk *mencari user dengan id*, menggunakan `Sentinel::findById(1)`

9. untuk *Mencari data lain, tampa id*, menggunakan `Sentinel::findByCredentials($credentials)`, tapi kita disini menggunakan array, seperti array di atas

10. untuk *mencari user dengan role(jabatan) tertentu*, menggunakan `Sentinel::inRole($role)`

11. untuk *Mencari role(jabatan) berdasarkkan id*, menggunakan `Sentinel::findRoleById(1)`

12. untuk *Mencari Role(jabatan) berdasarkan namanya(slug)*, menggunakan `Sentinel::findRoleBySlug()`, dan ada juga `Sentinel::findRoleByName()`

13. untuk *Menambahkan Role*, menggunakan `$role = Sentinel::getRoleRepository()->createModel()->create($credentials)`

14. untuk *Memberi Role kesebuah user*, menggunakan

    `$user = Sentinel::findById(1)

     $role = Sentinel::findRoleByName('Subscribers')

     $role->users()->attach($user)
     `

15. untuk *menghapus role user*, menggunakan

    `$user = Sentinel::findById(1)

     $role = Sentinel::findRoleByName('Subscribers')

     $role->users()->detach($user)
     `

16. untuk *Melihat Permission dari suatu user atau role*, Menggunakan

    `$user = Sentinel::findById(1)

      if ($user->hasAccess(['user.create', 'user.update']))

      {

          // Execute this code if the user has permission

      }

      else

      {

          // Execute this code if the permission check failed

      }
      `
