<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jQuery Validation Demo</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.2em;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="url"],
        input[type="tel"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
        }

        /* Error styling */
        .error {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            display: block;
            font-weight: normal;
        }

        input.error,
        select.error,
        textarea.error {
            border-color: #e74c3c;
            background-color: #fdf2f2;
        }

        /* Valid styling */
        input.valid,
        select.valid,
        textarea.valid {
            border-color: #27ae60;
            background-color: #f8fff8;
        }

        .submit-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            display: none;
        }

        .field-info {
            font-size: 12px;
            color: #666;
            margin-top: 3px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>jQuery Validation Demo</h1>

        <form id="registrationForm" novalidate>
            <div class="form-group">
                <label for="username">Username *</label>
                <input type="text" id="username" name="username" placeholder="Enter username">
                <div class="field-info">Must be 3-20 characters long</div>
            </div>

            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password">Password *</label>
                <input type="password" id="password" name="password" placeholder="Enter password">
                <div class="field-info">Must be at least 6 characters</div>
            </div>

            <div class="form-group">
                <label for="confirmPassword">Confirm Password *</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password">
            </div>

            <div class="form-group">
                <label for="age">Age *</label>
                <input type="text" id="age" name="age" placeholder="Enter your age">
                <div class="field-info">Must be between 13 and 120</div>
            </div>

            <div class="form-group">
                <label for="website">Website (Optional)</label>
                <input type="url" id="website" name="website" placeholder="https://yourwebsite.com">
            </div>

            <div class="form-group">
                <label for="phone">Phone Number (Optional)</label>
                <input type="tel" id="phone" name="phone" placeholder="+1234567890">
            </div>

            <div class="form-group">
                <label for="country">Country *</label>
                <select id="country" name="country">
                    <option value="">Select your country</option>
                    <option value="us">United States</option>
                    <option value="uk">United Kingdom</option>
                    <option value="ca">Canada</option>
                    <option value="au">Australia</option>
                    <option value="de">Germany</option>
                    <option value="fr">France</option>
                    <option value="other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="bio">Bio (Optional)</label>
                <textarea id="bio" name="bio" rows="4" placeholder="Tell us about yourself..."></textarea>
                <div class="field-info">Maximum 500 characters</div>
            </div>

            <div class="form-group">
                <div class="checkbox-group">
                    <input type="checkbox" id="terms" name="terms" value="1">
                    <label for="terms">I agree to the Terms and Conditions *</label>
                </div>
            </div>

            <div class="form-group">
                <div class="checkbox-group">
                    <input type="checkbox" id="newsletter" name="newsletter" value="1">
                    <label for="newsletter">Subscribe to newsletter (Optional)</label>
                </div>
            </div>

            <button type="submit" class="submit-btn">Create Account</button>
        </form>

        <div id="successMessage" class="success-message">
            ✅ Registration successful! All validation rules passed.
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Add custom validation method for strong password
            $.validator.addMethod("strongPassword", function(value, element) {
                return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/.test(value);
            }, "Password must contain at least one lowercase letter, one uppercase letter, and one number.");

            // Add custom validation method for phone number
            $.validator.addMethod("phoneUS", function(value, element) {
                return this.optional(element) || /^[\+]?[1-9][\d]{0,15}$/.test(value);
            }, "Please enter a valid phone number.");

            // Initialize validation
            $("#registrationForm").validate({
                // Validation rules
                rules: {
                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 20,
                        regex: /^[a-zA-Z0-9_]+$/
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        strongPassword: true
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: "#password"
                    },
                    age: {
                        required: true,
                        number: true,
                        min: 13,
                        max: 120
                    },
                    website: {
                        url: true
                    },
                    phone: {
                        phoneUS: true
                    },
                    country: {
                        required: true
                    },
                    bio: {
                        maxlength: 500
                    },
                    terms: {
                        required: true
                    }
                },

                // Custom error messages
                messages: {
                    username: {
                        required: "Username is required",
                        minlength: "Username must be at least 3 characters",
                        maxlength: "Username cannot exceed 20 characters",
                        regex: "Username can only contain letters, numbers, and underscores"
                    },
                    email: {
                        required: "Email address is required",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password must be at least 6 characters"
                    },
                    confirmPassword: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    },
                    age: {
                        required: "Age is required",
                        number: "Please enter a valid number",
                        min: "You must be at least 13 years old",
                        max: "Please enter a realistic age"
                    },
                    website: "Please enter a valid URL (include http:// or https://)",
                    country: "Please select your country",
                    bio: "Bio cannot exceed 500 characters",
                    terms: "You must agree to the terms and conditions"
                },

                // Validation options
                errorClass: 'error',
                validClass: 'valid',
                errorElement: 'span',

                // When to validate
                onkeyup: function(element) {
                    // Validate on keyup, but not for checkboxes
                    if (element.type !== 'checkbox') {
                        this.element(element);
                    }
                },

                onclick: function(element) {
                    // Validate checkboxes on click
                    if (element.type === 'checkbox') {
                        this.element(element);
                    }
                },

                // Highlight function for styling invalid fields
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass(errorClass).removeClass(validClass);
                },

                // Unhighlight function for styling valid fields
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass(errorClass).addClass(validClass);
                },

                // Success callback when form is valid
                submitHandler: function(form) {
                    // Prevent actual form submission for demo
                    event.preventDefault();

                    // Show success message
                    $('#successMessage').slideDown();

                    // Optionally reset form after a delay
                    setTimeout(function() {
                        $(form)[0].reset();
                        $(form).find('.valid').removeClass('valid');
                        $('#successMessage').slideUp();
                    }, 3000);

                    return false; // Prevent actual submission for demo
                }
            });

            // Add custom regex validation method
            $.validator.addMethod("regex", function(value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            }, "Please check your input format.");

            // Real-time character counter for bio
            $('#bio').on('input', function() {
                var current = $(this).val().length;
                var max = 500;
                var remaining = max - current;

                if (!$('.char-counter').length) {
                    $(this).after('<div class="char-counter field-info"></div>');
                }

                $('.char-counter').text(remaining + ' characters remaining');

                if (remaining < 50) {
                    $('.char-counter').css('color', '#e74c3c');
                } else {
                    $('.char-counter').css('color', '#666');
                }
            });
        });
    </script>
</body>
</html>
