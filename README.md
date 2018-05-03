# Work with module type of product

**1.**
```php
//write to composer.json
"require": {
    ...
    "softce/type-of-product" : "dev-master"
}

"autoload": {
    ... ,

    "psr-4": {
        ... ,

        "Softce\\Type\\" : "vendor/softce/type-of-product/src"
    }
}
```


**2.**
```php
//in console write

composer update softce/type-of-product
```


**3.**
```php
//in service provider config/app

'providers' => [
    ... ,
    Softce\Type\Providers\TypeServiceProvider::class,
]


// in console 
php artisan config:cache
```

**4.**
```php
//To work with slides, start the migration

php artisan migrate

```


**5.**
```php

//for show page slider, in code add next row

{{ route('admin.type.index') }}

```

# How to use in ProductController

**1.**
```php

//for use functional
//use dependency injection in the method of building a list of products like

 public function index(... , TypeButton $typeofproduct){
 ...
    $typeofproduct->getButton($model->id)
    
    return view(....)
        ->with('dataGrid', ...)
        ->with('typeofproduct_script', $typeofproduct->getScript());
 }
 
```

**2.**
```php
//in view after

{!! $dataGrid->render() !!}

//write
{{ $typeofproduct_script }}
 


```

# For delete module

```php
//delete next row

1.
//in app.php
Softce\Type\Providers\TypeServiceProvider::class,

2.
//in composer.json
"Softce\\Type\\": "vendor/softce/type-of-product/src"

3.
//in console
composer remove softce/type-of-product

4.
// delete -> bootstrap/config/cache.php

5.
//in console
php artisan config:cache

6.
//delete table -> types and product_types

7.
//delete migration -> 2018_05_02_144153_create_types_table 
//and 2018_05_02_150806_create_product_types_table

8.
//delete row in admin_menus table -> where name 'Типы товаров'
```

