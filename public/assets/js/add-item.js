     
      
        
       
           updateCloseButton();
           
        
           const overlay = document.getElementById('overlay');
        let mainContent = document.body.querySelector('.main-content');
           
        
           mainContent.addEventListener('click',e => {
            let targetElement = e.target.closest('[data-modal-target');
            if(targetElement)
            {

                console.log('clicked data modal target');
                let modal = document.querySelector(targetElement.dataset.modalTarget);
                openModal(modal);
            }
            // if(e.target.matches('[data-modal-target]')){
            // }
            e.preventDefault()
           })
 
            
            function openModal(modal) {
                
                if (modal == null) return
                modal.classList.add('active');
                overlay.classList.add('active');
                
            }

            function updateCloseButton()
            {

                document.body.addEventListener('click',e => {
                    if(e.target.matches('[data-close-button]'))
                    {
                        let button = e.target;
                        const modal = button.closest('.modal');
                                    closeModal(modal);
                    }
                })

         
    
            }
            function closeModal(modal) {
              console.log('clicked closeModal');
                if (modal == null) return
                modal.classList.remove('active');
                overlay.classList.remove('active');

            }

          console.log("hy from add-item");
        