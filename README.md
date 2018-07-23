## Dashboard Site

### Notes on Dependencies

* Slim is microframework
* Aura/Sql is an extension of the builtin PDO
* Using Zend Service Manager as the Service Container
* Monolog provides logging
* Twig is used for templating instead of PHP as it forces the view code to be concise compared to php and provides safety
* Zend Hydrator for loading data into the models

### Creating database

```mysql
CREATE DATABASE dashboard;
CREATE TABLE item
(
	id int auto_increment
		primary key,
	user_id int not null,
	name varchar(256) null,
	body text null,
	created datetime null,
	modified datetime null
);
```
