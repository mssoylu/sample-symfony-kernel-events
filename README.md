# Symfony Kernel Events Ornekleri

Kernel event onceliklerini uygulama bazinda anlamak icin basit bir ornek.

https://symfony.com/doc/current/reference/events.html

- kernel.request
- kernel.controller
- kernel.controller_arguments
- kernel.view
- kernel.response
- kernel.finish_request
- kernel.terminate
- kernel.exception

## Nasil denerim

Bunu denemek icin;

`cd public`
`php -S localhost:8000`
uygulamayi php server ile calistirin.

## Kernel Exception
`kernel.exception` olusturuldugunda tum exceptionlari yakaliyor.

`http://localhost:8000/olmayanroute` adresine 
giderseniz `dev` moddaki klasik symfony `web_profiler` olan hata sayfasi yerine `ExceptionListener`'in hatayi yakalayip degistirerek
gosterdigi ekrani goreceksiniz.

