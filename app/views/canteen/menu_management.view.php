<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu Management - Campus Canteen</title>
    <script>
        const ROOT = "<?= ROOT ?>";
    </script>
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/header.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/sidebar.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/student-general.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/canteen-common.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/menu-management.css">
    <link rel="stylesheet" href="/canteen-preorder-system/public/assets/css/add-item.css">
    <style>

    </style>
</head>

<body>
    <!-- Header -->
    <?php require 'header.view.php'; ?>

    <!-- Container for sidebar and main content -->
    <div class="container">
        <!-- Sidebar -->
        <?php $page = "menu_management";
        require 'sidebar.view.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Page Header -->
            <div class="page-header">
                <div class="page-header-content">
                    <h1 class="page-title">🍽️ Menu Management</h1>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="quick-actions-grid">
                <!-- Add New Item Section -->
                <div data-modal-target="#modal" class="add-item-section">
                    <a href="#" class="add-new-item-btn">
                        <span class="add-icon">➕</span>
                        <div class="add-content">
                            <h3>Add New Menu Item</h3>
                            <p>Create a new dish for your menu</p>
                        </div>
                    </a>
                </div>

                <!-- Add New Category Section -->
                <div data-modal-target="#category-modal" class="add-category-section">
                    <a href="#" class="add-new-category-btn">
                        <span class="add-icon">🏷️</span>
                        <div class="add-content">
                            <h3>Add New Category</h3>
                            <p>Create a new food category</p>
                        </div>
                    </a>
                </div>
            </div>

            <div class="modal" id="modal">
                <div class="modal-header">
                    <div class="modal-title">🍽️ Add New Menu Item</div>
                    <button data-close-button="close-button" class="close-button">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="add-item-form" method="POST" action="<?= ROOT ?>canteen/menu_management">
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="item-name">Item Name *</label>
                                <input type="text" id="item-name" name="item_name" value="chicken biriyani" class="form-input" placeholder="e.g., Chicken Biryani" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="item-price">Price (₹) *</label>
                                <input type="number" id="item-price" name="price" value="10" class="form-input" placeholder="0.00" min="0" step="0.01" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="item-description">Description</label>
                            <textarea id="item-description" name="description" class="form-textarea" placeholder="Describe your delicious dish..." rows="3">a indian food</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="item-category">Category *</label>
                                <select id="item-category" name="category" class="form-select" required>
                                    <option value="">Select Category</option>
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>"><?= ucfirst($cat['name']) ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="item-status">Availability *</label>
                                <select id="item-status" name="status" class="form-select" required>
                                    <option value="available">Available</option>
                                    <option value="unavailable">Unavailable</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="item-emoji">Food Emoji</label>
                            <input type="text" id="item-emoji" name="emoji" class="form-input" placeholder="🍛" maxlength="2">
                            <small class="form-help">Choose an emoji to represent your dish (optional)</small>
                        </div>

                        <div class="modal-actions">
                            <button type="button" class="btn btn-secondary" data-close-button="close-button">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="btn-icon">➕</span>
                                Add Menu Item
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Add Category Modal -->
            <div class="modal " id="category-modal">
                <div class="modal-header">
                    <div class="modal-title">🏷️ Add New Category</div>
                    <button data-close-button="close-button" class="close-button">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="add-item-form" method="POST" action="<?= ROOT ?>canteen/category">
                        <div class="form-group">
                            <label class="form-label" for="category-name">Category Name *</label>
                            <input type="text" id="category-name" name="category_name" class="form-input" placeholder="e.g., Appetizers, Soups, etc." required>
                        </div>

                        <div class="modal-actions">
                            <button type="button" class="btn btn-secondary" data-close-button="close-button">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="btn-icon">🏷️</span>
                                Add Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="overlay"></div>

            <!-- Search and Filter Section -->
            <!-- next task -->
            <div class="search-filter-section">
                <div class="search-filter-grid">
                    <div class="form-group">
                        <label class="form-label">Search Menu Items</label>
                        <input type="text" data-from="c" class="form-input" placeholder="Search by name or description..." id="searchInput">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Filter by Category</label>
                        <select class="form-select" id="categoryFilter">
                            <option value="">All Categories</option>
                            <option value="main-course">Main Course</option>
                            <option value="beverages">Beverages</option>
                            <option value="snacks">Snacks</option>
                            <option value="desserts">Desserts</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Filter by Status</label>
                        <select class="form-select" id="statusFilter">
                            <option value="">All Items</option>
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Current Categories Section -->
            <div class="categories-section">
                <div class="section-header">
                    <h2 class="section-title">🏷️ Current Categories</h2>
                </div>

                <div class="categories-grid">

                    <?php foreach ($categories as $category): ?>
                        <!-- Sample Categories - Replace with PHP loop -->
                        <div class="category-card">
                            <div class="category-info">
                                <h4 class="category-name"><?= ucfirst($category['name']) ?></h4>
                                <p class="category-count">12 items</p>
                            </div>
                            <div class="category-actions">
                                <button data-id="<?= $category['id'] ?>" data-modal-target="#category-items-modal" class="action-btn edit-btn category-edit">Edit</button>
                                <button class="action-btn delete-btn category-delete"> Delete</button>
                            </div>
                        </div>

                    <?php endforeach; ?>



                </div>
            </div>

            <!-- Menu Items Grid -->
            <div class="menu-grid" id="menuGrid">
                <?php foreach ($items as $item): ?>
                    <!-- Sample Menu Items -->
                    <div class="menu-card" data-name="<?= $item->name ?>" data-id="<?= $item->id ?>" data-category="main-course" data-status="available">
                        <!-- <div class="menu-card-image">
                        🍛
                        <span class="status-badge status-available">Available</span>
                    </div> -->
                        <div class="menu-card-content">
                            <h3 class="menu-item-name"><?= ucfirst($item->name) ?></h3>
                            <p class="menu-item-description"><?= $item->description ?></p>
                            <div class="menu-item-details">
                                <span class="menu-item-price">₹<?= $item->price ?></span>
                                <span class="menu-item-category">Main Course</span>
                            </div>
                            <div class="menu-item-actions">
                                <button data-modal-target="#edit-modal<?= $item->id ?>" data-action="edit" class="action-btn edit-item edit-btn"> Edit</button>
                                <?php if ($item->status == 'available'): ?>
                                    <button data-action="change-status" class="action-btn change-status edit-item disable-btn  ">Disable</button>
                                <?php else: ?>
                                    <button data-action="change-status" class="action-btn change-status edit-item enable-btn  ">Enable</button>
                                <?php endif; ?>

                                <button data-modal-target="#delete-modal<?= $item->id ?>" data-action="delete" class="action-btn delete-btn edit-item">Delete</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>


            </div>

            <!-- Empty State (hidden by default) -->
            <div class="empty-state" id="emptyState" style="display: none;">
                <div class="empty-state-icon">🍽️</div>
                <h3 class="empty-state-title">No menu items found</h3>
                <p class="empty-state-description">Try adjusting your search or filter criteria</p>
            </div>
        </div>






        <div class="modal" id="disable-modal">
            disable
        </div>

        <!-- Category Items Modal -->
        <div class="modal" id="category-items-moddal">
            <div class="modal-header">
                <div class="modal-title" id="category-items-title">📂 Category Items</div>
                <button data-close-button="close-button" class="close-button">&times;</button>
            </div>
            <div class="modal-body">
                <!-- Category name -->
                <h3 id="category-name-heading">Breakfast</h3>

                <!-- Items list -->
                <div class="menu-grid" id="category-items-list">
                    <div class="menu-card">
                        <div class="menu-card-content">
                            <h3 class="menu-item-name">Idli</h3>
                            <p class="menu-item-description">Soft steamed rice cakes served with chutney.</p>
                            <div class="menu-item-details">
                                <span class="menu-item-price">₹15</span>
                                <span class="menu-item-category">Breakfast</span>
                            </div>
                            <div class="menu-item-actions">
                                <button class="action-btn edit-btn">Edit</button>
                                <button class="action-btn disable-btn">Disable</button>
                                <button class="action-btn delete-btn">Delete</button>
                            </div>
                        </div>
                    </div>

                    <div class="menu-card">
                        <div class="menu-card-content">
                            <h3 class="menu-item-name">Masala Dosa</h3>
                            <p class="menu-item-description">Crispy dosa filled with spiced potato curry.</p>
                            <div class="menu-item-details">
                                <span class="menu-item-price">₹40</span>
                                <span class="menu-item-category">Breakfast</span>
                            </div>
                            <div class="menu-item-actions">
                                <button class="action-btn edit-btn">Edit</button>
                                <button class="action-btn disable-btn">Disable</button>
                                <button class="action-btn delete-btn">Delete</button>
                            </div>
                        </div>
                    </div>

                    <div class="menu-card">
                        <div class="menu-card-content">
                            <h3 class="menu-item-name">Poha</h3>
                            <p class="menu-item-description">Flattened rice cooked with onions, peas, and mild spices.</p>
                            <div class="menu-item-details">
                                <span class="menu-item-price">₹25</span>
                                <span class="menu-item-category">Breakfast</span>
                            </div>
                            <div class="menu-item-actions">
                                <button class="action-btn edit-btn">Edit</button>
                                <button class="action-btn disable-btn">Disable</button>
                                <button class="action-btn delete-btn">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" data-close-button="close-button">Close</button>
                </div>
            </div>
        </div>




        <div id="overlay"></div>


        <script src="/canteen-preorder-system/public/assets/js/add-item.js"></script>

        <script>
            let categories = <?= json_encode($categories) ?>;

            searchItemsFilter();

            actionButtons();

            function actionButtons() {

                let mainContent = document.querySelector('.main-content');
                mainContent.addEventListener("click", e => {
                    if (e.target.classList.contains('edit-item')) {

                        let actionBtn = e.target;

                        let menuCard = actionBtn.parentElement.parentElement.parentElement;
                        if (actionBtn.dataset.action == "edit") {
                            console.log("pressed edit");
                            editItem(menuCard)
                        }

                        if (actionBtn.dataset.action == "change-status") {
                            console.log("pressed disable");
                            updateItemStatus(actionBtn, menuCard)
                        }

                        if (actionBtn.dataset.action == "delete") {
                            console.log("pressed delete");
                            deleteItem(menuCard)
                        }


                    }
                })
            }


            function editItem(menuCard) {
                const itemId = menuCard.dataset.id;
                const itemName = menuCard.dataset.name;
                if (!document.getElementById('edit-modal' + itemId)) {
                    let div = document.createElement('div');
                    div.classList.add('modal');
                    div.id = "edit-modal" + itemId;
                    div.innerHTML = `
                     <div class="modal-header">
                    <div class="modal-title">Edit Item</div>
                    <button data-close-button="close-button" class="close-button">&times;</button>
                </div>
    
                <div class="modal-body">
                    <form action="${ROOT}canteen/edit_item" method="post">
                        <div class="form-group">
    
                            <input type="text" id="item-name" class="form-input" name="item-name" placeholder="Change Name">
                        </div>
                        <div class="form-group">
    
                            <input type="text" id="item-price" class="form-input" name="price" placeholder="Change Price">
                        </div>
    
                        <div class="form-group">
    
                            <input type="text" id="item-description" class="form-input" name="description" placeholder="Change Description">
                        </div>

    
                    
                        <input type="hidden" name="item_id" value="${itemId}">
                         <div class="modal-actions">
                            <button type="button" class="btn btn-secondary" data-close-button="close-button">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="btn-icon">🏷️</span>
                                Submit
                            </button>
                        </div>

                    </form>
                </div>
                `;

                    document.body.append(div);
                    console.log(div);
                    openModal(div);
                } else {
                    let div = document.getElementById('edit-modal' + itemId);
                    openModal(div);
                }




                const closeModalButton = document.querySelectorAll('[data-close-button]');

                closeModalButton.forEach(button => {

                    button.addEventListener('click', () => {

                        const modal = button.closest('.modal');
                        closeModal(modal);
                    })
                })
            };

            function updateItemStatus(actionBtn, menuCard) {
                const itemId = menuCard.dataset.id;
                // const action = menuCard.dataset.action;
                const url = ROOT + 'api/changeStatusItem';
                fetch(url, {
                        method: 'POST',
                        headers: {
                            "Content-type": "application/json"
                        },
                        body: JSON.stringify({
                            item_id: itemId,
                            // action: action
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            console.log(data);
                            let newStatus = data.newStatus;
                            if (newStatus == 'available') {
                                actionBtn.classList.remove('enable-btn');
                                actionBtn.classList.add('disable-btn');
                                actionBtn.textContent = 'Disable';
                            } else {
                                actionBtn.classList.remove('disable-btn');
                                actionBtn.classList.add('enable-btn');
                                actionBtn.textContent = 'Enable';
                            }

                        }
                    })


            };

            function deleteItem(menuCard) {
                console.log(menuCard);
                const itemId = menuCard.dataset.id;
                if (!document.getElementById('delete-modal' + itemId)) {

                    let div = document.createElement('div');
                    div.classList.add('modal');
                    div.id = 'delete-modal' + itemId;
                    div.innerHTML = `
                         <div class="modal-header">
                    <div class="modal-title">⚠️ Confirm Deletion of item with id ${itemId}</div>
                    <button data-close-button="close-button" class="close-button">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this item? This action cannot be undone.</p>
    
                    <div class="modal-actions">
                        <button type="button" class="btn btn-secondary" data-close-button="close-button">Cancel</button>
                        <button data-id="${itemId}" type="button" id="confirm-delete-btn" class="btn btn-danger">
                            <span class="btn-icon">🗑️</span>
                            Delete Item
                        </button>
                    </div>
                </div>
                    `;
                    document.body.append(div);
                    openModal(div);


                    const closeModalButton = document.querySelectorAll('[data-close-button]');

                    closeModalButton.forEach(button => {

                        button.addEventListener('click', () => {

                            const modal = button.closest('.modal');
                            closeModal(modal);
                        })
                    })
                } else {
                    const div = document.getElementById('delete-modal' + itemId);
                    openModal(div);
                }

                setListenerForDeleteItem();
            }

            function searchItemsFilter() {
                const formInput = document.getElementById('searchInput');
                console.log(formInput);

                formInput.addEventListener('input', function() {
                    let from = this.dataset.from;
                    let word = this.value;
                    const url = ROOT + 'api/getItems';
                    if (word === '') {
                        location.reload();
                        return;
                    }

                    let tMenuGrid = document.querySelector('.menu-grid');
                    const menuGrid = tMenuGrid;
                    let catSec = document.querySelector('.categories-section');
                    let parent = tMenuGrid.parentNode;



                    tMenuGrid.remove();



                    parent.insertBefore(menuGrid, catSec);

                    fetch(url, {
                            method: "POST",
                            headers: {
                                "Content-type": "application/json"
                            },
                            body: JSON.stringify({
                                word: word,
                                from: from
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                console.log(data);

                                menuGrid.innerHTML = '';

                                console.log(menuGrid);

                                data.items.forEach(item => {


                                    let menuCardDiv = document.createElement('div');
                                    menuCardDiv.classList.add('menu-card');
                                    menuCardDiv.dataset.category = "main-course";
                                    menuCardDiv.dataset.status = "available";
                                    menuCardDiv.dataset.id = item.id;
                                    menuCardDiv.dataset.name = item.name;



                                    menuCardDiv.innerHTML = `
                                <div class="menu-card-content">
                                       <h3 class="menu-item-name">${item.name}</h3>
                                <p class="menu-item-description">${item.description}</p>
                                <div class="menu-item-details">
                                    <span class="menu-item-price">₹${item.price}</span>
                                    <span class="menu-item-category">Main Course</span>
                                </div>
                                <div class="menu-item-actions">
                                    <button data-modal-target="#edit-modal${item.id}" data-action="edit" class="action-btn edit-btn"> Edit</button>
                                    <button class="action-btn toggle-btn available">Disable</button>
                                    <button data-modal-target="#delete-modal${item.id}" data-action="delete" class="action-btn delete-btn edit-item">Delete</button>
                                </div>
                                 </div>
                                `;
                                    console.log(menuCardDiv);

                                    menuGrid.append(menuCardDiv);
                                    setListenerForEditButton();


                                })

                            }
                        })


                })
            }

            function setListenerForDeleteItem() {
                let confirmDeleteButtons = document.querySelectorAll('#confirm-delete-btn');
                confirmDeleteButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const itemId = button.dataset.id;
                        const url = ROOT + 'ItemController/delete';
                        fetch(url, {
                                method: 'POST',
                                headers: {
                                    "Content-type": 'application/json'
                                },
                                body: JSON.stringify({
                                    item_id: itemId
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                console.log(data);
                            })

                    })
                })
            }


            let categoryEditButtons = document.querySelectorAll('.category-edit');
            categoryEditButtons.forEach(button => {
                button.addEventListener("click", function() {
                    const id = button.dataset.id;
                    const url = ROOT + 'ItemController/category';
                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-type': 'application/json'
                            },
                            body: JSON.stringify({
                                category_id: id
                            })


                        })
                        .then(res => res.json())
                        .then(data => {
                            console.log(data);
                        })
                })
            })
        </script>


</body>

</html>