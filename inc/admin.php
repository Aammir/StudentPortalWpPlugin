<style>
    .error {
        color: red;
    }

    .error-border {
        border: 1px solid red;
    }

    .notice-error,
    div.error {
        display: inline-block;
        border-color: transparent;
        background: transparent;
        border-left-color: #d63638;
    }

    .Gender_error:nth-of-type(2) {
        display: none !important;
    }
</style>
<h1 class="text-center">Add Students</h1>
<form action="" id="add_student">
    <table class="form-table">
        <tr>
            <td><label for="first_name">First Name</label></td>
            <td><input type="text" class="regular-text" name="first_name" id="first_name" data-name="First Name"></td>
        </tr>
        <tr>
            <td><label for="last_name">Last Name</label></td>
            <td><input type="text" class="regular-text" name="last_name" id="last_name" data-name="Last Name"></td>
        </tr>
        <tr>
            <td><label for="guardian_name">Guardian Name</label></td>
            <td><input type="text" class="regular-text" name="guardian_name" id="guardian_name"
                    data-name="Guardian Name"></td>
        </tr>
        <tr>
            <td><label for="of_class">Class</label></td>
            <td><input type="text" class="regular-text" name="of_class" id="of_class" data-name="Class"></td>
        </tr>

        <tr>
            <td><label for="grade">Grade</label></td>
            <td><input type="text" class="regular-text" name="grade" id="grade" data-name="Grade"></td>
        </tr>
        <tr>
            <td><label for="student_email">Email</label></td>
            <td><input type="text" class="regular-text" name="student_email" id="student_email" data-name="Email"></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="text" class="regular-text" name="password" id="password" data-name="Password"></td>
        </tr>
        <tr>
            <td><label for="gender-m">Gender</label></td>
            <td>
                <label><input type="radio" class="radio" name="gender" id="gender-m" value="male" data-name="Gender">
                    Male</label>
                <label><input type="radio" class="radio" name="gender" id="gender-f" value="female" data-name="Gender">
                    Female</label>
            </td>
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
        (function ($) {
            $(document).ready(function () {
                //
                $('#add_student').on('submit', function (e) {
                    e.preventDefault();

                    // Reset previous error messages and styles
                    $('.error').remove();
                    $('.error-border').removeClass('error-border');

                    // Validate each input
                    var valid = true;

                    $('input').each(function () {
                        var input = $(this);
                        var fieldName = input.data('name');
                        var value = input.val();

                        if (input.attr('type') === 'text' && !value) {
                            valid = false;
                            input.addClass('error-border');
                            input.after('<div class="error">' + fieldName + ' is required</div>');
                        } else if (input.attr('type') === 'radio' && !$('input[name="' + fieldName + '"]:checked').length) {
                            valid = false;
                            input.closest('td').append('<div class="error ' + fieldName + '_error ">' + fieldName + ' is required</div>');
                        } else if (fieldName === 'student_email' && !isValidEmail(value)) {
                            valid = false;
                            input.addClass('error-border');
                            input.after('<div class="error">Invalid email format</div>');
                        }

                    });

                    if (valid) {
                        alert('Everything is OK');
                        // Submit the form here if needed
                        // $('#add_student').submit();
                    }
                });

                // Remove error messages and styles on input focus
                $('input').on('input focus', function () {
                    $(this).removeClass('error-border');
                    $(this).siblings('.error').remove();
                });
                $('input[type="radio"]').on('click', function () {
                    var fieldName = $(this).attr('name');
                    $('input[name="' + fieldName + '"]').removeClass('error-border');
                    $('input[name="' + fieldName + '"]').closest('td').find('.error').remove();
                });

                // Email validation function
                function isValidEmail(email) {
                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    return emailRegex.test(email);
                }
                //
            });
        })(jQuery);	
    </script>
    <?php
}