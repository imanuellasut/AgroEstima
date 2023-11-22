<h1 align="center">Hi 👋, I'm Imanuel Lasut</h1>
<h3 align="center">AgroEstima</h3>
<p align="center">AgroEstima adalah aplikasi pintar yang dirancang khusus untuk membantu para petani jagung dalam memperkirakan hasil panen dengan akurat dan efisien. Dengan fitur-fitur canggih yang terintegrasi dalam aplikasi ini, petani dapat dengan mudah memasukkan data tentang lahan, jenis tanaman, cuaca, dan metode budidaya untuk mendapatkan estimasi hasil panen yang lebih akurat. Dengan AgroEstima, petani dapat mengoptimalkan produksi dan meningkatkan efisiensi usaha pertanian mereka. Gunakan AgroEstima sekarang untuk mendapatkan hasil panen jagung yang terbaik! </p>

## View Sistem

![Alt text](/public/img/Ui-Login.png)
Sistem ini digunakan untuk melakukan perkiraan hasil panen tanaman jagung

## Prerequisites

-   XAMMP v3.3.0
-   PHP 8.2.0
-   Node.js
-   composer

## Database

![Alt text](/public/img/DATABASE%20FIX-FUZZY%20TSUKAMOTO.png)

## Run Locally

Clone the repository and go to AgroEstima directory

```shell
git clone https://github.com/charleslasut/AgroEstima.git

cd AgroEstima
```

Generate .env file

```shell
cp .env.example .env
```

Then, configure the .env file according to your use case.

Install the dependencies and then compile the assets

```shell
composer install

npm install
npm run dev
```

Populate the tables to the database

```shell
php artisan migrate
```

Optional: Seed data to the dabase

```shell
php aritsan db:seed
```

Generate app key

```shell
php artisan key:generate
```

Run the application

```shell
php artisan serve
```

Finally, visit http://localhost:8000 to view the site.

# Connect with me<img src="https://github.com/SatYu26/SatYu26/blob/master/Assets/Handshake.gif" height="32px">

  <a href="https://www.linkedin.com/in/reggy-charles-591403192/">
    <img align="left" alt="Satyam Goyal | Linkedin" width="24px" src="https://github.com/SatYu26/SatYu26/blob/master/Assets/Linkedin.svg" />
  </a> &nbsp;&nbsp;
  <a href="https://twitter.com/charles_lasut">
    <img align="left" alt="Satyam Goyal | Twitter" width="26px" src="https://github.com/SatYu26/SatYu26/blob/master/Assets/Twitter.svg" />
  </a> &nbsp;&nbsp;
  <a href="https://www.instagram.com/imanuellasut_/">
    <img align="left" alt="Satyam Goyal | Instagram" width="24px" src="https://github.com/SatYu26/SatYu26/blob/master/Assets/Instagram.svg" />
  </a> &nbsp;&nbsp;
  <a href="mailto:reggy.charles@si.ukdw.ac.id">
    <img align="left" alt="Satyam Goyal | Gmail" width="26px" src="https://github.com/SatYu26/SatYu26/blob/master/Assets/Gmail.svg" />
  </a>
