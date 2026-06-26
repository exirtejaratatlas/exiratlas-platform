# راهنمای نصب ETA Portal روی Iran Server (DirectAdmin)

این پورتال یک اپ ساده‌ی PHP/MySQL است و روی هاست اشتراکی شما کار می‌کند.
نیازمندی: PHP 7.4+ و MySQL/MariaDB (روی DirectAdmin استاندارد موجود است).

## گام ۱ — ساخت دیتابیس MySQL
در DirectAdmin → بخش **MySQL Management** → **Create new database**:
- یک نام دیتابیس و یک کاربر بسازید و یک رمز قوی بگذارید.
- این سه مقدار را یادداشت کنید: نام دیتابیس، نام کاربر، رمز.
  (معمولاً نام‌ها پیشوند حساب می‌گیرند، مثل `exiratl_portal` و `exiratl_admin`.)

## گام ۲ — ویرایش config.php
فایل `config.php` را باز کنید و این‌ها را پر کنید:
- `DB_NAME`، `DB_USER`، `DB_PASS` = همان مقادیر گام ۱
- `API_TOKEN` = یک رشته‌ی تصادفی بلند (برای اتصال n8n؛ بعداً استفاده می‌شود)

## گام ۳ — آپلود فایل‌ها
همه‌ی فایل‌های پوشه‌ی `ETA_Portal` را در پوشه‌ی ساب‌دامین آپلود کنید.
در DirectAdmin معمولاً مسیر ساب‌دامین `portal.exiratlas.com` این است:
`domains/exiratlas.com/public_html/portal/`
(از File Manager یا FTP استفاده کنید. فایل‌ها مستقیم داخل همان پوشه باشند، نه داخل یک زیرپوشه‌ی اضافه.)

## گام ۴ — ساخت جدول‌ها (import schema)
در DirectAdmin → **phpMyAdmin** → دیتابیس‌تان را انتخاب کنید → تب **Import** → فایل `schema.sql` را انتخاب و **Go** بزنید.
باید ۸ جدول ساخته شود (users, customers, contacts, suppliers, manufacturers, rfqs, rfq_lines, offers).

## گام ۵ — ساخت حساب مدیر
در مرورگر بروید به: `https://portal.exiratlas.com/setup.php`
نام، ایمیل (`ai@exiratlas.com`) و یک رمز حداقل ۸ کاراکتری بگذارید → حساب مدیر ساخته می‌شود.
(بعد از این، صفحه‌ی setup خودش غیرفعال می‌شود؛ برای امنیت بیشتر می‌توانید فایل `setup.php` را حذف کنید.)

## گام ۶ — ورود
بروید به `https://portal.exiratlas.com/login.php` و وارد شوید. تمام!

## نکات
- اگر صفحه‌ی سفید دیدید: یعنی خطای PHP؛ در DirectAdmin گزینه‌ی نمایش خطا را روشن کنید یا به من بگویید.
- HTTPS: حتماً برای `portal.exiratlas.com` گواهی SSL (Let's Encrypt رایگان در DirectAdmin) را فعال کنید.
- نقش‌ها: کاربر **admin** همه‌چیز را می‌بیند؛ کاربر **partner** (همکار) فقط مشتریان و استعلام‌های خودش را می‌بیند و به ساپلایر/تولیدکننده دسترسی ندارد.
- ماژول‌های بعدی (ساپلایر، تولیدکننده، RFQ کامل، API برای n8n) را بعد از تست موفق این مرحله اضافه می‌کنم.
