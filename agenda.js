var app = new Vue({
<<<<<<< HEAD
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
=======
    el: "#app",
    data: {
        contato: {id: 0, nome: "", email: "", telefone: "", intagram: "", facebook:""},
        contatos: [] = [],
        url: "./agenda.php"
    },
    created: function() {
        this.ListarContatos();
    },
	methods: 
	{
>>>>>>> 689767694e87627d1684f561f23f5cd8d04748a6
		ListarContatos() {
			axios.get(this.url, {
				params: {
					operacao: "read"
				}
<<<<<<< HEAD
			}).
			then(response =>{
				console.log(response.data);
			})
		}

	}
=======
			}).then(response => {
				if (!response.data.erro){
					console.log(response.data); // undefined assistir aula 1205 e 1805
					this.contatos = response.data.contatos;					
					console.log(this.contatos); // undefined
				}
			}) 
		},

        salvarContato() {
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
                    this.ListarContatos();
                    this.contato = {id: 0, nome: "", email: "", telefone: "", intagram: "", facebook:""};
                }
            });
        },

        editarContato(idContato) {
            this.contato = Object.assign({}, this.contatos.filter(c => c.id === idContato)[0]);
        },

        removerContato(idContato) {
            axios.get(this.url, {
                params: {
                    operacao: "delete",
                    id: idContato
                }
            }).
            then(response => {
                if (!response.data.erro)
                    this.ListarContatos();
            })             
        }
    }
>>>>>>> 689767694e87627d1684f561f23f5cd8d04748a6
})