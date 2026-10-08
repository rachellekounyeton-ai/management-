let floatingPassword = document.getElementById('floatingPassword');
        let iconpassword = document.getElementById('iconpassword');

        iconpassword.addEventListener('click', function(){
            let currentInputType = floatingPassword.type
            this.className = currentInputType !== 'password' ? 'bi bi-eye-slash': 'bi bi-eye';
            floatingPassword.type =   floatingPassword.type == 'password' ? 'text' : 'password';
        });