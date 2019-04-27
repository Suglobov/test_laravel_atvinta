# Требования
+ docker-compose
+ make (опционально)
# Установка
+ composer install в контейнере  
```make dc-ci```  
    или  
```docker-compose exec app bash -c "composer install"```  

+ artisan key:generate в контейнере  
```make dc-akg```  
    или  
```docker-compose exec app bash -c "php artisan key:generate"```
+ доступен по: ```http://localhost/```
