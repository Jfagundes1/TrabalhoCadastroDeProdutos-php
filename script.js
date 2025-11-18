function validar(){
    let nome = document.getElementById("nome").value;
    let preco = document.getElementById("preco").value;

    if(nome.trim() === "" || preco.trim() === ""){
        alert("Preencha todos os campos!");
        return false;
    }

    return true;
}

