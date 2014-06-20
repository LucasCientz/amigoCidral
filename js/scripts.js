//Funcao para confirmar açao
function confirmar() {
	if (confirm("Você deseja executar a ação?")) {
		return true;
	} else {
		return false;
	}
};

//Funcao para cancelar açao
function confirmCancelar() {
	if (confirm("Você deseja cancelar a ação?")) {
		return true;
	} else {
		return false;
	}
};

//Funcao para deletar Item
function confirmDeletar() {
	if (confirm("Você realmente deseja deletar o item? Após o procedimento os dados serão perdidos.")) {
		return true;
	} else {
		return false;
	}
};


