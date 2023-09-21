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
            <td>
                <select name="grade" id="grade" class="regular-text" data-name="Grade">
                    <option value=""></option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F">F</option>
                </select>
            </td>
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

                    $('#add_student').find('input, select').each(function () {
                        var input = $(this);
                        var fieldName = input.data('name');
                        var value = input.val();

                        if (input.attr('type') === 'text' && !value) {
                            valid = false;
                            input.addClass('error-border');
                            input.after('<div class="error">' + fieldName + ' is required</div>');
                        } else if (input.attr('type') === 'radio' && !$('input[name="gender"]:checked').length) {
                            valid = false;
                            input.closest('td').append('<div class="error ' + fieldName + '_error ">' + fieldName + ' is required</div>');
                        } else if (fieldName === 'student_email' && !isValidEmail(value)) {
                            valid = false;
                            input.addClass('error-border');
                            input.after('<div class="error">Invalid email format</div>');
                        }
                        else if ($('#grade').val() == '') {
                            valid = false;
                            input.addClass('error-border');
                            input.after('<div class="error">' + fieldName + ' is required</div>');
                        }

                    });

                    if (valid) {
                        let form_data = $('#add_student').serialize();
                        alert(form_data);

                        let the_url = "<?php echo admin_url('admin-ajax.php') ?>?action=add_student";
                        /*$.ajax({
                            //debugger;
                            url: the_url,
                            type: "post",
                            dataType: "json",
                            //                    async: false
                            data: form_data,
                            //                    beforeSend: ez_loading_func()
                        }).done(function (response) {
                            // debugger;
                            // console.log(response);
                            // if (response.Status == 1) {
                            //     SuccessMsg(response.MSG);
                            //     $('form#add_student')[0].reset();
                                 
                                 
                            //     // get_records();
                            // } else {
                            //     // ErrorMsg(response.MSG);

                            // }
                        }); //ajax done */
                    }
                });

                // Remove error messages and styles on input focus
                $('input, select').on('input focus', function () {
                    $(this).removeClass('error-border');
                    $(this).siblings('.error').remove();
                });
                $('input[type="radio"]').on('click', function () {
                    var fieldName = $(this).attr('name');
                    $('input[name="' + fieldName + '"]').removeClass('error-border');
                    $('input[name="' + fieldName + '"]').closest('td').find('.error').remove();
                    valid = true;
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


// add_student
add_action('wp_ajax_add_student', 'add_student');
add_action('wp_ajax_nopriv_add_student', 'add_student');

function add_student()
{
    print_r($_POST);
    exit;
}