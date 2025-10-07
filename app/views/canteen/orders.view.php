<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Orders Management - Campus Canteen</title>
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/canteen-common.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/orders.css">
    <script>
        const ROOT = "<?= ROOT ?>";
    </script>

</head>

<body>
    <!-- Header -->
    <?php require 'header.view.php'; ?>

    <!-- Container for sidebar and main content -->
    <div class="container">
        <!-- Sidebar -->
        <?php $page = "orders";
        require 'sidebar.view.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Orders Header -->
            <div class="orders-header">
                <h1 class="orders-title">
                    📋 Orders Management
                </h1>
                <div class="orders-actions">
                    <a href="#" class="export-btn">
                        📊 Export CSV
                    </a>
                    <button class="refresh-btn">
                        🔄 Refresh
                    </button>
                </div>
            </div>

            <!-- Orders Tabs -->
            <div class="orders-tabs">
                <button class="tab-btn active" data-tab="active-orders">
                    🔄 Active Orders
                </button>
                <!-- <button class="tab-btn" data-tab="order-history">
                    📊 Order History
                </button> -->
            </div>

            <!-- Active Orders Tab Content -->
            <div id="active-orders" class="tab-content active">
                <!-- Stats Summary -->
                <div class="stats-summary">
                    <div class="stat-summary-card stat-pending">
                        <div class="stat-summary-value"><?= $pending_orders ?></div>
                        <div class="stat-summary-label">Pending Orders</div>
                    </div>
                    <div class="stat-summary-card stat-accepted">
                        <div class="stat-summary-value"><?= $accepted_orders ?></div>
                        <div class="stat-summary-label">Accepted Orders</div>
                    </div>
                    <div class="stat-summary-card stat-ready">
                        <div class="stat-summary-value"><?= $ready_orders ?></div>
                        <div class="stat-summary-label">Ready Orders</div>
                    </div>
                    <div class="stat-summary-card stat-completed">
                        <div class="stat-summary-value"><?= $ready_orders ?></div>
                        <div class="stat-summary-label">Completed Today</div>
                    </div>
                    <div class="stat-summary-card stat-rejected">
                        <div class="stat-summary-value"><?= $ready_orders ?></div>
                        <div class="stat-summary-label">Rejected Orders</div>
                    </div>
                </div>

                <!-- Filters Section -->
                <div class="filters-section">
                    <div class="filters-grid">
                        <!-- <div class="form-group">
                            <label class="form-label">Search Orders</label>
                            <input data-type="search" type="text" class="form-input" placeholder="Search by order ID, student name, or email..." id="searchInput">
                        </div> -->
                        <div class="form-group">
                            <label class="form-label">Status Filter</label>
                            <select data-type="status" class="form-select" id="statusFilter">
                                <option value="">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="accepted">Accepted</option>
                                <option value="ready">Ready</option>
                                <option value="completed">Completed</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">From Date</label>
                            <input data-type="fromDate" type="date" class="form-input" id="fromDate">
                        </div>
                        <div class="form-group">
                            <label class="form-label">To Date</label>
                            <input data-type="toDate" type="date" class="form-input" id="toDate">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Sort By</label>
                            <select data-type="sort" class="form-select" id="sortBy">
                                <option value="">Select</option>
                                <option value="desc">Newest First</option>
                                <option value="asc">Oldest First</option>
                                <option value="total">Amount (High to Low)</option>

                            </select>
                        </div>
                    </div>
                </div>

                <!-- Bulk Actions -->
                <div class="bulk-actions">
                    <div class="bulk-actions-left">
                        <label class="bulk-select-all">
                            <input type="checkbox" id="selectAll"> Select All Visible
                        </label>
                        <span id="selectedCount">0 selected</span>
                    </div>
                    <div class="bulk-actions-buttons">
                        <button data-type="accepted" class="bulk-btn bulk-accept">✅ Accept Selected</button>
                        <button data-type="ready" class="bulk-btn bulk-complete">🍽️ Mark Ready</button>
                        <button data-type="rejected" class="bulk-btn bulk-reject">❌ Reject Selected</button>
                    </div>
                </div>

                <!-- Orders Table -->
                <div class="orders-table-container">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th width="40">
                                    <input type="checkbox" class="order-checkbox" id="selectAllHeader">
                                </th>
                                <th>Order ID</th>
                                <th>Student</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Time</th>
                                <th>Status</th>
                                <!-- <th>Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Sample Orders - Replace with PHP loop -->


                            <?php foreach ($orders as $order_id => $items): ?>
                                <?php $dateStr = $items[0]->time;
                                $date = new DateTime($dateStr);
                                $time = $date->format('g:i A');
                                ?>
                                <tr>
                                    <td>
                                        <input type="checkbox" class="order-checkbox" data-order-id="<?= $order_id ?>">
                                    </td>
                                    <td><span class="order-id">#<?= $order_id ?></span></td>
                                    <td>
                                        <div class="student-info">
                                            <span class="student-name"><?= $items[0]->email ?></span>
                                            <span class="student-email"><?= $items[0]->email ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="order-items-list">
                                            <?php foreach ($items as $item): ?>
                                                <div class="order-item">
                                                    <span class="item-name"><?= ucfirst($item->name) ?></span>
                                                    <span class="item-quantity">x<?= $item->quantity ?></span>
                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                    </td>
                                    <td><span class="order-total">₹1<?= $items[0]->total ?></span></td>
                                    <td>
                                        <div class="order-time-info">
                                            <span class="order-time"><?= $time ?></span>
                                            <span class="order-date">Today</span>
                                        </div>
                                    </td>
                                    <td>
                                        <select data-id='<?= $order_id ?>' class="status-select <?= $items[0]->status ?>">
                                            <option value="pending" <?php if ($items[0]->status == 'pending') {
                                                                        echo 'selected';
                                                                    } ?>>Pending</option>
                                            <option value="accepted" <?php if ($items[0]->status == 'accepted') {
                                                                            echo 'selected';
                                                                        } ?>>Accepted</option>
                                            <option value="completed" <?php if ($items[0]->status == 'completed') {
                                                                            echo 'selected';
                                                                        } ?>>Completed</option>
                                            <option value="ready" <?php if ($items[0]->status == 'ready') {
                                                                        echo 'selected';
                                                                    } ?>>Ready</option>
                                            <option value="rejected" <?php if ($items[0]->status == 'rejected') {
                                                                            echo 'selected';
                                                                        } ?>>Rejected</option>
                                        </select>
                                    </td>
                                    <!-- <td>
                                        <div class="order-actions">
                                            <button class="order-action-btn view-details-btn">👁️ Details</button>
                                        </div>
                                    </td> -->
                                </tr>

                            <?php endforeach; ?>






                        </tbody>
                    </table>

                    <!-- Pagination with Horizontal Scroll -->
                    <!-- <div class="pagination">
                        <button class="page-btn nav-btn" id="prevBtn">Previous</button>
                        <div class="page-numbers-container">
                            <div class="page-numbers" id="pageNumbers">
                                <button class="page-btn active">1</button>
                                <button class="page-btn">2</button>
                                <button class="page-btn">3</button>
                                <button class="page-btn">4</button>
                                <button class="page-btn">5</button>
                                <button class="page-btn">6</button>
                                <button class="page-btn">7</button>
                                <button class="page-btn">8</button>
                                <button class="page-btn">9</button>
                                <button class="page-btn">10</button>
                            </div>
                        </div>
                        <button class="page-btn nav-btn" id="nextBtn">Next</button>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- Order History Tab Content -->

    </div>

    <div id="testing"></div>
    <script src="<?= ROOT ?>assets/js/canteen-dashboard.js"></script>

    <script src="<?= ROOT ?>assets/js/orders.js">
    </script>
</body>

</html>
<script>
    // Horizontal Scrolling Pagination JavaScript for Canteen Orders
    document.addEventListener('DOMContentLoaded', function() {
        const pageNumbersContainer = document.querySelector('.page-numbers-container');
        const prevBtn = document.querySelector('#prevBtn');
        const nextBtn = document.querySelector('#nextBtn');
        const paginationBtns = document.querySelectorAll('.page-btn:not(.nav-btn)');

        let currentPage = 1;
        const totalOrders = 47;
        const itemsPerPage = 10;
        const totalPages = Math.ceil(totalOrders / itemsPerPage);

        // Handle page number clicks
        paginationBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                if (!this.classList.contains('nav-btn')) {
                    // Remove active class from all buttons
                    paginationBtns.forEach(b => b.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');

                    currentPage = parseInt(this.textContent);
                    updatePaginationState();

                    // Scroll the clicked button into view
                    this.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });
                }
            });
        });

        // Handle Previous button
        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    updateActivePage();
                    updatePaginationState();
                    scrollToActivePage();
                }
            });
        }

        // Handle Next button
        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    updateActivePage();
                    updatePaginationState();
                    scrollToActivePage();
                }
            });
        }

        // Update active page button
        function updateActivePage() {
            paginationBtns.forEach(btn => {
                btn.classList.remove('active');
                if (parseInt(btn.textContent) === currentPage) {
                    btn.classList.add('active');
                }
            });
        }

        // Update pagination state (enable/disable prev/next buttons)
        function updatePaginationState() {
            if (prevBtn) prevBtn.disabled = currentPage === 1;
            if (nextBtn) nextBtn.disabled = currentPage >= totalPages;
        }

        // Scroll active page into view
        function scrollToActivePage() {
            const activeBtn = document.querySelector('.page-btn.active:not(.nav-btn)');
            if (activeBtn) {
                activeBtn.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'center'
                });
            }
        }

        // Mouse wheel scrolling for page numbers
        if (pageNumbersContainer) {
            pageNumbersContainer.addEventListener('wheel', function(e) {
                e.preventDefault();
                this.scrollLeft += e.deltaY;
            });

            // Touch scrolling for mobile
            let isScrolling = false;
            let startX = 0;
            let scrollLeft = 0;

            pageNumbersContainer.addEventListener('touchstart', function(e) {
                isScrolling = true;
                startX = e.touches[0].pageX - this.offsetLeft;
                scrollLeft = this.scrollLeft;
            });

            pageNumbersContainer.addEventListener('touchmove', function(e) {
                if (!isScrolling) return;
                e.preventDefault();
                const x = e.touches[0].pageX - this.offsetLeft;
                const walk = (x - startX) * 2;
                this.scrollLeft = scrollLeft - walk;
            });

            pageNumbersContainer.addEventListener('touchend', function() {
                isScrolling = false;
            });
        }

        // Initialize pagination state
        updatePaginationState();



        function updatePaginationNumbers(totalPages) {
            // Get the page numbers container
            const pageNumbersContainer = document.querySelector('.page-numbers');

            if (!pageNumbersContainer) {
                console.error('Page numbers container not found');
                return;
            }

            // Clear existing page buttons
            pageNumbersContainer.innerHTML = '';

            // Create new page buttons based on totalPages parameter
            for (let i = 1; i <= totalPages; i++) {
                const pageBtn = document.createElement('button');
                pageBtn.className = 'page-btn';
                pageBtn.textContent = i;
                pageBtn.dataset.page = i;

                // Set first page as active by default
                if (i === 1) {
                    pageBtn.classList.add('active');
                }

                // Add click event listener for each button
                pageBtn.addEventListener('click', function() {
                    // Remove active class from all page buttons
                    document.querySelectorAll('.page-btn').forEach(btn => {
                        btn.classList.remove('active');
                    });

                    // Add active class to clicked button
                    this.classList.add('active');

                    // Update current page
                    currentPage = parseInt(this.dataset.page);

                    // Trigger any pagination logic here
                    // Example: loadOrdersForPage(currentPage);

                    // Scroll clicked button into view
                    this.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });
                });

                // Append to container
                pageNumbersContainer.appendChild(pageBtn);
            }

            // Update navigation button states
            updateNavigationButtons(totalPages);

            console.log(`Pagination updated: ${totalPages} pages created`);
        }

        // Helper function to update Previous/Next button states
        function updateNavigationButtons(totalPages) {
            const prevBtn = document.querySelector('#prevBtn, .prev-btn');
            const nextBtn = document.querySelector('#nextBtn, .next-btn');

            if (prevBtn) {
                prevBtn.disabled = currentPage === 1;
            }

            if (nextBtn) {
                nextBtn.disabled = currentPage >= totalPages;
            }
        }

        // Usage examples:
        // updatePaginationNumbers(5);   // Creates 5 page buttons (1, 2, 3, 4, 5)
        // updatePaginationNumbers(10);  // Creates 10 page buttons (1, 2, 3, ..., 10)
        // updatePaginationNumbers(25);  // Creates 25 page buttons (1, 2, 3, ..., 25)
    });
</script>