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
