var app = new Vue({
    el: "#app",
    data: {
        default: {} = { id: 0, nome: null, email: null, telefone: null, instagram: null, facebook: null},
        contato: {} = { id: 0, nome: null, email: null, telefone: null, instagram: null, facebook: null },
        contatos: [] = [],
        url: "./agenda.php"
    },
    created: function() {
        this.ListarContatos();
    },
    methods:         
	{
        CheckFields() {
            // i = 0 = id
            // i = 1 = nome
            // i = 2 = email
            // i = 3 = telefone
            // i = 4 = instagram
            // i = 5 = facebook
            
            var continua = true;

            if (this.contato[1] === null) {
                alert("Nome não informado!");
                continua = false;
                this.contato = this.default;
            }
            if (this.contato[3] === null) {
                alert("Número de Telefone não informado!");
                continua = false;
                this.contato = this.default;
            }

            
            return continua;
        },

		ListarContatos() {
			axios.get(this.url, {
				params: {
					operacao: "read"
				}
			}).then(response => {
				if (!response.data.erro){
                    // console.log(response.data.contatos);
                    this.contatos = response.data.contatos;
					// console.log(this.contatos); // undefined
				}
			}) 
		},

        salvarContato() {
            if (this.CheckFields()) {
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
                    alert(response.data.msg);
                    if (!response.data.erro) {
                        this.ListarContatos();
                        this.contato = this.default;
                    }
                });
            }

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
                alert(response.data.msg);
                if (!response.data.erro)
                    this.ListarContatos();
            })             
        }
    }
})