/**
 * Connect to MySQL and instantiate the PDO object.
 * Set the error mode to throw exceptions and disable emulated prepared statements.
 * InnoDb block database on row lewel if you need use more connections in same time (asynchronus)
 */
 
$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
));
 
 
//We are going to assume that the user with ID #1 has paid 10.50.
$userId = 1;
$paymentAmount = 10.50;
 
 
//We start our transaction.
$pdo->beginTransaction();
 
//We will need to wrap our queries inside a TRY / CATCH block.
//That way, we can rollback the transaction if a query fails and a PDO exception occurs.
try{
 
    //Query 1: Attempt to insert the payment record into our database.
    $sql = "INSERT INTO payments (user_id, amount) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
            $userId, 
            $paymentAmount,
        )
    );
    
    //Query 2: Attempt to update the user's profile.
    $sql = "UPDATE users SET credit = credit + ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
            $paymentAmount, 
            $userId
        )
    );
    
    //We've got this far without an exception, so commit the changes.
    $pdo->commit();
    
} 
//Our catch block will handle any exceptions that are thrown.
catch(Exception $e){
    //An exception has occured, which means that one of our database queries
    //failed.
    //Print out the error message.
    echo $e->getMessage();
    //Rollback the transaction.
    $pdo->rollBack();
}

// from 
// http://thisinterestsme.com/php-pdo-transaction-example/
