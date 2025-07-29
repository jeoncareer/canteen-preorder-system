            const openModalButton = document.querySelectorAll('[data-modal-target]');
            const closeModalButton = document.querySelectorAll('[data-close-button]');
            const overlay = document.getElementById('overlay');

            console.log("clicked open modal button");
            openModalButton.forEach(button => {
                button.addEventListener('click', function() {
                    
                    console.log("clicked modal");
                    const modal = document.querySelector(button.dataset.modalTarget);
                    openModal(modal);
                })
            })

            closeModalButton.forEach(button => {
                
                button.addEventListener('click', () => {
                  
                    const modal = button.closest('.add-item-modal');
                    closeModal(modal);
                })
            })

            function openModal(modal) {
               
                if (modal == null) return
                modal.classList.add('active');
                overlay.classList.add('active');

            }

            function closeModal(modal) {
              
                if (modal == null) return
                modal.classList.remove('active');
                overlay.classList.remove('active');

            }