var app = new Vue({
	el: "#app",
	data: {
        contatos: {id: 0, nome: "", email: "", telefone: 0, intagram: "", facebook:"",linkedin:""},
		contatos: [],
		url: "./agenda.php"
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
					this.contatos = response.data.contatos;
			}) 
		},

		salvarFuncionario() {
			let form = new FormData();
			for (let i in this.contato)
				form.append(i, this.contato[i]);

			axios.post(this.url, form, {
				params: {
					operacao: (this.contato.id > 0) ? "update" : "create"
				}
			}).
			then(response => {
				console.log(response);
				if (!response.data.erro) {
					this.obterListaFuncionarios();
					this.contato = {id: 0, nome: "", email: "", datanasc: "", salario: 0.00};
				}
			}); 

		},

		editarFuncionario(idFunc) {
			this.contato = Object.assign({}, this.contatos.filter(f => f.id === idFunc)[0]);
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