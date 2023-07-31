ALTER TABLE inscricoes CHANGE livro localEvento VARCHAR(255);

ALTER TABLE inscricoes CHANGE folha periodo VARCHAR(50);

ALTER TABLE inscricoes ADD COLUMN horario time;


CREATE TABLE `turma` (
  `id` int(11) NOT NULL,
  `escolaId` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `coleta` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `turmaId` int(11) NOT NULL,
  `turno` varchar(255) NOT NULL,
  `nascimento` date DEFAULT NULL,
  `sexo` varchar(20) NOT NULL,
  `kit_inverno` varchar(50) DEFAULT NULL,
  `kit_verao` varchar(50) DEFAULT NULL,  
  `tam_calcado` varchar(50) DEFAULT NULL,
  `transporte1` varchar(50) DEFAULT NULL,  
  `transporte2` varchar(50) DEFAULT NULL,  
  `transporte3` varchar(50) DEFAULT NULL   
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `turma`
  ADD PRIMARY KEY (`id`);
  
  ALTER TABLE `coleta`
  ADD PRIMARY KEY (`id`);
  
  ALTER TABLE `turma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
  
  ALTER TABLE `coleta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
