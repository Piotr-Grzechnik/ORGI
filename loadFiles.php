<?php
    /*
        Zadaniem tego skryptu jest po wybraniu przez użytkownika co chce przeglądać
        wczytanie do naszego przeglądu plików ten dany typ plików. Użytkownik 
        powinien wypełnić formularz ( pojedyńcze kafelki z kategoriami ) i być zalogowany
        1. Sprawdzenie czy mamy wszystko co jest potrzebne , czy zalogowany i wiemy co potrzebuje 
        2. Załadować pliki
        3. Na ten moment, wypisać konkretną pulę plików

    */

    session_start();
    require_once 'accounts.php' ;
    require_once 'database.php' ;
    require_once 'GlobalVariables.php';

    try
    {
        if( isset( $_SESSION[$isLogged] ) && isset( $_POST[$category_ChooseCategoryForm] ) )
        {
            $files  = null;
            $dir    = null;
            switch ($_POST[$category_ChooseCategoryForm])
            {
                case 'zdjecia':
                    $dir = $photosUploadFolder;
                    break;
                case 'sluchowisko':
                    $dir = $sluchowiskoUploadFolder;
                    break;
            }
            if ( $files = scandir($dir) )
            {
                
                /*
                    Jako że scandir wczytuje cały katalog wstępnie ustalimy że na stronę
                    możemy załadować na raz np 10 rzeczy.
                    whichPage będzie przechowywało nam od którego zaczynamy wczytywać 

                    czyli np gdy jestesmy na pierwszej stronie to page bedzie 0 wiec wczytujemy z zakresu 0-9
                    na drugiej which page bedzie 10 i zaczniemy od 10 do 19
                */

                $whichPage = 0;

                if( isset ( $_SESSION['whichPage'] ) )
                    $whichPage = $_SESSION['whichPage'];

                $idFile = 0 + $whichPage;
                $maxidFile = 9 + $whichPage;
                while ($idFile <= $whichPage)
                {
                    // Jeżeli mamy np tylko 6 to nie wyswietlimy 7,8,9
                    if ($files[$idFile] == null)
                        break;
                    print_r($files[$idFile]);
                    $idFile++;
                }
            }
            else
                throw new Exception("Nie znaleziono plików");
        }
        else
        {
            throw new Exception(" ");
        }
    }  
    catch (Exception $e)
    {
        $_SESSION[''] = $e;
        header('');
    }
?>