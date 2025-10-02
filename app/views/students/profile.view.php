<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Campus Canteen</title>
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/base.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-index.css">
    <script>
        const ROOT = "<?= ROOT ?>";
    </script>
    <style>
        /* Profile Page Specific Styles */
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(102, 126, 234, 0.3);
            text-align: center;
        }

        .profile-header h1 {
            margin: 0 0 0.5rem 0;
            font-size: 2.2rem;
            font-weight: 700;
        }

        .profile-header p {
            margin: 0;
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            margin: 0 auto 1rem auto;
            border: 4px solid rgba(255, 255, 255, 0.3);
        }

        .profile-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .profile-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
        }

        .profile-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .profile-card h3 {
            margin: 0 0 1.5rem 0;
            color: var(--primary-color);
            font-size: 1.4rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f1f5f9;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
            box-sizing: border-box;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            transform: translateY(-1px);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-primary {
            background: var(--secondary-color);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            justify-content: center;
        }

        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #6c757d;
            border: 2px solid #e9ecef;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #e9ecef;
            border-color: #adb5bd;
            color: #495057;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
        }

        .current-info {
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--secondary-color);
        }

        .current-info h4 {
            margin: 0 0 1rem 0;
            color: var(--primary-color);
            font-size: 1.1rem;
            font-weight: 600;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 500;
            color: #64748b;
        }

        .info-value {
            font-weight: 600;
            color: var(--primary-color);
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: none;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid #c3e6cb;
        }

        .success-message.show {
            display: flex;
        }

        .error-message {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 0.3rem;
            display: none;
            font-weight: 500;
        }

        .error-message.show {
            display: block;
        }

        .form-group input.error,
        .form-group textarea.error,
        .form-group select.error {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
        }

        .verification-status {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .status-verified {
            background: #d1fae5;
            color: #065f46;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--secondary-color);
            margin: 0;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #64748b;
            margin: 0.3rem 0 0 0;
        }

        .department-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
        }

        .department-info h4 {
            margin: 0 0 0.5rem 0;
            font-size: 1.2rem;
        }

        .department-info p {
            margin: 0;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .profile-container {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
            }

            .quick-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .profile-header h1 {
                font-size: 1.8rem;
            }

            .profile-avatar {
                width: 80px;
                height: 80px;
                font-size: 2.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php require 'header.view.php'; ?>

    <!-- Container for sidebar and main content -->
    <div class="container">
        <!-- Sidebar -->
        <?php $page = "profile";
        require 'sidebar.view.php'; ?>

        <!-- Main Content -->
        <div class="main-content">


            <!-- Quick Stats -->
            <div class="quick-stats">
                <div class="stat-card">
                    <span class="stat-icon">📋</span>
                    <h3 class="stat-value">24</h3>
                    <p class="stat-label">Total Orders</p>
                </div>
                <div class="stat-card">
                    <span class="stat-icon">💰</span>
                    <h3 class="stat-value">₹2,450</h3>
                    <p class="stat-label">Total Spent</p>
                </div>

            </div>

            <!-- Success Message -->
            <div class="success-message" id="successMessage">
                ✅ Profile updated successfully!
            </div>

            <!-- Profile Forms -->
            <div class="profile-container">
                <!-- Personal Information -->
                <div class="profile-card">
                    <h3>👤 Personal Information</h3>

                    <!-- Current Info Display -->
                    <div class="current-info">
                        <h4>Current Information</h4>
                        <div class="info-item">
                            <span class="info-label">Name:</span>
                            <span class="info-value">Rahul Sharma</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email:</span>
                            <span class="info-value">rahul.sharma@student.college.edu</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Phone:</span>
                            <span class="info-value">+91 98765 43210</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Registration:</span>
                            <span class="info-value">CS2021001</span>
                        </div>
                    </div>

                    <form id="personalInfoForm">
                        <div class="form-group">
                            <label for="fullName">Full Name</label>
                            <input type="text" id="fullName" name="full_name" value="Rahul Sharma" required>
                            <div class="error-message" id="fullName-error"></div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" id="firstName" name="first_name" value="Rahul" required>
                                <div class="error-message" id="firstName-error"></div>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" id="lastName" name="last_name" value="Sharma" required>
                                <div class="error-message" id="lastName-error"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="rahul.sharma@student.college.edu" required>
                            <div class="error-message" id="email-error"></div>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="+91 98765 43210" required>
                            <div class="error-message" id="phone-error"></div>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea id="address" name="address" placeholder="Enter your complete address..." required>123 Student Hostel, University Campus, City - 560001, Karnataka, India</textarea>
                            <div class="error-message" id="address-error"></div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-secondary">Cancel</button>
                            <button type="submit" class="btn-primary">
                                💾 Update Personal Info
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Academic Information -->
                <div class="profile-card">
                    <h3>🎓 Academic Information</h3>

                    <!-- Department Info -->
                    <div class="department-info">
                        <h4>Current Department</h4>
                        <p>Computer Science & Engineering</p>
                    </div>

                    <form id="academicInfoForm">
                        <div class="form-group">
                            <label for="regNumber">Registration Number</label>
                            <input type="text" id="regNumber" name="reg_number" value="CS2021001" readonly>
                            <small style="color: #64748b; font-size: 0.8rem;">Registration number cannot be changed</small>
                        </div>

                        <div class="form-group">
                            <label for="department">Department</label>
                            <select id="department" name="department" required>
                                <option value="">Select Department</option>
                                <option value="computer_science" selected>Computer Science & Engineering</option>
                                <option value="electrical">Electrical & Electronics Engineering</option>
                                <option value="mechanical">Mechanical Engineering</option>
                                <option value="civil">Civil Engineering</option>
                                <option value="electronics">Electronics & Communication</option>
                                <option value="information_science">Information Science & Engineering</option>
                                <option value="biotechnology">Biotechnology</option>
                                <option value="chemical">Chemical Engineering</option>
                                <option value="aerospace">Aerospace Engineering</option>
                                <option value="industrial">Industrial Engineering</option>
                            </select>
                            <div class="error-message" id="department-error"></div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="year">Academic Year</label>
                                <select id="year" name="year" required>
                                    <option value="">Select Year</option>
                                    <option value="1">1st Year</option>
                                    <option value="2">2nd Year</option>
                                    <option value="3" selected>3rd Year</option>
                                    <option value="4">4th Year</option>
                                </select>
                                <div class="error-message" id="year-error"></div>
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select id="semester" name="semester" required>
                                    <option value="">Select Semester</option>
                                    <option value="1">1st Semester</option>
                                    <option value="2">2nd Semester</option>
                                    <option value="3">3rd Semester</option>
                                    <option value="4">4th Semester</option>
                                    <option value="5" selected>5th Semester</option>
                                    <option value="6">6th Semester</option>
                                    <option value="7">7th Semester</option>
                                    <option value="8">8th Semester</option>
                                </select>
                                <div class="error-message" id="semester-error"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="section">Section</label>
                            <select id="section" name="section" required>
                                <option value="">Select Section</option>
                                <option value="A" selected>Section A</option>
                                <option value="B">Section B</option>
                                <option value="C">Section C</option>
                                <option value="D">Section D</option>
                            </select>
                            <div class="error-message" id="section-error"></div>
                        </div>

                        <div class="form-group">
                            <label for="rollNumber">Roll Number</label>
                            <input type="text" id="rollNumber" name="roll_number" value="21CS001" required>
                            <div class="error-message" id="rollNumber-error"></div>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-secondary">Cancel</button>
                            <button type="submit" class="btn-primary">
                                🎓 Update Academic Info
                            </button>
                        </div>
                    </form>
                </div>
            </div>


        </div>

        <script>
            // Form validation and submission
            document.addEventListener('DOMContentLoaded', function() {
                const forms = document.querySelectorAll('form');
                const successMessage = document.getElementById('successMessage');

                forms.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();

                        // Clear previous errors
                        clearAllErrors();

                        // Validate form
                        let isValid = validateForm(this);

                        if (isValid) {
                            // Show success message
                            showSuccessMessage();

                            // Update current info display if it's personal info form
                            if (this.id === 'personalInfoForm') {
                                updateCurrentInfo();
                            }
                        }
                    });
                });

                // Real-time validation
                const inputs = document.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.addEventListener('blur', function() {
                        validateField(this);
                    });
                });
            });

            function validateForm(form) {
                let isValid = true;
                const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');

                inputs.forEach(input => {
                    if (!validateField(input)) {
                        isValid = false;
                    }
                });

                return isValid;
            }

            function validateField(field) {
                const value = field.value.trim();
                const fieldName = field.name;
                let isValid = true;
                let errorMessage = '';

                // Required field validation
                if (field.hasAttribute('required') && !value) {
                    errorMessage = 'This field is required';
                    isValid = false;
                }
                // Email validation
                else if (field.type === 'email' && value && !isValidEmail(value)) {
                    errorMessage = 'Please enter a valid email address';
                    isValid = false;
                }
                // Phone validation
                else if (field.type === 'tel' && value && !isValidPhone(value)) {
                    errorMessage = 'Please enter a valid phone number';
                    isValid = false;
                }
                // Name validation
                else if ((fieldName === 'full_name' || fieldName === 'first_name' || fieldName === 'last_name') && value && value.length < 2) {
                    errorMessage = 'Name must be at least 2 characters long';
                    isValid = false;
                }

                if (isValid) {
                    removeError(field);
                } else {
                    showError(field, errorMessage);
                }

                return isValid;
            }

            function showError(field, message) {
                const errorDiv = document.getElementById(field.id + '-error');
                if (errorDiv) {
                    errorDiv.textContent = message;
                    errorDiv.classList.add('show');
                }
                field.classList.add('error');
            }

            function removeError(field) {
                const errorDiv = document.getElementById(field.id + '-error');
                if (errorDiv) {
                    errorDiv.textContent = '';
                    errorDiv.classList.remove('show');
                }
                field.classList.remove('error');
            }

            function clearAllErrors() {
                const errorMessages = document.querySelectorAll('.error-message');
                const errorFields = document.querySelectorAll('.error');

                errorMessages.forEach(error => {
                    error.textContent = '';
                    error.classList.remove('show');
                });

                errorFields.forEach(field => {
                    field.classList.remove('error');
                });
            }

            function showSuccessMessage() {
                const successMessage = document.getElementById('successMessage');
                successMessage.classList.add('show');

                // Scroll to top to show message
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

                // Hide message after 3 seconds
                setTimeout(() => {
                    successMessage.classList.remove('show');
                }, 3000);
            }

            function updateCurrentInfo() {
                // Update the current info display with new values
                const fullName = document.getElementById('fullName').value;
                const email = document.getElementById('email').value;
                const phone = document.getElementById('phone').value;

                const infoItems = document.querySelectorAll('.info-value');
                if (infoItems[0]) infoItems[0].textContent = fullName;
                if (infoItems[1]) infoItems[1].textContent = email;
                if (infoItems[2]) infoItems[2].textContent = phone;
            }

            function isValidEmail(email) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailRegex.test(email);
            }

            function isValidPhone(phone) {
                const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
                return phoneRegex.test(phone.replace(/[\s\-\(\)]/g, ''));
            }

            // Department change handler
            document.getElementById('department').addEventListener('change', function() {
                const department = this.value;
                const departmentInfo = document.querySelector('.department-info p');

                const departmentNames = {
                    'computer_science': 'Computer Science & Engineering',
                    'electrical': 'Electrical & Electronics Engineering',
                    'mechanical': 'Mechanical Engineering',
                    'civil': 'Civil Engineering',
                    'electronics': 'Electronics & Communication',
                    'information_science': 'Information Science & Engineering',
                    'biotechnology': 'Biotechnology',
                    'chemical': 'Chemical Engineering',
                    'aerospace': 'Aerospace Engineering',
                    'industrial': 'Industrial Engineering'
                };

                if (department && departmentNames[department]) {
                    departmentInfo.textContent = departmentNames[department];
                }
            });
        </script>
</body>

</html>