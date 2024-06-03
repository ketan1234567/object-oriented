
<?php
require 'User.php';


class FormHandler {
    public function handle($postData) {
        $user = new User($postData['username'], $postData['email'], $postData['password']);
        
        if ($user->validate()) {
            if ($user->save()) {
                return "User registered successfully!";
            } else {
                return "Failed to save user.";
            }
        } else {
            return "Validation failed.";
        }
    }
}


?>