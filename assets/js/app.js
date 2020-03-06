document.getElementById('pass').addEventListener('click', (e) => {    
    let password = document.getElementById('password');
    let passwordType = password.getAttribute('type');
    let text = event.target;
    if(passwordType === 'text'){
        password.setAttribute('type', 'password');
        text.innerHTML = 'show password';
    }else {
        password.setAttribute('type', 'text');
        text.innerHTML = 'hide password';
    }
})