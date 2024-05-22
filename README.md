# Mitake(三竹簡訊) notifications channel for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/natsumework/laravel-notification-mitake.svg?style=flat-square)](https://packagist.org/packages/natsumework/laravel-notification-mitake)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/natsumework/laravel-notification-mitake.svg?style=flat-square)](https://packagist.org/packages/natsumework/laravel-notification-mitake)

This package(non-official) makes it easy to send notifications using [Mitake](https://sms.mitake.com.tw/common/index.jsp) with Laravel 5.5+ and 6.x and 7.x

Here's the latest documentation on Laravel's Notifications System: 

https://laravel.com/docs/master/notifications


## Contents

- [Installation](#installation)
	- [Setting up the Mitake service](#setting-up-the-Mitake-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

```
composer require natsumework/laravel-notification-mitake
```
### Setting up the Mitake service

Add your Mitake Account, Password, and Api endpoint url (optional) to your ```config/services.php```:

```
// config/services.php
...
'mitake' => [
    'username' => env('MITAKE_USERNAME'), // reqired
    'password' => env('MITAKE_PASSWORD'), // reqired
    'url' => env('MITAKE_URL'), // optional (has default value): e.g. 'https://{三竹網域名稱}/api/mtk/SmSend
],
...
```

## Usage

Now you can use the channel in your via() method inside the notification:

```
use NotificationChannels\Mitake\MitakeChannel;
use NotificationChannels\Mitake\MitakeMessage;
use Illuminate\Notifications\Notification;

class SmsNotification extends Notification
{
    public function via($notifiable)
    {
        return [MitakeChannel::class];
    }

    public function toMitake($notifiable)
    {
        return (new MitakeMessage())
            ->content("Your message...");
    }
}

```

You can also set 'dstaddr' or 'vldtime' or 'clientid' option (about the options please refer to the mitake api docs):

```
class SmsNotification extends Notification
{
    ...
    public function toMitake($notifiable)
    {
           return (new MitakeMessage())
                ->content("Your message...")
                ->to("0900000000") // dstaddr: phone number
                ->vldTime("900")  // Validity period: 900 second
                ->clientId("ce910656-7bd1-11ea-bc55-0242ac130003"); //Check duplicate sending
    }
    ...

```


#### Phone number

In order to let your Notification know which phone are you sending to, you need to set the phone number in ```MitakeMessage```

```
class SmsNotification extends Notification
{
    ...
    public function toMitake($notifiable)
    {
           return (new MitakeMessage())
                ->to("0900000000") // dstaddr: phone number 
                ...
    }
    ...

```

You can also add the routeNotificationForMitake method to your Notifiable model.

```
public function routeNotificationForMitake()
{
    return '0900000000';
}
```

or you can use the [on-demand-notifications](https://laravel.com/docs/master/notifications#on-demand-notifications)
 
 ```
Notification::route('mitake', '0900000000')
            ->notify(new SmsNotification($message));
```
 

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email natsumework0902@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [natsumework](https://github.com/natsumework)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
