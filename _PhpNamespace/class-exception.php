<?php
use \PDO;
use \Exception;

class MyException extends Exception { }

class Test {
    public function testing() {
        try {
            try {
                throw new MyException('foo!');
            } catch (MyException $e) {
                // catch here
                // print_r($e);
                // or rethrow it
                throw $e;                
            }
        } catch (Exception $e) {
            // catch here
            // var_dump($e->getMessage());
            // or
            throw $e;
        }
    }
}

try{
    
    $foo = new Test;
    $foo->testing();

} catch (Exception $e) {
    echo "Boooo ";
    var_dump($e->getMessage());
}
?>
