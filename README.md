## Contact manege

## How to run the project

Before start make sure that your local machine has PHP, Git and Composer installed

Get the project files from the Git repository using the following command

```nothing
git clone https://github.com/engwebdev/contacts.git
```

In the command line, Change the path to the `savvytechtask` folder and add the requirements to the project with this command
```nothing
composer install 
```

commands and run the project root folder
```nothing
php artisan migrate
```

```nothing
php artisan db:seed
```

```nothing
php artisan serve
```

Download the file from
```nothing
https://github.com/engwebdev/contacts/blob/main/apolo.postman_collection.json
```
and run it in the postman


# سیستم مدیریت مخاطبین

این پروژه یک سیستم ساده برای مدیریت مخاطبین است که با استفاده از **لاراول** و بر اساس اصول **طراحی مبتنی بر دامنه (DDD)** پیاده‌سازی شده است. هدف این پروژه، نمایش نحوه سازمان‌دهی یک برنامه لاراول با تمرکز بر منطق دامنه و جداسازی لایه‌های مختلف مانند منطق کسب‌وکار، دسترسی به داده‌ها و ارائه است.

## طراحی مبتنی بر دامنه (DDD) چیست؟
**طراحی مبتنی بر دامنه (DDD)** رویکردی در طراحی نرم‌افزار است که بر مدل‌سازی دقیق دامنه کسب‌وکار تمرکز دارد و کد را به شکلی سازمان‌دهی می‌کند که منعکس‌کننده نیازهای واقعی کسب‌وکار باشد. در این پروژه، دامنه اصلی **مدیریت مخاطبین** است که شامل عملیاتی مانند ایجاد، نمایش و ذخیره مخاطبین می‌شود.

### مفاهیم کلیدی DDD در این پروژه
1. **دامنه (Domain):** منطق اصلی کسب‌وکار، یعنی مدیریت مخاطبین.
2. **موجودیت‌ها (Entities):** اشیایی با هویت منحصربه‌فرد، مانند موجودیت `Contact`.
3. **اشیای ارزشی (Value Objects):** اشیایی بدون هویت برای توصیف ویژگی‌ها، مانند `Email`.
4. **مخزن‌ها (Repositories):** مدیریت دسترسی و ذخیره‌سازی داده‌ها.
5. **سرویس‌های دامنه (Domain Services):** شامل منطق کسب‌وکاری که به یک موجودیت خاص وابسته نیست.
6. **محدوده محدود شده (Bounded Context):** پروژه به دامنه مدیریت مخاطبین محدود شده تا پیچیدگی کاهش یابد.

## ساختار پروژه
ساختار پروژه بر اساس اصول DDD سازمان‌دهی شده و منطق دامنه از لایه‌های زیرساخت جدا شده است:

app/
├── Domain/
│   ├── Contact/
│   │   ├── Models/
│   │   │   ├── Contact.php (موجودیت)
│   │   │   ├── Email.php (شیء ارزشی)
│   │   ├── Repositories/
│   │   │   ├── ContactRepository.php
│   │   ├── Services/
│   │   │   ├── ContactService.php
├── Http/
│   ├── Controllers/
│   │   ├── ContactController.php
├── Models/
│   ├── Contact.php (مدل Eloquent)
├── Providers/
│   ├── AppServiceProvider.php



### توضیح فایل‌ها
- **Domain/Contact/Models/Contact.php**: موجودیت `Contact` که یک مخاطب را با ویژگی‌های نام و ایمیل نشان می‌دهد.
- **Domain/Contact/Models/Email.php**: شیء ارزشی برای اعتبارسنجی و نگهداری ایمیل.
- **Domain/Contact/Repositories/ContactRepository.php**: مخزن برای مدیریت دسترسی به داده‌ها و ارتباط با پایگاه داده.
- **Domain/Contact/Services/ContactService.php**: سرویس دامنه که منطق کسب‌وکار مانند ایجاد و دریافت مخاطبین را مدیریت می‌کند.
- **Http/Controllers/ContactController.php**: کنترلر برای مدیریت درخواست‌های HTTP و انتقال آن‌ها به سرویس دامنه.
- **Models/Contact.php**: مدل Eloquent برای ارتباط با جدول `contacts` در پایگاه داده.
- **Providers/AppServiceProvider.php**: ثبت وابستگی‌های مخزن و سرویس در کانتینر لاراول.

## جزئیات پیاده‌سازی
این پروژه اصول DDD را به این صورت پیاده‌سازی کرده است:
- **دامنه**: مدیریت مخاطبین (ایجاد و نمایش مخاطبین).
- **موجودیت (Contact)**: در فایل `app/Domain/Contact/Models/Contact.php` تعریف شده و یک مخاطب را با نام و ایمیل نشان می‌دهد.
- **شیء ارزشی (Email)**: در فایل `app/Domain/Contact/Models/Email.php` برای اعتبارسنجی ایمیل.
- **مخزن (ContactRepository)**: در فایل `app/Domain/Contact/Repositories/ContactRepository.php` برای جداسازی دسترسی به داده‌ها.
- **سرویس (ContactService)**: در فایل `app/Domain/Contact/Services/ContactService.php` برای مدیریت منطق کسب‌وکار.
- **کنترلر (ContactController)**: در فایل `app/Http/Controllers/ContactController.php` برای پردازش درخواست‌های HTTP.

## راه‌اندازی و استفاده
1. **مهاجرت پایگاه داده**:
   - فایل مهاجرت برای جدول `contacts` در پوشه مهاجرت‌ها قرار دارد و شامل ستون‌های `id`، `name`، `email` و `timestamps` است.
   - دستور `php artisan migrate` را اجرا کنید.

2. **مسیرهای API**:
   - در فایل `routes/api.php` تعریف شده‌اند:
     - `POST /contacts`: برای ایجاد مخاطب جدید.
     - `GET /contacts`: برای دریافت لیست تمام مخاطبین.

3. **نمونه درخواست‌ها**:
   - برای ایجاد مخاطب: درخواست POST به `/api/contacts` با داده JSON مانند `{"name": "علی", "email": "ali@example.com"}`.
   - برای نمایش مخاطبین: درخواست GET به `/api/contacts`.

## چرا از DDD استفاده شده؟
- **جداسازی لایه‌ها**: منطق دامنه از زیرساخت (پایگاه داده، فریم‌ورک) جدا شده است.
- **انعطاف‌پذیری**: تغییر پایگاه داده یا فریم‌ورک بدون تغییر منطق دامنه ممکن است.
- **قابلیت تست**: کلاس‌های دامنه و سرویس‌ها به دلیل جداسازی از Eloquent به راحتی قابل تست هستند.
- **خوانایی**: ساختار کد با دامنه کسب‌وکار هم‌راستا است و نگهداری آن آسان‌تر است.

## اجرای پروژه
1. کلون کردن مخزن: `git clone https://github.com/engwebdev/contacts.git`
2. نصب وابستگی‌ها: `composer install`
3. تنظیم محیط: فایل `.env.example` را به `.env` کپی کرده و پایگاه داده را تنظیم کنید.
4. اجرای مهاجرت‌ها: `php artisan migrate`
5. راه‌اندازی سرور: `php artisan serve`
6. تست API با ابزارهایی مانند Postman یا cURL.

## مشارکت
برای مشارکت، می‌توانید مخزن را فورک کنید، تغییرات خود را اعمال کنید و درخواست Pull Request ارسال کنید. برای سوالات یا پیشنهادات، یک Issue در مخزن گیت‌هاب باز کنید.

## مجوز
این پروژه منبع‌باز بوده و تحت [مجوز MIT](LICENSE) منتشر شده است.
