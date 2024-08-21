# Demo Video
[![Demo video](https://i3.ytimg.com/vi/4CEpi1s7A8s/maxresdefault.jpg)](https://youtu.be/4CEpi1s7A8s)

# Online Kullanıcılar
Bu proje, PHP ile geliştirilmiş online kullanıcıları gösteren uygulamadır.  `PHP 7` ve üzeri sürümlerde çalışır. 


## Dikkat Edilmesi Gerekenler

- **Alt klasör**: Alt klasöre kurduğunuzda `src/config.php` içindeki `SUB_DIR` sabitini klasör adınızla mutlaka değiştirin

## Kurulum

### Veritabanı Yapılandırması

Öncelikle, veritabanınızı oluşturmanız ve gerekli tablo yapısını ayarlamanız gerekiyor. Bunun için veritabanını oluşturduktan sonra `onlineusers.sql` dosyasını yüklemeniz yeterlidir. Aşağıda, veritabanı bağlantı yapılandırması ve ayarları yer almaktadır.

#### `src/config.php`

```php
<?php
// Veritabanı yapılandırması
$db = new Database('localhost', 'onlineusers', 'username', 'password');


// Konfigürasyon ayarları
DB de kayıtlı kullanıcı bilgileri kullanıcı adı:şifre
 admin:admin
 mod:mod
 user:user
