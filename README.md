<!-- @format -->

# dbwrapper

dbwrapper is a small php wrapper for mysql/ databases.

## installation

install once with composer:

```
composer require ahmed/db-wrapper
```

then add this to your project:

```php
require __DIR__ . '/vendor/autoload.php';
use Ahmed\DbWrapper\dbwrapper;
$db = new dbhelper();
```

## usage

```php
/* connect to database */
$db->connect("localhost", "root", "", "slms", 3306);

/* disconnect from database */

/* insert/update/delete */
$id = $db->insert('tablename', ['col1' => 'foo'])->excute();
$db->update('tablename', ['col1' => 'bar'])->where(['id' => $id])->excute();
$db->delete('tablename')->where(['id'=>$id])->excute();
$db->select('tablename', 'columns')->Get_All_Rows();
$db->select('tablename', 'Row')->Get_Row();



/* select */

```
