

const seachBar = document.querySelector('.users .search input'),
searchBtn = document.querySelector('.users .search button');

searchBtn.onclick = ()=>{
    seachBar.classList.toggle('active');
    seachBar.focus();
    searchBtn.classList.toggle('active');
    seachBar.value = '';
}

function openChat(user){
        // Create an iframe element
        var iframe = document.createElement('iframe');
        iframe.src = 'chat.php?username=' + user;
        iframe.style.width = '100%';
        iframe.style.height = '100%';
        iframe.style.border = 'none';
    
        // Remove any existing chat content
        var chatContent = document.getElementById('chatContent');
        chatContent.innerHTML = '';
    
        // Append the iframe to the chatContent div
        chatContent.appendChild(iframe);
}
