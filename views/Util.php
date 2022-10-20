<?php

    class Util {

        // Method for inputs sanitization
        public function textInput($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        // Method for displaying success & error alert message
        public function showMessage($type, $message) {
            return '<div class="alert alert-'.$type.' alert-dismissable fade show" role="alert">
                        <strong>'.$message.'</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }

    }

?>