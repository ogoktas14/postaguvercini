<p align="center"><a href="https://arsinex.com" target="_blank">
<img src="https://arsinex.s3.eu-central-1.amazonaws.com/assets/images/headlogo-wh.svg" width="400">
</a></p>

<p align="center">
<a href="https://packagist.org/packages/serefercelik/postaguvercini"><img src="https://img.shields.io/packagist/dt/serefercelik/postaguvercini" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/serefercelik/postaguvercini"><img src="https://img.shields.io/packagist/v/serefercelik/postaguvercini" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/serefercelik/postaguvercini"><img src="https://img.shields.io/packagist/l/serefercelik/postaguvercini" alt="License"></a>
</p>

## Kullanım Şekli

- ```composer create-project serefercelik/postaguvercini``` Komutu ile paketi yükleyiniz.
- ```php artisan vendor:publish --provider="SerefErcelik\PostaGuvercini\PostaGuverciniServiceProvider" --tag="config"``` komutu ile config dosyasını oluşturunuz.
- ```/config/postaguvercini.php``` dosyasının içerisindeki ```user``` , ```password``` ve ```country_code``` kısmını doldurunuz.

```php 
    PostaGuvercini::sendMessage('Numaranızı başında 90 olmadan yazınız', 'Bu bir deneme mesajıdır.');
```
şeklinde kullanabilirsiniz.


### Notification Olarak Kullanım Şekli

```php
namespace App\Notifications;

use SerefErcelik\PostaGuvercini\Notifications\PostaGuverciniChannel;
use SerefErcelik\PostaGuvercini\Notifications\PostaGuverciniMessage;
use Illuminate\Notifications\Notification;

class ExampleNotification extends Notification
{
    public function via($notifiable)
    {
        return [PostaGuverciniChannel::class];
    }
    
    public function toSmsApi($notifiable)
    {
        return (new PostaGuverciniMessage)
            ->content("Bu bir deneme Mesajıdır.");
    }
}
```

#### Not: 
Notification özelliği eklenecek Model dosyasına aşağıdaki kodu eklemeyi unutmayınız.
```php
    public function routeNotificationForSmsApi() {
        return $this->phone; //Model içerisindeki telefon numarasının fieldi olacak.
    }    
```