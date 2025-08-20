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
            <div class="quick-actions">
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
            </div>


            <!-- Current Status -->
            <div class="current-info">
                <h4>Current Status</h4>
                <div class="status-indicator status-open">
                    🟢 Currently Open
                </div>
                <p><strong>Manager:</strong> John Smith</p>
                <p><strong>Phone:</strong> +1 (555) 123-4567</p>
                <p><strong>Hours:</strong> 8:00 AM - 8:00 PM (Mon-Fri)</p>
                <p><strong>Last Updated:</strong> March 15, 2024</p>
            </div>


            <!-- Settings Forms -->
            <div class="settings-container">
                <!-- Basic Information -->
                <div class="settings-card">
                    <h3>🏪 Basic Information</h3>

                    <form method="POST" action="<?= ROOT ?>canteen/settings">
                        <div class="form-group">
                            <label for="canteenName">Canteen Name</label>
                            <input type="text" id="canteenName" name="canteen_name" value="Main Campus Cafeteria" required>
                        </div>

                        <div class="form-group">
                            <label for="managerName">Manager Name</label>
                            <input type="text" id="managerName" name="manager_name" value="John Smith" required>
                        </div>

                        <div class="form-group">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="tel" id="phoneNumber" name="phone_number" value="+1 (555) 123-4567" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="canteen@college.edu" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="description" name="description" placeholder="Brief description of your canteen...">Serving fresh and delicious meals to students and staff. We offer a variety of cuisines including Indian, Continental, and Chinese dishes.</textarea>
                        </div>

                        <div class="form-actions">
                            <button type="button" class="btn-secondary">Cancel</button>
                            <button type="submit" class="btn-primary">
                                💾 Save Changes
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Operating Hours -->
                <div class="settings-card">
                    <h3>🕒 Operating Hours</h3>

                    <form method="POST" action="<?= ROOT ?>canteen/update-hours">
                        <div class="form-group">
                            <label>Operating Days</label>
                            <div class="days-selector">
                                <div class="day-checkbox">
                                    <input type="checkbox" id="monday" name="days[]" value="monday" checked>
                                    <label for="monday">Mon</label>
                                </div>
                                <div class="day-checkbox">
                                    <input type="checkbox" id="tuesday" name="days[]" value="tuesday" checked>
                                    <label for="tuesday">Tue</label>
                                </div>
                                <div class="day-checkbox">
                                    <input type="checkbox" id="wednesday" name="days[]" value="wednesday" checked>
                                    <label for="wednesday">Wed</label>
                                </div>
                                <div class="day-checkbox">
                                    <input type="checkbox" id="thursday" name="days[]" value="thursday" checked>
                                    <label for="thursday">Thu</label>
                                </div>
                                <div class="day-checkbox">
                                    <input type="checkbox" id="friday" name="days[]" value="friday" checked>
                                    <label for="friday">Fri</label>
                                </div>
                                <div class="day-checkbox">
                                    <input type="checkbox" id="saturday" name="days[]" value="saturday">
                                    <label for="saturday">Sat</label>
                                </div>
                                <div class="day-checkbox">
                                    <input type="checkbox" id="sunday" name="days[]" value="sunday">
                                    <label for="sunday">Sun</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="openTime">Opening Time</label>
                                <input type="time" id="openTime" name="open_time" value="08:00" required>
                            </div>
                            <div class="form-group">
                                <label for="closeTime">Closing Time</label>
                                <input type="time" id="closeTime" name="close_time" value="20:00" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="breakTime">Break Time (Optional)</label>
                            <div class="time-inputs">
                                <input type="time" name="break_start" placeholder="Break Start" value="14:00">
                                <input type="time" name="break_end" placeholder="Break End" value="15:00">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="specialHours">Special Hours/Notes</label>
                            <textarea id="specialHours" name="special_hours" placeholder="Any special timing notes...">Closed on public holidays. Extended hours during exam periods.</textarea>
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
            <div class="settings-card">
                <h3>🔧 Additional Settings</h3>

                <form method="POST" action="<?= ROOT ?>canteen/advanced-settings">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="maxOrders">Max Orders Per Hour</label>
                            <input type="number" id="maxOrders" name="max_orders" value="50" min="1">
                        </div>
                        <div class="form-group">
                            <label for="prepTime">Average Prep Time (minutes)</label>
                            <input type="number" id="prepTime" name="prep_time" value="15" min="1">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="minOrder">Minimum Order Amount</label>
                            <input type="number" id="minOrder" name="min_order" value="50" min="0" step="0.01">
                        </div>
                        <div class="form-group">
                            <label for="deliveryCharge">Delivery Charge</label>
                            <input type="number" id="deliveryCharge" name="delivery_charge" value="10" min="0" step="0.01">
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
            </div>
        </div>
    </div>

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
                e.preventDefault();

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
    </script>
</body>

</html>