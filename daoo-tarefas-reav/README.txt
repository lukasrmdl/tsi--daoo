//PROJETO
Rodar o servidor = php artisan serve --port=8082

migrar -> php artisan migrate:fresh

seed -> php artisan db:seed

//ROTAS

usuarios -> /users
comentário -> /comments
topicos -> /topics

//DADOS SQL PARA TESTE -> legado -> antes dos seeders

INSERT INTO `comments` (`id`, `text`, `likes`, `dislikes`, `edited`) VALUES
(1, 'adorei a build de gladio.', 2, 0, false ),
(2, 'precisa de mais dano em area', 0, 1, true ),
(3, 'discordo craque.', 5, 1, false);

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Edward Kenway', 'edward.ken@gmail.com', 'Pirates666'),
(2, 'Connor Mcgree', 'connor4real@outlook.com', 'NorthCarolina1999'),
(3, 'Ezio montrinelli', 'ezio.assassin@yahoo.com', 'FlorenzaMyHome');

INSERT INTO `topics` (`id`, `title`, `content`, `category`, `edited`) VALUES
(1, 'Descobri uma build roubada!', 'Phasellus sollicitudin nisi a varius auctor. Aliquam tincidunt tempus nisl. Morbi viverra, felis vel tempus accumsan, felis lectus faucibus mi, ut imperdiet erat metus eget magna.', 'Interação', false ),
(2, 'Precisar buffar move speed...', 'Donec rutrum leo nec ligula ultricies, sed accumsan tortor posuere. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. ', 'Melhoria', false ),
(3, 'Qual build acham mais forte?', 'Suspendisse potenti. Nam finibus accumsan est, ac scelerisque elit imperdiet in. Vivamus eu hendrerit neque. Cras nisl tellus, pretium eu est in, venenatis pharetra diam.', 'Duvida', false);