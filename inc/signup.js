
const form = document.querySelector('.signup form'),
continueBtn = form.querySelector('.button input'),
errorText = document.querySelector('.error-txt');

form.onsubmit = (e) => {
    e.preventDefault(); //previne de um auto submit   
}

continueBtn.onclick = ()=>{
    //let's start ajax
    let xhr = new XMLHttpRequest(); //cria um objeto XML
    xhr.open("POST", "inc/signup.php", true); //cria um objeto XML
    xhr.onload = () => 
    {
        if(xhr.readyState === XMLHttpRequest.DONE)
        {
            if(xhr.status === 200)
            {
                let data = xhr.response;
                if(data == "success")
                {
                     
                }
                else
                {
                    errorText.textContent = data;
                    errorText.style.display = "block";

                }   
            }
        }
    }
    let formData = new FormData(form); //cria um objeto FormData
    xhr.send(formData); //envia o formulário para o php
}
