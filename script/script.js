function SendDoacao(){
    var name = document.getElementById('name');
    var pet = document.getElementById('namePet');
    var email = document.getElementById('email');
    var type = document.getElementById('type');

    if(name.value == "" || pet.value == "" || email.value == "" || type == ""){
        alert("Preencha todas as informações, para que possamos entrar em contato!");
    }else{
        alert("Iremos entrar em contato com você em breve, aguarde!");
    }
}

$(document).ready(function(){
    /*
    $('#logout').click(function(){
        $.ajax({
            method: "POST",
            url: "..\\controllers\\LoginController.php",
            data: {
                nome: "Pedro",
                email: "pedro@email.com"
            },
            beforeSend: function(){
                console.log('enviando');
            }
        })
        .done(function(msg){
            console.log(msg);
        })
        .fail(function(jqXHR, textStatus, msg){
            alert("Erro: " . msg );
        })
    })
    */
});