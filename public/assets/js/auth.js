document.addEventListener('DOMContentLoaded', function() {
    console.log('auth.js loaded');
    // Login AJAX
    const loginForm = document.querySelector('form[action$="canteen/login"]');
    if (loginForm) {
        console.log('Login form found');
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Login form submitted');
            const formData = new FormData(loginForm);
            fetch(`${window.location.origin}/canteen-preorder-system/public/canteen/ajax_login_validate`, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                clearErrors(loginForm);
                if (data.success) {
                    window.location.href = `${window.location.origin}/canteen-preorder-system/public/canteen/`;
                } else {
                    showErrors(loginForm, data.errors);
                }
            });
        });
    } else {
        console.log('Login form NOT found');
    }

    // Signup AJAX
    const signupForm = document.querySelector('form[action$="canteen/signin"]');
    if (signupForm) {
        console.log('Signup form found');
        signupForm.addEventListener('submit', function(e) {
            e.preventDefault();
            console.log('Signup form submitted');
            const formData = new FormData(signupForm);
            fetch(`${window.location.origin}/canteen-preorder-system/public/canteen/ajax_signup_validate`, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                clearErrors(signupForm);
                if (data.success) {
                    window.location.href = `${window.location.origin}/canteen-preorder-system/public/canteen/login`;
                } else {
                    showErrors(signupForm, data.errors);
                }
            });
        });
    } else {
        console.log('Signup form NOT found');
    }

    function showErrors(form, errors) {
        for (const key in errors) {
            const input = form.querySelector(`[name="${key}"]`);
            if (input) {
                let errorElem = document.createElement('div');
                errorElem.className = 'form-error';
                errorElem.style.color = 'red';
                errorElem.style.fontSize = '0.9em';
                errorElem.textContent = errors[key];
                input.parentNode.appendChild(errorElem);
            }
        }
    }
    function clearErrors(form) {
        const errors = form.querySelectorAll('.form-error');
        errors.forEach(e => e.remove());
    }
}); 