const express = require('express');
const { Pool } = require('pg');

const app = express();
const port = 3005;

// Connexion à PostgreSQL avec des variables d'environnement
const pool = new Pool({
  host: process.env.POSTGRES_HOST || 'postgres',
  database: process.env.POSTGRES_DB || 'votes',
  user: process.env.POSTGRES_USER || 'postgres',
  password: process.env.POSTGRES_PASSWORD || 'postgres',
  port: 5432
});

app.get('/', async (req, res) => {
  try {
    const result = await pool.query('SELECT vote_option, COUNT(*) as count FROM votes GROUP BY vote_option');
    let response = "<h1>Résultats du vote</h1>";

    result.rows.forEach(row => {
      response += `<p>${row.vote_option}: ${row.count} vote(s)</p>`;
    });

    res.send(response);
  } catch (err) {
    console.error(err);
    res.status(500).send("Erreur du serveur");
  }
});

// ⬅️ Changer ici pour écouter sur 0.0.0.0
app.listen(port, '0.0.0.0', () => {
  console.log(`Résultats app listening on port ${port}`);
});
