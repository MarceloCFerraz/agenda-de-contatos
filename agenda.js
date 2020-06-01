var app = new Vue({
	el: "#app",
	data: {
		funcionario: {id: 0, nome: "", email: "", datanasc: "", salario: 0.00},
		funcionarios: [],
		url: "./funcionario.php"
	},
	created: function() {
		this.obterListaFuncionarios();
	},
	methods: {
		obterListaFuncionarios() {
			axios.get(this.url, {
				params: {
					operacao: "read"
				}
			}).
			then(response => {
				if (!response.data.erro)
					this.funcionarios = response.data.funcionarios;
			}) 
		},

		salvarFuncionario() {
			let form = new FormData();
			for (let i in this.funcionario)
				form.append(i, this.funcionario[i]);

			axios.post(this.url, form, {
				params: {
					operacao: (this.funcionario.id > 0) ? "update" : "create"
				}
			}).
			then(response => {
				console.log(response);
				if (!response.data.erro) {
					this.obterListaFuncionarios();
					this.funcionario = {id: 0, nome: "", email: "", datanasc: "", salario: 0.00};
				}
			}); 

		},

		editarFuncionario(idFunc) {
			this.funcionario = Object.assign({}, this.funcionarios.filter(f => f.id === idFunc)[0]);
		},

		removerFuncionario(idFunc) {
			axios.get(this.url, {
				params: {
					operacao: "delete",
					id: idFunc
				}
			}).
			then(response => {
				if (!response.data.erro)
					this.obterListaFuncionarios();
			}) 			
		}
	}
})