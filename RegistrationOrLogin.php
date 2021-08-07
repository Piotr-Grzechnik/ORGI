<?php
    session_start();
    /*
        Tutaj mamy kod odpowiadający za logowanie.
        Zależnie od tego który użytkownik wypełni formularz albo loguje rób rejestrujemy.
        1. Sprawdzamy czy logowanie/rejestracja
        2. Sprawdzamy w bazie czy mamy użytkownika o takim emailu
            3A. Gdy mamy to w przypadku logowania gdy zgadza się i hasło to logujemy
            3B. Gdy nie mamy to w przypadku rejestracji dodajemy użytkownika i prosimy o zalogowanie w oparciu o te nowe dane 
    */

    if(!isset($_SESSION[$isLogged]) && isset($_POST[$userCredits]))
    {
        /*
            
            Jak użytkownik będzie chciał się zalogować
            
        */
        if ($_POST[$userAction] == 'logIn') 
        {
            try
            {
                require_once 'accounts.php' ;
                require_once 'database.php' ;
                require_once 'GlobalVariables.php';

                // Tworzymy nową bazę oraz od razu ją łączymy
                $db_Base = new Database();
                //$db_Base = new Database(true);

                // Pobieramy email od użytkownika
                $UserEmail = $_POST[$email_LogInForm];

                // Zwykłe zapytanie czy mamy użytkowanika o taki emailu
                $result = $db_Base->query("SELECT * FROM `{$usersTable}` WHERE `{$email_UsersTable_Col}` = '$UserEmail' ");

                // Gdy nie mamy takeigo użytkownika
                if(!$result) 
                {
                    // Brak wyników
                    throw new Exception('Brak użytkownika o takim loginie lub błędne hasło'); 
                }
                else
                {
                    // Sprawdzamy każdy wynik ( powinien być 1 )
                    while ($row = $result->fetch_assoc())
                    {
                        // Pobieramy hasło od użytkownika
                        $checkPass = $_POST[$pass_LogInForm]; 
                        //$temp = password_hash($checkPass,PASSWORD_BCRYPT);
                        //echo $temp;
                        // Sprawdzamy z MD5
                        // Gdy poprawne, logujemy
                        if(password_verify($checkPass,$row[$pass_UsersTable_Col]))
                        {
                            $_SESSION[$isLogged] = true; 
                            $user = new Account(
                                $row[$login_UsersTable_Col],
                                $row[$email_UsersTable_Col],
                                $row[$id_UsersTable_Col],
                            );
                            //serialize($user);
                            $_SESSION[$userCredits] = $user;

                            header('Location: Home.php');
                        }
                        else
                        {
                            throw new Exception('Błędne hasło'); 
                        }
                    }
                }
                  
            }
            catch(Exception $e)
            {
                // Miejsce na informacje zwrotną gdy coś pójdzie nie tak
                // wiadomość w $e
                $_SESSION[$error_LogInForm] = $e;
                echo $e;
                //header('Location: loginform.php');
            }
        }
        /*

            Jak użytkownik będzie chciał się zarejestrować

        */
        else if ( $_POST[$userAction] == 'register' )
        {
            
            try
            {
                require_once 'database.php' ;
                require_once 'GlobalVariables.php';

                // Tworzymy nową bazę oraz od razu ją łączymy
                $db_Base = new Database();

                //Pobieramy email od użytkownika
                $UserEmail = $_POST[$email_RegisForm];

                // Zwykłe zapytanie czy mamy użytkowanika o taki emailu
                $result = $db_Base->query("SELECT * FROM `{$usersTable}` WHERE `{$email_UsersTable_Col}` = '$UserEmail' "); 

                //Gdy nie mamy takeigo użytkownika
                if(!$result) 
                {
                    //Dane użytkownika
                    $UserNick = $_POST[$nick_RegisForm];
                    $UserPass = $_POST[$pass_RegisForm];

                    //Haszowanie hasła
                    $pass_hash=password_hash($UserPass,PASSWORD_BCRYPT);

                    // Wbijanie danych do tabeli                    
                    $query = 
                    "INSERT INTO 
                    `{$usersTable}`
                    (`{$login_UsersTable_Col}`,`{$pass_UsersTable_Col}`,`{$email_UsersTable_Col}`)           
                    VALUES 
                    ('{$UserNick}','{$pass_hash}','{$UserEmail}')";

                    if( $db_Base->query($query) )                        
                    {
                        // Udało się dodać użytkownika do bazy
                        $_SESSION[$error_RegisForm] = "Udana rejestracja teraz proszę się zaloguj";
                        echo "Udana rejestracja teraz proszę się zaloguj";
                        //header('Location: loginform.php');
                    }
                    else
                    {
                        // Nie udało się ....
                        throw new Exception('Proszę spróbować jeszcze raz za jakiś czas');
                    }
                    
                }
                else
                {
                    // Mamy już użytkownika o takim emailu
                    throw new Exception('Istnieje już użytkownik o takim emailu'); 
                }
                  
            }
            catch(Exception $e)
            {
                // Miejsce na informacje zwrotną gdy coś pójdzie nie tak
                // wiadomość w $e
                echo $e;
                $_SESSION[$error_RegisForm] = $e;
                //header('Location: registerform.php');
            }
        }
        /*
            Jest to ostatnia opcja gdy ktoś tu trafi przez przypadek
            lub wpisze adres z 'palca'
        */
        else
        {
            $_SESSION[$error_LogInForm] = "Nie powinieneś tutaj trafić :) ";
            header('Location: loginform.php'); 
        }
    }
?>
