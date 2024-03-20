## SMItA
NJS Scm application

##### Contributors Team
M. Ridwan Zalbina

##### Database setting
```
Import "db_scm.njs.sql" using phpmyadmin/ largon /vagrant 
```

##### Deployment Manuals
> Use Apache v2 for Web Server

> PHP 7.4.x < 8.x

> Setting mod rewrite to allow .htaccess

> configure database connection in /application/config/database.php


## Code Convention
- Use MVC best approach
- Perform Raw query over query builder (for best performance)
- Controller Usage
  application/controllers/Reqs -> use for perform for internal and external request and vice versa
  application/controllers/Async -> use for perform internal data fetch and submit   

#### Compiling assets

> SaSS
```
npm install
```

```
npm run sass-dev
```

#### Local development with PHP 8.x 
> Disable error reporting deprecation
https://studentprojectguide.com/php/php-troubleshoot/disable-warning-and-notices-in-xampp/#:~:text=Steps%20to%20disable%20warning%20and%20notices%20in%20XAMPP%3A,code%20in%20the%20php.ini%20file.%20...%20More%20items



### Fix issue validation fetch api tidak berjalan di linux karena 0-8 di mesin linux masih terbaca 0


### Activity category
1 = administration
2 = catalog
3 = scm


### Route and Activity route table
Make sure you sync routes field on activity table with routes.php file.
for example in routes.php and route field on activity table:

transactions/distribution/somdl = transactions/distribution/somdl