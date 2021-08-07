<?php
// TODO przekazać error message
// sesja?

class Database
{
    private $connection;
    private $closedConnection;
    private $errorMessage;

    /*
        Domyślny kontruktor dla naszej bazy
    */
    
    public function __construct() 
    {
        $this -> connection = null;
        $this -> closedConnection = true;
	}
    
    // Prosta funkcja do zrobienia zapytania
    // TODO Czy udało się wykonać zapytanie true/false
    public function query($query)
    {
        // Gdy zamknięte połączenie , trzeba je otworzyć
        if($this -> closedConnection)
        {
            // Otwieramy
            $this -> Open_Connection();
        }

        // Robimy zapytanie i przechowujemy wynik
        if ($this -> connection != null)
            $result = $this->connection->query($query);

        // Zamykamy połączenie po zapytaniu
        $this->Close_Connection();

        return $result;   
    }

    // Prosta funkcja do otwarcia połączenia
    private function Open_Connection()
    {
        // Załączamy nasze dane do połączenia
        require_once 'credits.php';
        //require 'credits.php';
        /*
        $Host="localhost";
        $db_user="root";
        $db_password="";
        $db_name="staz";
        */
        // Próba połączenia
        // Dane z credits.php
		$this->connection = new mysqli($Host, $db_user, $db_password, $db_name);
        
        //Sprawdzamy czy się udało
		if ($this->connection->connect_error) 
        {
            // Jeżeli się nie udało ustawiamy errora
			$this->error('Failed to connect to MySQL - ' . $this->connection->connect_error);
		}

        // Ustawiamy UTF-8 aby mieć polskie znaki.
		$this->connection->set_charset('utf8');

        // Zmieniamy status
        $this -> closedConnection = false;
    }

    // Prosta funkcja do zamknięcia połączenia
    private function Close_Connection()
    {
        // Zamykamy połączenie
        if( $this -> connection != null)
            $this -> connection->close();
        // Zmieniamy status
        $this -> closedConnection = true;
    }


    private function error($error) 
    {
        //$this->errorMessage = $error;
        exit($error);
    }
}