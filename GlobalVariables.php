<?php
        // Skrypty PHP
    ///////////////////////////
    // Log In / Registration form
    ///////////////////////////

    $userAction      = 'userAction';
    $isLogged        = 'isLogged';

    $email_LogInForm = 'email';
    $pass_LogInForm  = 'password';

    $nick_RegisForm  = 'login';
    $email_RegisForm = 'email';
    $pass_RegisForm  = 'password';

    $userCredits     = 'userCredits';
    $error_LogInForm = 'errorLogInForm';
    $error_RegisForm = 'errorRegisForm';

    ///////////////////////////
    // Adding product form
    ///////////////////////////
    // LISTA TAGÓW
    // 6 tagów obowiązkowych
    // 

    $file_AddFileForm       = '';
    $typeFile_AddFileForm   = '';
    $fileDescr_AddFileForm  ='';
    $fileTag_AddFileForm    ='';
    $fileTag1_AddFileForm   ='';
    $fileTag2_AddFileForm   ='';
    $fileTag3_AddFileForm   ='';
    $fileTag4_AddFileForm   ='';
    $fileTag5_AddFileForm   ='';

    $error_AddFileForm = '';

    ///////////////////////////
    // Choose cathegory form
    ///////////////////////////

    $category_ChooseCategoryForm = '';

        // Bazy danych
    ///////////////////////////
    // Tablica użytkowników
    ///////////////////////////

    $usersTable = 'Uzytkownicy';

    $login_UsersTable_Col   = 'Nick';
    $pass_UsersTable_Col    = 'Haslo';
    $email_UsersTable_Col   = 'Email';
    $id_UsersTable_Col      = 'ID';

    ///////////////////////////
    // Tablice na wrzuty 
    // zależnie od kategori
    ///////////////////////////
    // TODO
    // te same nazwy różnych zdjęć

    $photosUploadTable  = 'Zdjecia';
    $photosUploadFolder = 'uploads/zdjecia/';

    $sluchowiskoUploadTable  = 'Sluchowiska';
    $sluchowiskoUploadFolder = 'uploads/sluchowiska/';

    $userID_UploadsTable_Col     = 'ID_USER';
    $fileName_UploadsTable_Col   = 'NazwaPliku';
    $descr_UploadsTable_Col      = 'Opis';
    $Tag_UploadsTable_Col        = 'Tag';
    $Tag1_UploadsTable_Col       = 'Tag1';
    $Tag2_UploadsTable_Col       = 'Tag2';
    $Tag3_UploadsTable_Col       = 'Tag3';
    $Tag4_UploadsTable_Col       = 'Tag4';
    $Tag5_UploadsTable_Col       = 'Tag5';

    ///////////////////////////
    // Tablica przechowująca informacje 
    // na temat wrzutów danego użytkownika
    // Tagi , nazwe itp
    ///////////////////////////

    $usersUploads = '';

?>