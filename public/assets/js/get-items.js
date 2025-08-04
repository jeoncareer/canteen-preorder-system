const searchBar = document.querySelector('#searchInput');

                        searchBar.addEventListener('input', function() {
                            const menuCategory = document.querySelector('.menu-categories');
                            const word = this.value;
                            let test = document.getElementById('testing');
                            let from = this.dataset.from;
                            let url = ROOT + 'api/getItems';
                            if (word == '') {
                                location.reload();
                                return;
                            }
                            fetch(url, {
                                    method: "POST",
                                    headers: {
                                        "Content-type": "application/json"
                                    },
                                    body: JSON.stringify({
                                        word: word,
                                        from:from
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        console.log(data);
                                        menuCategory.innerHTML = '';
                                        let items = data.items;
                                        items.forEach(item => {
                                            console.log(item);
                                            let div = document.createElement('div');
                                            div.classList.add('menu-item');
                                            div.dataset.itemId = item.id;
                                            div.innerHTML = `
                                                    <div class="item-header">
                                                    <div class="item-name"> ${item.name} </div>
                                                    <div class="item-price">₹${item.price}</div>
                                                </div>
                                                <div class="item-description">Fragrant basmati rice with tender chicken, aromatic spices, and boiled egg. Served with raita and pickle.</div>
                                                <div class="item-footer">
                                                    <div class="availability available">Available</div>

                                                </div>
                                            `;

                                            menuCategory.append(div);
                                            updateAddButton();
                                        })



                                    }
                                })
                        })