

            searchItemsFilter();

            actionButtons();
            setListenerForDeleteItem();

            function actionButtons() {

                let mainContent = document.querySelector('.main-content');
                mainContent.addEventListener("click", e => {
                    if (e.target.classList.contains('edit-item')) {

                        let actionBtn = e.target;

                        let menuCard = actionBtn.closest('.menu-card');
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


               
                } else {
                    const div = document.getElementById('delete-modal' + itemId);
                    openModal(div);
                }

               
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
                                    <button data-modal-target="#edit-modal${item.id}" data-action="edit" class="action-btn edit-btn edit-item"> Edit</button>
                                    <button data-action="change-status" class="action-btn toggle-btn edit-item available">Disable</button>
                                    <button data-modal-target="#delete-modal${item.id}" data-action="delete" class="action-btn delete-btn edit-item">Delete</button>
                                </div>
                                 </div>
                                `;
                                    console.log(menuCardDiv);

                                    menuGrid.append(menuCardDiv);
                                    // setListenerForEditButton();


                                })

                            }
                        })


                })
            }

            function setListenerForDeleteItem() {

                document.body.addEventListener('click',e => {
                    if(e.target.matches('#confirm-delete-btn')){
                        console.log('confirm delete button');
                        let button = e.target;
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
                    }
                })

                // let confirmDeleteButtons = document.querySelectorAll('#confirm-delete-btn');
                // confirmDeleteButtons.forEach(button => {
                //     button.addEventListener('click', function() {
                //         const itemId = button.dataset.id;
                //         const url = ROOT + 'ItemController/delete';
                //         fetch(url, {
                //                 method: 'POST',
                //                 headers: {
                //                     "Content-type": 'application/json'
                //                 },
                //                 body: JSON.stringify({
                //                     item_id: itemId
                //                 })
                //             })
                //             .then(res => res.json())
                //             .then(data => {
                //                 console.log(data);
                //             })

                //     })
                // })
            }