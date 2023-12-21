

CREATE TABLE IF NOT EXISTS informacion (
  codigo SERIAL PRIMARY KEY,
  nombrearchivo VARCHAR(100) NOT NULL,
  cantlineas INT NOT NULL,
  cantpalabras INT NOT NULL,
  cantcaracteres INT NOT NULL,
  fecharegistro TIMESTAMP NOT NULL
);