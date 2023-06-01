ALTER TABLE inscricoes CHANGE livro localEvento VARCHAR(255);

ALTER TABLE inscricoes CHANGE folha periodo VARCHAR(50);

ALTER TABLE inscricoes ADD COLUMN horario time;