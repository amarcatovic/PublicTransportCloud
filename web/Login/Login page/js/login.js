const login = () => {
    console.log(document.getElementById('email-input').value)
    console.log(document.getElementById('password-input').value)

    let data = {}

    data.email = document.getElementById('email-input').value
    data.password = document.getElementById('password-input').value

    fetch('http://localhost/publictransportcloud/api/KorisnikAplikacije/login.php', {
    method: 'POST', 
    headers: {
        'Content-Type': 'application/json',
    },
    body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
    console.log('Success:', data)
    clearInput()
    })
    .catch((error) => {
        console.error('Error:', error)
    })
    
}