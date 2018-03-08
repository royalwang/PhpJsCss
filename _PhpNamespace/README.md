# Php namespace and class

# Php protected, private, public
```
#### public 
Oznacza że atrybut lub metoda jest widoczna zarówno ze środka klasy, klas dziedziczonych jak i z zewnątrz klasy.

#### private 
Oznacza że atrybut lub metoda nie jest widoczna na zewnątrz klasy i nie może być dziedziczona.

#### protected 
Oznacza że atrybut lub metoda nie jest widoczna na zewnątrz klasy i może być dziedziczona. 

#### static
Oznacza że atrybut lub metoda może być użyta bez tworzenia instancji(objektu) klasy 
Foo::StaticMethod();
Foo::$StaticVal;
self::$StaticVal;
parent::$StaticVal;

```

### index.php output

```php
Current namespace App\Lib1
App\Lib1\MyClass1::WhoAmI

Current namespace App\Lib2
Second class App\Lib2\MyClass2::WhoAmI

Current namespace App\Zupa\Zimna
Lib1 from Zupa namespace App\Lib1\MyClass1::WhoAmI


Lib2 from Zupa namespace in class3 Method
Second class App\Lib2\MyClass2::WhoAmI
Third class App\Zupa\Zimna\MyClass3::WhoAmI

Current namespace (root app file empty)
```
