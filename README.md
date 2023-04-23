
# Erros ou possíveis erros:

* Quando rodei o comando: **php artisan migrate**

SQLSTATE[HY000] [1045] Access denied for user ''@'localhost' (using password: NO) (SQL: select * from information_schema.tables 
where table_schema = vaga-gomide and table_name = migrations and table_type = 'BASE TABLE')

	Tive que atribuir a palavra root em DB_USERNAME=root no arquivo .env 

* Quando rodei o novamente o comando: **php artisan migrate**

SQLSTATE[42000]: Syntax error or access violation: 1071 Specified key was too long; max key length is 1000 bytes (SQL: alter table `users` add unique `users_email_unique`(`email`))

	Tive que adicionar a seguinte linha em /app/Providers/AppServiceProvider.php: 
	Schema::defaultStringLength(191);

	Fonte: https://stackoverflow.com/questions/42244541/laravel-migration-error-syntax-error-or-access-violation-1071-specified-key-wa

* Depois de rodar todas as migrations e a seed, quando acessei o projeto pelo navegador, me deparei com um erro de acesso a rota que foi resolvido mudando a forma que a rota estava sendo chamada (comparei com outros projetos em laravel que eu havia feito anteriormente e percebi o erro):

	    Troquei: Route::get('/notas', [App\Http\Controllers\NotasController::class]);
	    Por: Route::get('/notas', [NotasController::class, 'index']);
	
	    Já que no modelo antigo não informava qual método de NotasController era acessado através da rota especificada.

* Ao corrigir o erro anterior, me deparei com o seguinte:

SQLSTATE[42S02]: Base table or view not found: 1146 Table 'vaga-gomide.nfe' doesn't exist (SQL: select * from `nfe` where `mes_ano` = 04/2023 order by `dt` desc)

Resolvi trocando o nome da tabela que estava sendo acessada no método index de NotasController.

	Troquei nfe por notas que é o nome da tabela que foi criada através das migrations.

* Após corrigir o erro anterior, me deparei com:

SQLSTATE[42S22]: Column not found: 1054 Unknown column 'dt' in 'order clause' (SQL: select * from `notas` where `mes_ano` = 04/2023 order by `dt` desc)

    Consertei ele trocando na consulta o nome 'dt' que não é um atributo presente na table (portando o erro na consulta), por 'valor', um atributo presente na tabela de notas.

* Ocorreu um erro indicando que o count deveria ser usado para countable or array, portanto retirei ele da condição e deixei só a variável que representava o objeto na condição, já que era uma condição simples que verificava se existia notas ou não.

	    Substitui @if ($notas) > 0 
	    Por @if ($notas)

* A maneira que as seeds estavam criadas, só criaria 1 registro, o primeiro no caso, tive que passar tudo dentro de um array e fazer um foreach;

* Notei que haviam muitas informações desnecessárias na blade welcome, com isso mantive uma table simples sem essas informações que não estavam sendo usadas. Utilizei apenas os atributos que estavam sendo inseridos na migration da tabela notas;

* E por final me restou criar lógica do campo de pesquisa de dados, um campo de pesquisa operando em tempo real, dinamicamente, e sem botão de envio de formulário.

    Para isso, como no email que recebi divulgando a vaga estava escrito que as Tecnologias e ferramentas utilizadas no estágio seriam : PHP e Laravel, MySQL, JQuery, Bootstra. Levei em conta de acordo com minhas experiência anteriores que com certeza utilizam Ajax para fazer requisições assíncronas, portanto para fazer o campo de pesquisa dinâmico solicitado, utilizei JQuery e Ajax.

* Notei ainda que a pesquisa por data no topo da tela não estava acontecendo, portanto corrigi.
	
	





