INSERT INTO `endereco` (`id`, `logradouro`, `numero`, `bairro`, `cidade_id`, `cep`, `complemento`) VALUES
(1, 'Rua Marcos Couto Bezerra', 689, 'Conjunto Metropolitano', 741, '61604440', NULL),
(2, 'Rua Cônego Pereira', 279, 'Barbalho', 616, '40300756', NULL),
(3, 'Rua Jorge Fraxe', 443, 'Caimbé', 4400, '69312179', NULL),
(4, 'Avenida do Ginásio', 669, 'La Salle II', 1455, '78710035', NULL),
(5, 'Avenida Ceará', 785, 'Capoeira', 94, '69905000', NULL);

INSERT INTO `servico_assistencia` (`id`, `nome`, `valor`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Software aparelhos básicos', '50.00', '2019-11-12 19:42:18', '2019-11-12 19:42:18', NULL),
(2, 'Montagem aparelhos básicos', '60.00', '2019-11-12 19:42:33', '2019-11-12 19:42:33', NULL),
(3, 'Software aparelhos médios', '70.00', '2019-11-12 19:42:50', '2019-11-12 19:42:50', NULL),
(4, 'Montagem aparelhos médios', '80.00', '2019-11-12 19:42:57', '2019-11-12 19:42:57', NULL),
(5, 'Software aparelhos classe alta', '90.00', '2019-11-12 19:43:19', '2019-11-12 19:43:19', NULL),
(6, 'Montagem aparelhos classe alta', '100.00', '2019-11-12 19:43:31', '2019-11-12 19:43:31', NULL),
(7, 'Montagem aparelhos colados', '160.00', '2019-11-12 19:45:04', '2019-11-12 19:45:04', NULL);

INSERT INTO `tecnico_assistencia` (`id`, `nome`, `cpf`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sérgio Carlos Guilherme Brito', '084.400.380-89', '2019-11-12 19:38:46', '2019-11-12 19:38:46', NULL),
(2, 'Danilo Elias da Silva', '040.976.675-56', '2019-11-12 19:39:01', '2019-11-12 19:39:30', '2019-11-12 19:39:30'),
(3, 'Hugo Cauê Duarte', '798.956.290-10', '2019-11-12 19:39:15', '2019-11-12 19:39:15', NULL),
(4, 'Filipe Victor Bruno de Paula', '469.843.759-83', '2019-11-12 19:39:27', '2019-11-12 19:39:27', NULL);


INSERT INTO `cliente_assistencia` ( `nome`, `cpf`, `email`, `data_nascimento`, `endereco_id`, `celnumero`, `telefonenumero`, `created_at`, `updated_at`, `deleted_at`) VALUES
('Evelyn Eliane Maitê Figueiredo', '348.071.698-90', 'evelyn@signatreinamentos.com.br', '1960-04-27', 1, '(12) 98434-8874', '', '2019-11-12 18:53:39', '2019-11-12 18:53:39', NULL),
('Lucca Murilo Mateus Costa', '477.281.895-22', 'lluccamurilomateuscosta@petcamp.com.br', '1999-07-12', 2, '(11) 97405-4572', '(12) 3894-3541', '2019-11-12 18:57:54', '2019-11-12 18:57:54', NULL),
('Victor Filipe Melo', '996.094.128-07', 'victorfilipemelo@abcturismo.com.br', '1987-08-23', 3, '(12) 98745-7843', '(11) 3874-6744', '2019-11-12 19:16:55', '2019-11-12 19:16:55', NULL),
('Agatha Laura Ribeiro', '725.202.825-92', 'aagathalauraribeiro@centerdiesel.com.br', '1987-10-23', 4, '(66) 98259-0764', '', '2019-11-12 19:22:19', '2019-11-12 19:22:19', NULL),
('Daniel Breno Fernandes', '210.869.073-53', 'danielbrenofernandes_@antunez.com.br', '1981-01-19', 5, '(68) 98897-1993', '(68) 3824-7766', '2019-11-12 19:25:27', '2019-11-12 19:25:27', NULL);

