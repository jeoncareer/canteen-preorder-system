// Simple Tab Switching Function
function switchTab(tabName) {
  console.log("Switching to tab:", tabName);

  // Hide all tab contents
  const allTabs = document.querySelectorAll(".tab-content");
  allTabs.forEach((tab) => {
    tab.classList.remove("active");
    tab.style.display = "none";
  });

  // Remove active class from all tab buttons
  const allButtons = document.querySelectorAll(".tab-btn");
  allButtons.forEach((btn) => btn.classList.remove("active"));

  // Show target tab content
  const targetTab = document.getElementById(tabName);
  if (targetTab) {
    targetTab.classList.add("active");
    targetTab.style.display = "block";
  }

  // Activate clicked button
  const targetButton = document.querySelector(`[data-tab="${tabName}"]`);
  if (targetButton) {
    targetButton.classList.add("active");
  }

  console.log("Tab switched successfully to:", tabName);
}

// Initialize tabs when page loads
document.addEventListener("DOMContentLoaded", function () {
  console.log("Initializing tab system...");

  // Add click listeners to tab buttons
  const tabButtons = document.querySelectorAll(".tab-btn");
  tabButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const tabName = this.getAttribute("data-tab");
      switchTab(tabName);
    });
  });

  // Make sure active orders tab is shown by default
  switchTab("active-orders");

  console.log("Tab system initialized");

  // Initialize pagination
  initializePagination();
  initializeHorizontalScroll();

  // Initialize status select dropdowns
  initializeStatusSelects();

  // History Filter Functionality
  const historyFilters = document.querySelectorAll(
    "#order-history .form-input, #order-history .form-select"
  );
  const applyFiltersBtn = document.querySelector(".apply-filters");
  const clearFiltersBtn = document.querySelector(".clear-filters");
  const exportFilteredBtn = document.querySelector(".export-filtered");

  // Apply Filters
  if (applyFiltersBtn) {
    applyFiltersBtn.addEventListener("click", function () {
      const searchValue = document.getElementById("historySearchInput").value;
      const statusValue = document.getElementById("historyStatusFilter").value;
      const dateRangeValue = document.getElementById("dateRangeFilter").value;
      const fromDateValue = document.getElementById("historyFromDate").value;
      const toDateValue = document.getElementById("historyToDate").value;
      const sortValue = document.getElementById("historySortBy").value;

      console.log("Applying filters:", {
        search: searchValue,
        status: statusValue,
        dateRange: dateRangeValue,
        fromDate: fromDateValue,
        toDate: toDateValue,
        sort: sortValue,
      });

      // Here you would normally make an API call to filter the data
      // For now, just show a message
      alert("Filters applied! (This is a demo - backend integration needed)");
    });
  }

  // Clear Filters
  if (clearFiltersBtn) {
    clearFiltersBtn.addEventListener("click", function () {
      document.getElementById("historySearchInput").value = "";
      document.getElementById("historyStatusFilter").value = "";
      document.getElementById("dateRangeFilter").value = "";
      document.getElementById("historyFromDate").value = "";
      document.getElementById("historyToDate").value = "";
      document.getElementById("historySortBy").value = "date_desc";

      console.log("Filters cleared");
      alert("All filters cleared!");
    });
  }

  // Export Filtered Data
  if (exportFilteredBtn) {
    exportFilteredBtn.addEventListener("click", function () {
      console.log("Exporting filtered data...");
      alert(
        "Export functionality will be implemented with backend integration"
      );
    });
  }

  // Date Range Filter Change Handler
  const dateRangeFilter = document.getElementById("dateRangeFilter");
  const customDateInputs = document.querySelectorAll(
    "#historyFromDate, #historyToDate"
  );

  if (dateRangeFilter) {
    dateRangeFilter.addEventListener("change", function () {
      if (this.value === "custom") {
        customDateInputs.forEach((input) => {
          input.style.display = "block";
          input.required = true;
        });
      } else {
        customDateInputs.forEach((input) => {
          input.style.display = "none";
          input.required = false;
          input.value = "";
        });
      }
    });
  }

  // Action Button Handlers for History Table
  document.addEventListener("click", function (event) {
    if (event.target.classList.contains("view-details-btn")) {
      const orderId = event.target
        .closest("tr")
        .querySelector(".order-id").textContent;
      console.log("Viewing details for order:", orderId);
      alert(`Viewing details for order ${orderId}`);
    }

    if (event.target.classList.contains("print-btn")) {
      const orderId = event.target
        .closest("tr")
        .querySelector(".order-id").textContent;
      console.log("Printing order:", orderId);
      alert(`Printing order ${orderId}`);
    }

    if (event.target.classList.contains("refund-btn")) {
      const orderId = event.target
        .closest("tr")
        .querySelector(".order-id").textContent;
      console.log("Processing refund for order:", orderId);
      if (
        confirm(`Are you sure you want to process refund for order ${orderId}?`)
      ) {
        alert(`Refund processed for order ${orderId}`);
      }
    }
  });
});
// Pagination Functionality
let currentActivePage = 1;
let currentHistoryPage = 1;
const itemsPerPage = 5;

function initializePagination() {
  console.log("Initializing pagination...");

  // Active Orders Pagination
  const activePrevBtn = document.getElementById("activePrevBtn");
  const activeNextBtn = document.getElementById("activeNextBtn");
  const activePageNumbers = document.querySelectorAll(
    "#activePageNumbers .page-btn"
  );

  // History Orders Pagination
  const historyPrevBtn = document.getElementById("historyPrevBtn");
  const historyNextBtn = document.getElementById("historyNextBtn");
  const historyPageNumbers = document.querySelectorAll(
    "#historyPageNumbers .page-btn"
  );

  // Active Orders Pagination Events
  if (activePrevBtn) {
    activePrevBtn.addEventListener("click", function () {
      if (currentActivePage > 1) {
        currentActivePage--;
        updateActivePagination();
      }
    });
  }

  if (activeNextBtn) {
    activeNextBtn.addEventListener("click", function () {
      if (currentActivePage < 5) {
        // Assuming 5 pages max
        currentActivePage++;
        updateActivePagination();
      }
    });
  }

  // Active page number clicks
  activePageNumbers.forEach((btn) => {
    btn.addEventListener("click", function () {
      currentActivePage = parseInt(this.dataset.page);
      updateActivePagination();
    });
  });

  // History Orders Pagination Events
  if (historyPrevBtn) {
    historyPrevBtn.addEventListener("click", function () {
      if (currentHistoryPage > 1) {
        currentHistoryPage--;
        updateHistoryPagination();
      }
    });
  }

  if (historyNextBtn) {
    historyNextBtn.addEventListener("click", function () {
      if (currentHistoryPage < 8) {
        // Assuming 8 pages max
        currentHistoryPage++;
        updateHistoryPagination();
      }
    });
  }

  // History page number clicks
  historyPageNumbers.forEach((btn) => {
    btn.addEventListener("click", function () {
      currentHistoryPage = parseInt(this.dataset.page);
      updateHistoryPagination();
    });
  });

  // Initialize pagination states
  updateActivePagination();
  updateHistoryPagination();
}

function updateActivePagination() {
  console.log("Updating active orders pagination - Page:", currentActivePage);

  // Update page number buttons
  const activePageNumbers = document.querySelectorAll(
    "#activePageNumbers .page-btn"
  );
  activePageNumbers.forEach((btn) => {
    btn.classList.remove("active");
    if (parseInt(btn.dataset.page) === currentActivePage) {
      btn.classList.add("active");
    }
  });

  // Update prev/next button states
  const activePrevBtn = document.getElementById("activePrevBtn");
  const activeNextBtn = document.getElementById("activeNextBtn");

  if (activePrevBtn) {
    activePrevBtn.disabled = currentActivePage === 1;
  }

  if (activeNextBtn) {
    activeNextBtn.disabled = currentActivePage === 5;
  }

  // Simulate loading different data (in real app, this would fetch from API)
  showActiveOrdersPage(currentActivePage);
}

function updateHistoryPagination() {
  console.log("Updating history orders pagination - Page:", currentHistoryPage);

  // Update page number buttons
  const historyPageNumbers = document.querySelectorAll(
    "#historyPageNumbers .page-btn"
  );
  historyPageNumbers.forEach((btn) => {
    btn.classList.remove("active");
    if (parseInt(btn.dataset.page) === currentHistoryPage) {
      btn.classList.add("active");
    }
  });

  // Update prev/next button states
  const historyPrevBtn = document.getElementById("historyPrevBtn");
  const historyNextBtn = document.getElementById("historyNextBtn");

  if (historyPrevBtn) {
    historyPrevBtn.disabled = currentHistoryPage === 1;
  }

  if (historyNextBtn) {
    historyNextBtn.disabled = currentHistoryPage === 8;
  }

  // Simulate loading different data (in real app, this would fetch from API)
  showHistoryOrdersPage(currentHistoryPage);
}

function showActiveOrdersPage(page) {
  // This is a demo function - in real app, you'd fetch data from API
  console.log(`Loading active orders page ${page}`);

  // You could hide/show different rows based on page
  // For now, just show a message in console
  const message = `Showing active orders page ${page} (Items ${
    (page - 1) * itemsPerPage + 1
  }-${page * itemsPerPage})`;
  console.log(message);
}

function showHistoryOrdersPage(page) {
  // This is a demo function - in real app, you'd fetch data from API
  console.log(`Loading history orders page ${page}`);

  // You could hide/show different rows based on page
  // For now, just show a message in console
  const message = `Showing history orders page ${page} (Items ${
    (page - 1) * itemsPerPage + 1
  }-${page * itemsPerPage})`;
  console.log(message);
}

// Horizontal scrolling for page numbers
function initializeHorizontalScroll() {
  const pageContainers = document.querySelectorAll(".page-numbers-container");

  pageContainers.forEach((container) => {
    // Mouse wheel scrolling
    container.addEventListener("wheel", function (e) {
      e.preventDefault();
      this.scrollLeft += e.deltaY;
    });

    // Touch scrolling for mobile
    let isScrolling = false;
    let startX = 0;
    let scrollLeft = 0;

    container.addEventListener("touchstart", function (e) {
      isScrolling = true;
      startX = e.touches[0].pageX - this.offsetLeft;
      scrollLeft = this.scrollLeft;
    });

    container.addEventListener("touchmove", function (e) {
      if (!isScrolling) return;
      e.preventDefault();
      const x = e.touches[0].pageX - this.offsetLeft;
      const walk = (x - startX) * 2;
      this.scrollLeft = scrollLeft - walk;
    });

    container.addEventListener("touchend", function () {
      isScrolling = false;
    });
  });
}
// Status Change Functionality
function initializeStatusSelects() {
  let statusSelects = document.querySelectorAll(".status-select");
  statusSelects.forEach((select) => {
    select.addEventListener("change", function () {
      let orderId = this.getAttribute("data-order-id");
      let newStatus = this.value;
      this.className = "status-select " + newStatus;
      updateOrderStatus(orderId, newStatus);
    });
  });
}

// Function to simulate API call for status update
function updateOrderStatus(orderId, newStatus) {
  console.log(`Making API call to update order ${orderId} to ${newStatus}`);

  // Simulate API call
  const url = ROOT + "OrdersController/updateOrderStatus";
  const data = {
    order_id: orderId,
    new_status: newStatus,
  };

  fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        console.log("Status updated successfully");
        alert(`Order ${orderId} status updated to ${newStatus}`);
      } else {
        console.error("Failed to update status");
        alert("Failed to update order status. Please try again.");
      }
    })
    .catch((error) => {
      console.error("Error updating status:", error);
      alert("Error updating order status. Please try again.");
    });
}
