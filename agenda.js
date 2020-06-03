var app = new Vue({
	el: "#app",
	data: {
		contato:{id:0, nome: "", email: "", telefone: ""},
		contatos: [],
		url: "./agenda.php"
	},
	created: function() {
		this.ListarContatos();
	},
	methods: {
		ListarContatos() {
			axios.get(this.url, {
				params: {
					operacao: "read"
				}
			}).
			then(response =>{
				console.log(response.data);
			})
		}

	}
})