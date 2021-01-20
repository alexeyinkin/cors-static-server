# cors-static-server

This script adds `Access-Control-Allow-Origin` header to files served by Apache built without `mod_headers.c`.

With this `mod_headers.c` you do not need this script and can just use this `.htaccess`:

```
<IfModule mod_headers.c>
    SetEnvIf Origin "http(s)?://(www\.)?(localhost|host\.com)(:\d+)?$" AccessControlAllowOrigin=$0
    Header add Access-Control-Allow-Origin %{AccessControlAllowOrigin}e env=AccessControlAllowOrigin
    Header merge Vary Origin
</IfModule>
```

## How it works
1. `.htaccess` redirects every request to `serve.php?filename=...`
1. `serve.php` reads the file if it exists and add `Access-Control-Allow-Origin` header.


## Set up

1. In `.htaccess`, set your contex path before `serve\.php` use `/serve\.php` for root context path.
1. In `serve.php`, set your whitelisted domain names.
1. Remove `'/'` and `'\\'` from forbidden substrings to allow serving files in subfolders.
1. Upload these files to a folder with static files you wish to give access to.


## TODO

1. Allow to serve ranges.
1. Add headers to control cache.
