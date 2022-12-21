
        // floreio -- para o usuário confirmar a exclusão
       /* function excluir(url){
            if (confirm("Confirma a exclusão?"))
                window.location.href = url; //redireciona para o arquivo que irá efetuar a exclusão
        }

        window.onload = (function (){
            carregaDados();
            document.getElementById('fpesquisa').addEventListener('submit',function(ev){
                ev.preventDefault();
                carregaDados();
            });
            document.getElementById('busca').addEventListener('keyup',carregaDados);
        });

        function carregaDados(){
            busca = document.getElementById('busca').value;
            const xhttp = new XMLHttpRequest();  // cria o objeto que fará a conexão assíncrona
            xhttp.onload = function() {  // executa essa função quando receber resposta do servidor
                dados = JSON.parse(this.responseText); // os dados são convertidos para objeto javascript
                montaTabela(dados);
            }
            // configuração dos parâmetros da conexão assíncrona
            xhttp.open("GET", "pesquisa.php?busca=" + busca, true);  // arquivo que será acessado no servidor remoto  
            xhttp.send(); // parâmetros para a requisição

        }
        function montaTabela(dados){
            str = "";
            for(usuario of dados){
                editar = "<a href='cadUsuario.php?acao=editar&idmotorista="+usuario.idmotorista+"'>Alterar</a>";
                excluir = "<a href='acao.php?acao=excluir&idmotorista="+usuario.idmotorista+"')>Excluir</a>";
                str += "<tr><td>"+usuario.idmotorista+"</td><td>"+usuario.nome+"</td><td>"+usuario.sobrenome+"</td><td>"+usuario.dtnasc+"</td><td>"+usuario.idade+"</td><td>"+usuario.endereco+"</td><td>"+usuario.enderecorua+"</td><td>"
                +usuario.cidade+"</td><td>"+usuario.telefone+"</td><td>"+usuario.email+"</td><td>"
                +usuario.senha+"</td><td>"+usuario.imagem+"</td><td><a href='cadUsuario.php?acao=editar&idmotorista="+usuario.idmotorista+"'>Alterar</a></td><td>"+excluir+"</td></tr>";
            }
            document.getElementById('corpo').innerHTML = str;
        }*/
        function preencher() {


            let userInput = document.getElementById('dtnasc').value;
            let data = new Date(userInput);
            let dataatual = new Date();
            var currentY = dataatual.getFullYear();

            var prevY = data.getFullYear();

            var ageY = currentY - prevY;

            console.log(ageY);

            document.getElementById("idade").value = ageY;
        }

