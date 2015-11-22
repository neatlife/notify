![Notify](https://s3.amazonaws.com/s3.codecourse.com/github/banners/notify.png)

## Install

Using Composer

```
composer require suxiaolin/notify
```

Add the components to `config/main.php`

```php
'notifier' => [
	'class' => 'suxiaolin\notify\Notifier',
]
```

> Note, there is a Notifier::instance() function available, so you can vai Notifier::instance() instead of config it in `config/main.php`.

## Usage

### Basic

From your application, call the `flash` method with a message and type.

```php
Notifier::instance()->flash('Welcome back!', 'success');
```

Within a view, you can now check if a flash message exists and output it.

```php
<?php if (Notifier::instance()->ready()): ?>
    <div class="alert-box <?= Notifier::instance()->type() ?>">
        <?= Notifier::instance()->message() ?>
    </div>
<?php endif; ?>
```
> Notify is front-end framework agnostic, so you're free to easily implement the output however you choose.

### Options

You can pass additional options to the `flash` method, which are then easily accessible within your view.

```php
Notifier::instance()->flash('Welcome back!', 'success', [
    'timer' => 3000,
    'text' => 'It\'s really great to see you again',
]);
```

Then, in your view.

```javascript
<?php if (Notifier::instance()->ready()): ?>
    <script>
        swal({
            title: "<?= Notifier::instance()->message() ?>",
            text: "<?= Notifier::instance()->option('text') ?>",
            type: "<?= Notifier::instance()->type() ?>",
            <?php if (Notifier::instance()->option('timer')): ?>
                timer: <?= Notifier::instance()->option('timer') ?>,
                showConfirmButton: false
            <?php endif; ?>
        });
    </script>
<?php endif; ?>
```

![SweetAlert example](https://s3.amazonaws.com/s3.codecourse.com/github/notify/swal-example.png)

> The above example uses SweetAlert, but the flexibily of Notify means you can easily use it with any JavaScript alert solution.

## Issues and contribution

Just submit an issue or pull request through GitHub. Thanks!