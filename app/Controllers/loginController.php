<?php
session_start();
require_once "../Service/userService.php";
require_once "../Model/user.php";

class loginController
{
    private userService $userService;

    public function __construct()
    {
        $this->userService = new userService();
    }

    public function login(): void
    {
        require_once "../view/login.php";
    }

    public function validateLogin($user_name, $password): void
    {
        $loggedIn = $this->userService->validateLogin($user_name, $password);
        if ($loggedIn) {
            echo '<p id="message">Well done to me, it works</p>';
            $user = $this->userService->getUser($user_name);
            // Serialize the object
            $userSerialized = serialize($user);

            // Store the serialized object in a session variable
            $_SESSION['user'] = $userSerialized;

            require_once "../view/userprofile.php";
        } else {
            echo '<p id="message">Invalid username or password</p>';
            require_once "../view/login.php";
        }

        // Output JavaScript code to remove the message after 3 seconds
        echo '<script>
            setTimeout(function(){
                document.getElementById("message").style.display = "none";
            }, 3000);
          </script>';
    }
}
