# Biblioteca — melhorias de fluxo


## 1. Fluxo atual

1. Quem acessa uma rota protegida sem sessão é enviado para `/user/login`.
2. Na mesma tela, a pessoa pode entrar ou cadastrar uma conta usando e-mail e senha.
3. Após entrar, é direcionada para a listagem de livros.
4. Na listagem, pode abrir o cadastro, a edição ou a exclusão de um livro.
5. Cadastro e edição gravam os dados e tentam retornar à listagem com uma mensagem de sucesso.

O SQL também define leitores e empréstimos, mas ainda não existem telas, controllers ou models desses módulos nos arquivos analisados.

## 2. Prioridade alta — concluir os fluxos existentes

### Preparar o banco para cadastro e login

**Situação:** `src/Model/User.php` consulta e grava na tabela `user`, mas `database/biblioteca.sql` não cria essa tabela. Uma instalação feita apenas com esse script fica sem a estrutura necessária para autenticação.

**Melhoria:** incluir no esquema a tabela de usuários com identificador, e-mail único e coluna de senha com espaço para o hash. Validar e-mail e senha no servidor e tratar e-mail já cadastrado com uma mensagem compreensível.

**Como verificar:** em um banco novo, importar o esquema, cadastrar uma conta e entrar; tentar cadastrar o mesmo e-mail novamente deve apresentar uma orientação, sem erro técnico na tela.

### Separar cadastro de conta e entrada

**Situação:** `/user/login` encaminha para `UserController::Cadastrar()`, que concentra cadastro e autenticação. O mesmo formulário tem os botões “Entrar” e “cadastrar”.

**Melhoria:** separar as ações de login e cadastro, com telas ou modos claramente identificados. Adicionar confirmação de senha ao cadastro, preservar o e-mail quando houver erro e informar quando a conta for criada. Não preencher novamente a senha após uma falha.

**Fluxo sugerido:** Entrar → Criar conta → Validar dados → Confirmar cadastro → Entrar → Livros.

**Como verificar:** a pessoa consegue distinguir as duas ações e corrigir um cadastro inválido sem perder o e-mail informado.

### Adicionar saída da conta

**Situação:** a listagem protegida ainda exibe “Fazer Login”, mesmo com uma sessão ativa, e não há rota de logout.

**Melhoria:** mostrar o usuário conectado e uma ação “Sair”, enviada por POST com proteção CSRF. Encerrar a sessão e retornar ao login. Ao abrir o login já autenticado, encaminhar para a listagem.

**Como verificar:** depois de sair, uma nova requisição a qualquer rota protegida exige autenticação.

### Concluir a confirmação de exclusão

**Situação:** `src/View/livros/excluir.php` apenas verifica a existência de `$livro`. O controller já exclui por POST, mas a tela não apresenta os dados nem o formulário de confirmação.

**Melhoria:** exibir título e autor, explicar a exclusão e oferecer “Cancelar” e “Confirmar exclusão”. Manter a alteração no POST e incluir token CSRF. Se houver empréstimos vinculados, tratar a restrição do banco e explicar por que o livro não pode ser excluído; considerar arquivamento para preservar o histórico.

**Fluxo sugerido:** Livros → Excluir → Conferir livro → Confirmar → Livros com mensagem de sucesso.

**Como verificar:** abrir a confirmação não exclui o registro; cancelar mantém o livro; confirmar exclui apenas quando permitido.

### Validar cadastro e edição de livros

**Situação:** título e autor podem chegar vazios ao controller, e o ano é convertido diretamente para inteiro. Na edição por POST, o código não verifica antes se o livro ainda existe.

**Melhoria:** remover espaços nas extremidades, exigir título e autor e respeitar os limites das colunas. Definir se o ano é obrigatório e validar seu formato e compatibilidade com o banco antes da conversão. Conferir a existência do livro também ao salvar uma edição.

**Experiência esperada:** apresentar erros junto aos campos, preservar os valores informados e mostrar sucesso somente quando a operação tiver sido concluída.

**Como verificar:** campos vazios, texto acima do limite, ano inválido e edição de registro inexistente produzem mensagens úteis, sem falso sucesso.

### Corrigir retornos e mensagens

**Situação:** o cadastro monta o redirecionamento apenas com `BASE_URL`, sem a barra final usada nas outras ações. Quando a aplicação está na raiz, isso pode gerar um destino vazio. IDs inválidos retornam à listagem sem explicar o motivo.

**Melhoria:** padronizar o retorno para `BASE_URL . '/'`, centralizar mensagens temporárias de sucesso e erro e exibi-las dentro do corpo HTML. Adicionar “Cancelar” ou “Voltar para livros” aos formulários. Aplicar o padrão de gravar e redirecionar após sucesso para evitar reenvio ao atualizar a página.

**Como verificar:** cadastrar funciona tanto na raiz quanto em subpasta; atualizar a listagem não repete a gravação; abrir um registro inexistente apresenta uma orientação.

## 3. Prioridade média — facilitar a rotina

| Melhoria | Comportamento proposto | Benefício |
| --- | --- | --- |
| Busca de livros | Pesquisar por título ou autor, com opção de limpar a busca. | Encontrar um livro sem percorrer toda a lista. |
| Filtros e paginação | Filtrar por categoria e disponibilidade quando esses campos estiverem integrados; paginar e permitir ordenação. | Manter a consulta prática conforme o acervo cresce. |
| Preservar a consulta | Retornar da edição ou do cadastro mantendo filtros e página, quando aplicável. | Evitar que a pessoa refaça a busca. |
| Detalhes do livro | Criar uma tela com os dados completos e ações relacionadas. | Reunir informações antes de editar ou emprestar. |
| Cadastro completo | Integrar ISBN, categoria e quantidades, já previstos no SQL, com validações. | Preparar o acervo para o controle de circulação. |
| Navegação consistente | Usar um layout compartilhado com acesso a livros, conta e futuros módulos. | Tornar os caminhos previsíveis. |
| Estados vazios | Distinguir “nenhum livro cadastrado” de “nenhum resultado encontrado”, com uma ação útil. | Orientar o próximo passo. |
| Acessibilidade | Padronizar o idioma para `pt-BR`, organizar títulos, indicar campos obrigatórios e tornar mensagens acessíveis. | Facilitar o uso por teclado e tecnologias assistivas. |

**Como verificar:** buscar um livro, editar e retornar à consulta sem perder o contexto; testar uma busca sem resultado e percorrer os formulários pelo teclado.

## 4. Evolução — leitores, empréstimos e devoluções

Estas funcionalidades ampliam o escopo atual e aproveitam tabelas já presentes em `database/biblioteca.sql`.

### Cadastro de leitores

Criar listagem, busca, cadastro, edição e detalhes dos leitores, com nome, e-mail e telefone. Validar e-mail único e apresentar o histórico de empréstimos. Distinguir a conta que acessa o sistema do leitor que retira livros; qualquer vínculo entre eles precisa ser definido como regra do produto.

### Empréstimo

**Fluxo sugerido:** Selecionar leitor → Selecionar livro disponível → Informar prazo → Conferir → Confirmar empréstimo.

- Validar leitor, livro, disponibilidade e datas no servidor.
- Registrar o empréstimo e reduzir a disponibilidade na mesma transação.
- Proteger a atualização de estoque contra requisições simultâneas, para que o último exemplar não seja emprestado duas vezes.
- Mostrar leitor, livro e data prevista na confirmação final.

### Devolução

**Fluxo sugerido:** Buscar empréstimo aberto → Conferir leitor e livro → Confirmar devolução → Atualizar disponibilidade.

- Preencher a data de devolução e alterar o status para `devolvido`.
- Aumentar a disponibilidade na mesma transação, sem ultrapassar a quantidade total.
- Impedir que uma confirmação repetida devolva o mesmo empréstimo novamente.
- Preservar o histórico mesmo que um livro ou leitor deixe de estar ativo.

### Acompanhamento

Criar uma visão dos empréstimos abertos, devolvidos e atrasados. O atraso pode ser calculado a partir da data prevista e da ausência de devolução, sem depender de um novo status gravado. Depois, avaliar reservas e renovação, definindo antes limites e regras de atendimento.

**Como verificar:** emprestar o último exemplar, tentar novo empréstimo sem estoque, devolver e repetir a confirmação. O estoque deve permanecer consistente, inclusive com operações simultâneas.

## 5. Sustentação dos fluxos

- **Rotas previsíveis:** adicionar resposta 404 para caminhos desconhecidos e restringir os métodos HTTP de cada ação, com resposta 405 quando necessário. O `switch` atual não tem tratamento padrão.
- **Proteção dos formulários:** validar tokens CSRF nas ações que alteram dados e manter o escape de valores ao renderizar HTML.
- **Permissões:** caso existam perfis distintos, definir quem pode consultar, manter o acervo e registrar empréstimos, verificando isso no servidor. Hoje a proteção das rotas verifica a presença da sessão.
- **Falhas de persistência:** tratar exceções de banco, registrar detalhes técnicos internamente e mostrar mensagens que permitam corrigir os dados ou tentar novamente.
- **Compatibilidade de arquivos:** ajustar a referência `View/User/login.php` no controller para corresponder ao diretório existente `View/user/login.php`, evitando falhas em sistemas que diferenciam maiúsculas de minúsculas.
- **Organização:** extrair validações e, ao implementar circulação, concentrar as regras de empréstimo e devolução em serviços, para que todas as entradas respeitem as mesmas condições.

## 6. Ordem sugerida de implementação

- [ ] Completar o esquema de usuários e validar cadastro e login.
- [ ] Separar os fluxos de acesso e adicionar logout.
- [ ] Concluir a confirmação de exclusão.
- [ ] Validar livros, conferir registros existentes e padronizar retornos e mensagens.
- [ ] Integrar proteção CSRF, tratamento de erros e respostas de rotas.
- [ ] Melhorar navegação, busca e paginação.
- [ ] Integrar os demais campos do acervo e o cadastro de leitores.
- [ ] Implementar empréstimos e devoluções com controle transacional de estoque.
- [ ] Adicionar acompanhamento de atrasos e avaliar reservas e renovação.

Para cada etapa, verificar o caminho de sucesso, os dados inválidos e as tentativas sem autenticação. Nos fluxos de circulação, incluir verificações de concorrência e de confirmação repetida.
