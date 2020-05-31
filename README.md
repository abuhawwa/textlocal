# textlocal.in

Using Textlocal offical <a href="https://api.textlocal.in/wrappers/php-in.zip"> PHP Class</a>, this package makes it easy sending SMS notifications in Laravel

# Requirements

<ul>
<li>Sign up for a free <a href="https://www.textlocal.in/signup">Textlocal</a> account</li>
<li>Create a new API Key in the settings section</li>
</ul>

# Installation

You can install the package via composer

<pre>composer require abuhawwa/textlocal</pre>

# step: 1

Add ServiceProvider to the providers array in your config/app.php

<pre>Abuhawwa\Textlocal\TextlocalServiceProvider::class,</pre>

# step: 2

To copy the distribution configuration file to your app's config directory <strong>config/textlocal.php</strong>

<pre>php artisan vendor:publish --tag=textlocal</pre>

# step: 3

Then update config/textlocal.php with your credentials. Alternatively, you can update your .env file with the following

<pre>
TEXTLOCAL_KEY=""
TEXTLOCAL_SENDER=""
</pre>

# step: 4

Now you can use the channel in your via() method inside the notification:

<pre>
use Abuhawwa\Textlocal\TextlocalChannel;
use Illuminate\Notifications\Notification;

class PostApproved extends Notification
{
    public function via($notifiable)
    {
        return [TextlocalChannel::class];
    }

    public function toTextlocal($notifiable)
    {
        return "Your {$notifiable->service} account was approved!"
    }
}
</pre>

# step: 5

In order to let your Notification know which phone are you sending to, the channel will look for the phone_number attribute of the Notifiable model. If you want to override this behaviour, add the routeNotificationForTextlocal method to your Notifiable model.

<pre>
public function routeNotificationForTextlocal()
{
    return $this->mobile; // where 'mobile' is a field in users table;
}
</pre>

# License

The <a href="https://github.com/abuhawwa/textlocal/blob/master/LICENSE">MIT</a> License.
