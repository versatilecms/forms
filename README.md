# Versatile Forms

Disclaimer (pt_BR)
==========
Este repositório é uma versão modificada do pacote [pvtl/voyager-forms](https://github.com/pvtl/voyager-forms). Algumas mudanças foram implementadas para uma melhor integração com as demais libs do projeto [Versatile](https://github.com/versatilecms).

<hr>

__The Missing Form Module for The Missing Laravel Admin.__

This Laravel package adds dynamic form creation and shortcode insertion to a Versatile project.

- Create & manage forms and their fields (add fields, drag/drop into order etc)
- Output forms on the frontend with an simple shortcode (`{!! forms(<FORM_ID>) !!}`)
- Each form's output on the frontend are overridable with custom layouts
- All submissions are emailed inside overridable HTML email templates
- All submissions are backed up to the database and accessible under Versatile Admins > Forms > Enquiries

---

## Prerequisites

- Node & NPM Installed
- Composer Installed
- Install Laravel
- Install Versatile
- Install Versatile Front

---

## Installation

```bash
# 1. Require this Package in your fresh Versatile project
composer require versatilecms/forms

# 2. Run the Installer
composer dump-autoload && php artisan versatile-forms:install

# 3. Configure to/from addresses
        -> Navigate to Admin -> Settings -> 'Forms' tab
        -> Adjust values
        
# 4. Configure "MAIL" environment variables

# 5. (optional) Add Google invisible reCAPTCHA
        -> Navigate to Admin -> Settings -> 'Admin' tab
        -> Insert Google reCATPCHA keys 

``` 

---

## Displaying Forms

You can easily display your created forms on the front-end in any kind of output - we use shortcodes to render our forms so go ahead and add `{!! forms(1) !!}` to a page/post to see the default Contact form appear.

---

## Form Hooks

You may also wish to include custom logic and functionality when your form has been submitted (but before the submission has saved to the DB - eg. so that you can execute custom validation). This can be done with a __Form Hook__ Block - simply specify your controllers namespace'd path and the method you wish to call and the Versatile Forms module will automatically execute it upon submission. For example:

```php
Versatile\AwesomeModule\Somewhere\ClassName::anExampleHey('hello world')
```

_Note that in the above example, the first param of the actual method will be the submission data and the second param will be 'hello world'_

---

## Custom Form Output

This module outputs forms on the frontend in a basic structure. However you have the ability to build your own form layouts very easily.

#### A completely custom layout:

- Create a new blade template in `views/vendor/forms/layouts`
- Edit the form in Versatile Admin and select the new layout you created

To get a completely custom output, you'll likely need to define the `<form>` html including each form field individually.

#### Override fields

You also have the ability to override `views/vendor/forms/forms/render.blade.php` to change the way form fields are styled.

---

## Custom Email Templates

This module sends a generic looking email with each submission. However you have the ability to build your own email templates very easily.

- Create a new blade template in `views/vendor/forms/email-templates` (you can also simply override `default.blade.php` in the same location)
- Edit the form in Versatile Admin and select the appropriate email template
