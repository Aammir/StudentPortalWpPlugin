<h1 class="text-center">Add Students</h1>
<form action="" id="add_student">
    <table class="form-table">
        <tr>
            <td><label for="first_name">First Name</label></td>
            <td><input type="text" class="regular-text" name="first_name" id="first_name"></td>
        </tr>
        <tr>
            <td><label for="last_name">Last Name</label></td>
            <td><input type="text" class="regular-text" name="last_name" id="last_name"></td>
        </tr>
        <tr>
            <td><label for="guardian_name">Guardian Name</label></td>
            <td><input type="text" class="regular-text" name="guardian_name" id="guardian_name"></td>
        </tr>
        <tr>
            <td><label for="of_class">Class</label></td>
            <td><input type="text" class="regular-text" name="of_class" id="of_class"></td>
        </tr>

        <tr>
            <td><label for="grade">Grade</label></td>
            <td><input type="text" class="regular-text" name="grade" id="grade"></td>
        </tr>
        <tr>
            <td><label for="student_email">Email</label></td>
            <td><input type="text" class="regular-text" name="student_email" id="student_email"></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="text" class="regular-text" name="password" id="password"></td>
        </tr>
    </table>
    <p class="submit">
        <button type="submit" name="submit" id="submit" class="button button-primary">Save Changes</button>
    </p>
</form>
<?php

add_action('admin_footer', 'student_save');

function student_save()
{
    ?>
    <script>
        function validateInput(input, errorMessage) {
            var value = input.val();
            var errorSpan = input.next(".error-msg");

            if (value.trim() === "") {
                errorSpan.text(errorMessage);
                return false;
            } else {
                errorSpan.text(""); // Clear the error message
                return true;
            }
        }


        (function ($) {
            $(document).ready(function () {
                console.log('noConf added!');
                $(document).on('submit', '#add_student', function (event) {
                    event.preventDefault();
                    let formData = $(this).serialize();

                    var first_name = $("#first_name");
                    var last_name = $("#last_name");
                    var guardian_name = $("#guardian_name");
                    var of_class = $("#of_class");
                    var grade = $("#grade");
                    var student_email = $("#student_email");
                    var password = $("#password");

                    var isFNameValid = validateInput(first_name, "First name is required.");
                    var isLNameValid = validateInput(last_name, "Last name is required.");
                    var isEmailValid = validateInput(student_email, "Email is required.");
                    var isPasswordValid = validateInput(password, "Password is required.");
                    var isGuardianNameValid = validateInput(guardian_name, "Guardian name is required.");
                    var isClassValid = validateInput(of_class, "Class is required.");
                    var isClassValid = validateInput(of_class, "Class is required.");

                    // Prevent form submission if any of the inputs are invalid
                    if (!isNameValid || !isEmailValid || !isPasswordValid) {
                        e.preventDefault(); // Prevent the form from submitting
                    }
                });
            });
        })(jQuery);	
    </script>
    <?php
}