<?php
    /*
        Gdy otrzymamy plik z Post:
        1. Sprawdzić co to za rozszerzenie
        2. Zależnie od rozszerzenie switchem zwiększyć ilość ogólną
        3. Dodać konkretnemu użytkownikowi w bazie danych ten przedmiot ( TODO Poprawić tabelę)
            3a Sprawdzić czy ma tabelę, jak nie utworzyć
            3b Dodać wpis do tabeli
    */
    session_start();
    require_once 'accounts.php' ;
    require_once 'database.php' ;
    require_once 'databaseNames.php';
    /*
        Dostaniemy się tu gdy użytkownik jest zalogowany oraz wypełnił formularz
    */
    if( isset( $_SESSION['IsLogged'] ) && isset( $_POST[$typeFileAddFileForm]) )
    {
        try
        {
            // Do łączenia z bazą danych
            $db = new Database();

            // Sprawdzamy czy mamy dane uzytkownika
            if( !isset ( $_SESSION[$userCredits] ) )
                throw new Exception("Brak danych użytkownika");

            // Tworzymy zapytanie
            // Nazwa tabeli to : Id + _Uploads 
            $user = $_SESSION[$userCredits];
            $userID = $user.GetUserId();
            $tableName = $userID.$usersUploadsTable;

            // Sprawdzamy czy istnieje
            $query = "SELECT * FROM `{$usersTable}` LIMIT 1 ";
            if ( ! $db->query($query) );
            {
                // Jeżeli nie istenieje tworzymy ją
                $query = "
                CREATE TABLE `{$tableName}` (
                ID          int          NOT NULL AUTO_INCREMENT,
                NazwaPliku  VARCHAR(30)  NOT NULL,
                Opis        VARCHAR(256) NOT NULL,
                Tagi        VARCHAR(256) NOT NULL,
                PRIMARY KEY (ID)
                );
                ";
                if( ! $db->query($query) )
                    throw new Exception("Nie udalo sie utworzyc tabeli, sproboj pozniej dodac plik");      
            }

            // Jeżeli nie mieliśmy to już mamy tabelę dla naszego użytkownika
            // Czas zapisać plik w odpowiednim folderze
            
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

           
            
        }
        catch(Exception $e)
        {
            $_SESSION[$errorAddFileForm] = $e;
        }
    
    }

?>