# Php namespace and class

# Php protected, private, public

```
#### public 
Oznacza że atrybut lub metoda jest widoczna zarówno ze środka klasy, 
klas dziedziczonych jak i z zewnątrz klasy.

#### private 
Oznacza że atrybut lub metoda nie jest widoczna na zewnątrz klasy 
i nie może być dziedziczona (klasa potomna nie ma dostępu do prywatnych pól 
i metod klasy bazowej tylko przez metody publiczne można się odwołać do pola private rodzica).

#### protected 
Oznacza że atrybut lub metoda nie jest widoczna na zewnątrz klasy i może być dziedziczona. 

#### static
Oznacza że atrybut lub metoda może być użyta bez tworzenia instancji(objektu) klasy 
Foo::StaticMethod();
Foo::$StaticVal;

### parent::  self:: 
Używamy w klasie pochodnej
self::$StaticVal;
parent::$StaticVal;

#### abstract
Nie można utworzyć objectu klasy abstrakcyjnej tylko do dziedziczenia, tworzenia nowych klas. 
Metody abstrakcyjne w klasie muszą zostać nadpisane (unieważnione) w tworzonej klasie pochodnej 
(jest to metoda, która jest przeznaczona do tego, aby ją unieważnić, dlatego też nie może zawierać żadnej treści). 
Słowo abstract wymusza na programiście konieczność dziedziczenia po klasie oraz unieważnienia metody abstrakcyjnej.

#### final
Metoda klasy została zadeklarowana jako finalna i nie może zostać nadpisana (unieważniona) przy dziedziczeniu.

### parent::
Umożliwia podczas deklaracji klasy pochodnej ustawić konstruktor do klasy rodzica:
parent::__construct($name);

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

### Tuts
https://pl.wikibooks.org/wiki/PHP/Dziedziczenie
