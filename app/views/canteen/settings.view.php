<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Canteen Settings - Campus Canteen</title>
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/canteen-common.css">
    <script>
        const ROOT = "<?= ROOT ?>";
    </script>
    <style>
        /* Settings Page Specific Styles */
        .settings-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .settings-header h1 {
            margin: 0 0 0.5rem 0;
            font-size: 2rem;
            font-weight: 700;
        }

        .settings-header p {
            margin: 0;
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .settings-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .settings-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .settings-card h3 {
            margin: 0 0 1.5rem 0;
            color: #333;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #333;
            font-size: 0.9rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
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

        .time-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-primary {
            background: #4a90e2;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            background: #357abd;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #f8f9fa;
            color: #666;
            border: 2px solid #e1e5e9;
            padding: 10px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background: #e9ecef;
            border-color: #adb5bd;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            margin-top: 2rem;
        }

        .current-info {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid #4a90e2;
        }

        .current-info h4 {
            margin: 0 0 0.5rem 0;
            color: #333;
            font-size: 1rem;
        }

        .current-info p {
            margin: 0.25rem 0;
            color: #666;
            font-size: 0.9rem;
        }

        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .status-open {
            background: #d4edda;
            color: #155724;
        }

        .status-closed {
            background: #f8d7da;
            color: #721c24;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .quick-action-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: all 0.3s;
            border: 2px solid transparent;
            text-align: center;
        }

        .quick-action-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border-color: #4a90e2;
        }

        .quick-action-icon {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            display: block;
        }

        .quick-action-card h4 {
            margin: 0 0 0.5rem 0;
            color: #333;
            font-size: 1rem;
        }

        .quick-action-card p {
            margin: 0;
            color: #666;
            font-size: 0.85rem;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid #c3e6cb;
        }

        .days-selector {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .day-checkbox {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.8rem;
        }

        .day-checkbox input[type="checkbox"] {
            width: auto;
            margin: 0;
        }

        /* Error Message Styles */
        .error-message {
            color: #dc3545;
            font-size: 0.8rem;
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

        .form-group input.error:focus,
        .form-group textarea.error:focus,
        .form-group select.error:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.2);
        }

        @media (max-width: 768px) {
            .settings-container {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .form-row,
            .time-inputs {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column;
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
        <?php $page = "settings";
        require 'sidebar.view.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Settings Header -->
            <!-- <div class="settings-header">
                <h1>Canteen Settings ⚙️</h1>
                <p>Manage your canteen information, operating hours, and contact details</p>
            </div> -->

            <!-- Quick Actions -->
            <!-- <div class="quick-actions">
                <div class="quick-action-card" onclick="toggleCanteenStatus()">
                    <span class="quick-action-icon">🔄</span>
                    <h4>Toggle Status</h4>
                    <p>Open/Close canteen</p>
                </div>
                <div class="quick-action-card" onclick="updateEmergencyContact()">
                    <span class="quick-action-icon">📞</span>
                    <h4>Emergency Update</h4>
                    <p>Quick contact change</p>
                </div>
                <div class="quick-action-card" onclick="setHolidayHours()">
                    <span class="quick-action-icon">🎉</span>
                    <h4>Holiday Hours</h4>
                    <p>Set special timings</p>
                </div>
            </div> -->


            <!-- Current Status -->
            <div class="current-info">
                <h4>Current Status</h4>
                <?php if(isCurrentTimeBetween($canteen->open,$canteen->close)): ?>
                
                    
                    <div class="status-indicator status-open">
                        🟢 Currently Open
                    </div>
                    <?php else: ?>
                        <div class="status-indicator status-open">
                        🔴 Currently Closed
                    </div>
                    <?php endif; ?>
                
                <!-- <p><strong>Manager:</strong> John Smith</p>
                <p><strong>Phone:</strong> +1 (555) 123-4567</p>
                <p><strong>Hours:</strong> 8:00 AM - 8:00 PM (Mon-Fri)</p>
                <p><strong>Last Updated:</strong> March 15, 2024</p> -->
            </div>


            <!-- Settings Forms -->
            <div class="settings-container">
                <!-- Basic Information -->
                 <form action="<?=ROOT?>canteen/settings" method="post">

                 
                <div id="canteenSettings" class="settings-card"> 
                    <h3>🏪 Basic Information</h3>


                    <div class="form-group">
                        <label for="canteenName">Canteen Name</label>
                        <input type="text" id="canteenName" name="canteen_name" value="<?= $canteen->canteen_name ?>" required>
                        <div class="error-message" id="canteenName-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="phoneNumber">Phone Number</label>
                        <input type="tel" id="phoneNumber" name="phone_number" value="<?= $canteen->phn_no ?>" required>
                        <div class="error-message" id="phoneNumber-error"></div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="<?= $canteen->email ?>" required>
                        <?php if(isset($error_email)): ?>
                    
                        <div id="email-domain-error" style="color: red; font-size: 14px; margin-top: 5px;"><?=$error_email?></div>
                            <?php endif; ?>
                    </div>
                    

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" placeholder="Brief description of your canteen...">
                            <?=$canteen->description?></textarea>
                        <div class="error-message" id="description-error"></div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-secondary">Cancel</button>
                        <button type="submit" class="btn-primary">
                            💾 Save Changes
                        </button>


                    </div>

                </div>
                </form>


                <!-- Operating Hours -->
                <div class="settings-card">
                    <h3>🕒 Operating Hours</h3>

                    <form id="hoursForm" method="POST" action="<?= ROOT ?>Canteen/updateHours">
                        <div class="form-group">
                            <label>Operating Days</label>
                            <div class="days-selector">
                                <div class="day-checkbox">
                                    <input type="checkbox" id="monday" name="days[]" value="monday" <?= in_array('monday', $canteen->working_days) ? 'checked' : '' ?>>
                                    <label for="monday">Mon</label>
                                </div>
                                <div class="day-checkbox">
                                    <input type="checkbox" id="tuesday" name="days[]" value="tuesday" <?= in_array('tuesday', $canteen->working_days) ? 'checked' : '' ?>>
                                    <label for="tuesday">Tue</label>
                                </div>
                                <div class="day-checkbox">
                                    <input type="checkbox" id="wednesday" name="days[]" value="wednesday" <?= in_array('wednesday', $canteen->working_days) ? 'checked' : '' ?>>
                                    <label for="wednesday">Wed</label>
                                </div>
                                <div class="day-checkbox">
                                    <input type="checkbox" id="thursday" name="days[]" value="thursday" <?= in_array('thursday', $canteen->working_days) ? 'checked' : '' ?>>
                                    <label for="thursday">Thu</label>
                                </div>
                                <div class="day-checkbox">
                                    <input type="checkbox" id="friday" name="days[]" value="friday" <?= in_array('friday', $canteen->working_days) ? 'checked' : '' ?>>
                                    <label for="friday">Fri</label>
                                </div>
                                <div class="day-checkbox">
                                    <input type="checkbox" id="saturday" name="days[]" value="saturday" <?= in_array('saturday', $canteen->working_days) ? 'checked' : '' ?>>
                                    <label for="saturday">Sat</label>
                                </div>
                                <div class="day-checkbox">
                                    <input type="checkbox" id="sunday" name="days[]" value="sunday" <?= in_array('sunday', $canteen->working_days) ? 'checked' : '' ?>>
                                    <label for="sunday">Sun</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="openTime">Opening Time</label>
                                <input type="time" id="openTime" name="open_time" value="<?= $canteen->open ?>" required>
                                <div class="error-message" id="openTime-error"></div>
                            </div>
                            <div class="form-group">
                                <label for="closeTime">Closing Time</label>
                                <input type="time" id="closeTime" name="close_time" value="<?= $canteen->close ?>" required>
                                <div class="error-message" id="closeTime-error"></div>
                            </div>
                        </div>


                        <div class="form-actions">
                            <button type="button" class="btn-secondary">Reset</button>
                            <button type="submit" class="btn-primary">
                                ⏰ Update Hours
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Additional Settings -->
            <!-- <div class="settings-card">
                <h3>🔧 Additional Settings</h3>

                <form method="POST" action="<?= ROOT ?>canteen/advanced-settings">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="maxOrders">Max Orders Per Hour</label>
                            <input type="number" id="maxOrders" name="max_orders" value="50" min="1">
                            <div class="error-message" id="maxOrders-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="prepTime">Average Prep Time (minutes)</label>
                            <input type="number" id="prepTime" name="prep_time" value="15" min="1">
                            <div class="error-message" id="prepTime-error"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="minOrder">Minimum Order Amount</label>
                            <input type="number" id="minOrder" name="min_order" value="50" min="0" step="0.01">
                            <div class="error-message" id="minOrder-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="deliveryCharge">Delivery Charge</label>
                            <input type="number" id="deliveryCharge" name="delivery_charge" value="10" min="0" step="0.01">
                            <div class="error-message" id="deliveryCharge-error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="paymentMethods">Accepted Payment Methods</label>
                        <div style="display: flex; gap: 1rem; flex-wrap: wrap; margin-top: 0.5rem;">
                            <label style="display: flex; align-items: center; gap: 0.25rem;">
                                <input type="checkbox" name="payment_methods[]" value="cash" checked>
                                Cash
                            </label>
                            <label style="display: flex; align-items: center; gap: 0.25rem;">
                                <input type="checkbox" name="payment_methods[]" value="card" checked>
                                Card
                            </label>
                            <label style="display: flex; align-items: center; gap: 0.25rem;">
                                <input type="checkbox" name="payment_methods[]" value="upi" checked>
                                UPI
                            </label>
                            <label style="display: flex; align-items: center; gap: 0.25rem;">
                                <input type="checkbox" name="payment_methods[]" value="wallet">
                                Digital Wallet
                            </label>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-secondary">Cancel</button>
                        <button type="submit" class="btn-primary">
                            🔧 Save Settings
                        </button>
                    </div>
                </form>
            </div> -->
        </div>
    </div>
    <script src=" <?= ROOT ?>assets/js/functions.js"></script>
    <script>
        function toggleCanteenStatus() {
            if (confirm('Are you sure you want to change the canteen status?')) {
                alert('Canteen status updated!');
                // Here you would make an AJAX call to update status
            }
        }

        function updateEmergencyContact() {
            const newPhone = prompt('Enter new emergency contact number:');
            if (newPhone) {
                alert('Emergency contact updated to: ' + newPhone);
                // Here you would make an AJAX call to update contact
            }
        }

        function setHolidayHours() {
            alert('Holiday hours feature - would open a modal to set special timings');
            // Here you would open a modal or redirect to holiday hours page
        }

        // Form validation
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {

                if(form.id === "hourseForm")
            {
                return;
            }
               // e.preventDefault();

                // Show success message
                const existingMessage = document.querySelector('.success-message');
                if (existingMessage) {
                    existingMessage.remove();
                }

                const successMessage = document.createElement('div');
                successMessage.className = 'success-message';
                successMessage.innerHTML = '✅ Settings updated successfully!';

                form.parentNode.insertBefore(successMessage, form);

                // Scroll to top to show message
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

                // Remove message after 3 seconds
                setTimeout(() => {
                    successMessage.remove();
                }, 3000);
            });
        });

        // Time validation
        document.getElementById('openTime').addEventListener('change', function() {
            const openTime = this.value;
            const closeTimeInput = document.getElementById('closeTime');

            if (openTime && closeTimeInput.value && openTime >= closeTimeInput.value) {
                alert('Opening time must be before closing time!');
                this.value = '';
            }
        });

        document.getElementById('closeTime').addEventListener('change', function() {
            const closeTime = this.value;
            const openTimeInput = document.getElementById('openTime');

            if (closeTime && openTimeInput.value && closeTime <= openTimeInput.value) {
                alert('Closing time must be after opening time!');
                this.value = '';
            }
        });


      
        const canteenSettings = document.getElementById('canteenSettings');

        let updateButton = managerCard.querySelector('button.btn-primary');
        //let saveChangesButton = document.getElementById('canteenSettings');
        let saveChangesButton = canteenSettings.querySelector('button.btn-primary')


        updateButton.addEventListener('click', function() {
            // Simple validation
            const name = document.getElementById('managerName');
            const email = document.getElementById('managerEmail');
            const phone = document.getElementById('managerPhone');
            const experience = document.getElementById('experience');
            const address = document.getElementById('managerAddress');
            const empId = document.getElementById('employeeId');
            let inputs = managerCard.querySelectorAll('input, textarea');


            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    setErrorMessage(input, 'This field is required');
                } else {
                    removeErrorMessage(input);
                }

            });



            if (!isValidEmail(email.value.trim()) && email.value.trim()) {
                removeErrorMessage(email);
                setErrorMessage(email, 'Please enter email in correct format');
            }

            if (!isValidPhoneNumber(phone.value.trim()) && phone.value.trim()) {
                removeErrorMessage(phone);
                setErrorMessage(phone, 'Please enter phone in correct format');
            }
            // If all validations pass, submit the form
            let url = ROOT + 'CanteenController/changeCanteenDate';
            fetch(url, {
                method: 'POST',
                headers: {
                    "Content-type": "application/json"
                },
                body: JSON.stringify({
                    name: name,
                    email: email,
                    phone: phone,
                    experience: experience,
                    address: address,

                })
            })


        });







        function clearFormInput(inputs) {
            inputs.forEach(input => {
                let errorDiv = input.parentElement.querySelector('.error-message');

                errorDiv.textContent = '';
                errorDiv.classList.remove('show');
                input.classList.remove('error');
            });
        }


        function setErrorMessage(input, message) {
            let inputId = input.id;
            let errorDiv = document.getElementById(inputId + '-error');
            if (!errorDiv) return;
            errorDiv.textContent = message;
            errorDiv.classList.add('show');
            document.getElementById(inputId).classList.add('error');
            if (!input.classList.contains('error')) {
                input.classList.add('error');
            }
        }

        function removeErrorMessage(input) {
            let inputId = input.id;
            let errorDiv = document.getElementById(inputId + '-error');
            errorDiv.textContent = '';
            errorDiv.classList.remove('show');
            document.getElementById(inputId).classList.remove('error');
            if (input.classList.contains('error')) {
                input.classList.remove('error');
            }
        }

        

// -------------------------------------------
// EMAIL DOMAIN VALIDATION
// -------------------------------------------

function validateEmailDomain(email) {
    const commonDomains = ["gmail.com", "yahoo.com", "hotmail.com", "outlook.com"];

    if (!email.includes("@")) return false;

    const domain = email.split("@")[1].toLowerCase();

    // If the domain is exactly correct
    if (commonDomains.includes(domain)) {
        return true;
    }

    // Fuzzy match for typos
    return commonDomains.some(correctDomain => {
        return isCloseMatch(domain, correctDomain);
    });
}

function isCloseMatch(a, b) {
    const distance = levenshteinDistance(a, b);
    return distance <= 2; // <=2 means it's a common typo
}

function levenshteinDistance(a, b) {
    const matrix = Array.from({ length: a.length + 1 }, (_, i) =>
        Array.from({ length: b.length + 1 }, (_, j) =>
            i === 0 ? j : j === 0 ? i : 0
        )
    );

    for (let i = 1; i <= a.length; i++) {
        for (let j = 1; j <= b.length; j++) {
            const cost = a[i - 1] === b[j - 1] ? 0 : 1;
            matrix[i][j] = Math.min(
                matrix[i - 1][j] + 1,
                matrix[i][j - 1] + 1,
                matrix[i - 1][j - 1] + cost
            );
        }
    }
    return matrix[a.length][b.length];
}


// -------------------------------------------
// FORM SUBMIT + API CALL
// -------------------------------------------

document.querySelector("#canteenSettings .btn-primary").addEventListener("click", function () {

    // Clear previous error message
    document.getElementById("email-error").textContent = "";

    // Collect form values
    const data = {
        canteen_name: document.getElementById("canteenName").value.trim(),
        phone_number: document.getElementById("phoneNumber").value.trim(),
        email: document.getElementById("email").value.trim(),
        description: document.getElementById("description").value.trim()
    };

    // Validate email domain BEFORE sending API
    if (!validateEmailDomain(data.email)) {
    document.getElementById("email-domain-error").textContent =
        "Invalid or misspelled email domain (e.g., gmail.com, yahoo.com).";
    return;
}

    // Send POST request
    fetch(ROOT + "canteen/canteen_information", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(response => {

        if (response.status === "success") {
            alert("Canteen information updated successfully!");
        } else {
            alert("Failed to update: " + response.message);
        }

    })
    .catch(err => {
        console.error("Request error:", err);
        alert("Something went wrong!");
    });

});
</script>

    
</body>

</html>