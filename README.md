# Advanced Computer Lab Project
Implementing a simple online store with PHP + MySQL for the [advanced computer lab](http://met.guc.edu.eg/Courses/CourseEdition.aspx?crsEdId=608) course

## Running it on your development server
- Please create a php file under `config` directory called `db_credentials.php` with the following constants defined :

```
define('DB_HOSTNAME','localhost');
define('DB_NAME','YOUR_DB_NAME');
define('DB_USER','YOUR_DB_USER');
define('DB_PASS','YOUR_DB_PASS');
```

- Install bower dependencies by running `bower install`
- If you need to change the port number please change the following defenition in `config/config.php`

```
if (!defined('HOSTNAME')) {
    define('HOSTNAME', 'http://localhost:1234/');
}
```
