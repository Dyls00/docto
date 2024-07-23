<?php
session_start();
require_once("../shared/header.php");
require_once("../shared/navBar.php");
require_once("../config/isConnected.php");
require_once("../config/isDoctor.php");

?>


<body id="body-login">
        <div class="container container-full d-flex justify-content-center align-items-center flex-column h-100">
            <div class="div-form-login shadow" style="background-color: lightgray; width: 40%; border-radius: 20px; padding: 20px;">
                <div class="container justify-content-center align-items-center flex-column" style="display:flex; flex-direction:row;">

                    <div class="container text-center">
                        <form action="../connexionUser/connexionUserSubmit.php" method="POST">
                            <div class="mb-3 col-6; container text-center">
                                <label for="email-input" class="form-label">Adresse email <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                    </svg></label>
                                <input type="email" class="form-control" id="email-input" name="email" style="background-color: #b3b3b3; border-radius: 20px;" required>
                            </div>
                            <div class="mb-3 col-6; container text-center">
                                <label for="password-input" class="form-label">Mot de passe <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z" />
                                    </svg></label>
                                <input type="password" class="form-control" id="password-input" name="password" style="background-color: #b3b3b3; border-radius: 20px;" required>
                            </div>
                            <div class="mb-3 col-6; container text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #0C655A;border:none; border-radius: 20px;"> Se connecter</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</body>

