function showLabel(element){
	var id = element.id;
	if (id == "senha") {
        document.getElementById("labelSenha").style.visibility = "visible";
        document.getElementById("labelCPF").style.visibility = "visible";
    }else {
        document.getElementById("labelCPF").style.visibility = "visible";
    }
}
function hideLabel(element){
	var id = element.id;
	if (id == "senha") {
        document.getElementById("labelSenha").style.visibility = "hidden";
        document.getElementById("labelCPF").style.visibility = "hidden";
    }else {
        document.getElementById("labelCPF").style.visibility = "hidden";
    }
}
function stayVisible(){
    document.getElementById("labelSenha").style.visibility = "visible";
    document.getElementById("labelCPF").style.visibility = "visible";
}

