<?php

/**
 * Class DatabaseFactory
 *
 * Use it like this:
 * $database = DatabaseFactory::getFactory()->getConnection();
 *
 * That's my personal favourite when creating a database connection.
 * It's a slightly modified version of Jon Raphaelson's excellent answer on StackOverflow:
 * http://stackoverflow.com/questions/130878/global-or-singleton-for-database-connection
 *
 * Full quote from the answer:
 *
 * "Then, in 6 months when your app is super famous and getting dugg and slashdotted and you decide you need more than
 * a single connection, all you have to do is implement some pooling in the getConnection() method. Or if you decide
 * that you want a wrapper that implements SQL logging, you can pass a PDO subclass. Or if you decide you want a new
 * connection on every invocation, you can do do that. It's flexible, instead of rigid."
 *
 * Thanks! Big up, mate!
 */
class DatabaseFactoryMySQLi
{
    private static $factory;
    private $database;

    public static function getFactory()
    {
        if (!self::$factory) {
            self::$factory = new DatabaseFactoryMySQLi();
        }
        return self::$factory;
    }

    public function getConnection()
    {
        if (!$this->database) {
            try {
                $this->database = new mysqli(
                        Config::get('DB_HOST'),
                        Config::get('DB_USER'),
                        Config::get('DB_PASS'),
                        Config::get('DB_NAME'),
                        Config::get('DB_PORT')
                );
                if ($this->database->connect_error) {
                    throw new Exception('Database connection can not be established. Please try again later.');
                }
                $this->database->set_charset(Config::get('DB_CHARSET'));
            } catch (Exception $e) {
                echo $e->getMessage();
                echo 'Error code: ' . $e->getCode();
                exit;
            }
        }
        return $this->database;
    }
}
