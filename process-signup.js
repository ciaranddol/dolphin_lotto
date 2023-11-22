const { Pool } = require('pg');

// Include the database connection
const pgsqlConnection = new Pool({
  // Add your PostgreSQL database configuration here
  user = 'postgres',
  host = 'db.fuhzxgckcobvsvhkqppo.supabase.co',
  database: 'postgres',
  password = 'buckbeak1901!',
  port: 5432,
});

// Express is used to handle HTTP requests
const express = require('express');
const bodyParser = require('body-parser');
const app = express();
const port = 3000;

app.use(bodyParser.urlencoded({ extended: true }));

app.post('/process', async (req, res) => {
  try {
    if (!req.body.name) {
      return res.status(400).send('Name is required');
    }

    if (!req.body.email || !validateEmail(req.body.email)) {
      return res.status(400).send('Valid email is required');
    }

    if (req.body.password.length < 8) {
      return res.status(400).send('Password must be at least 8 characters');
    }

    if (!/[a-z]/i.test(req.body.password)) {
      return res.status(400).send('Password must contain at least one letter');
    }

    if (!/\d/.test(req.body.password)) {
      return res.status(400).send('Password must contain at least one number');
    }

    if (req.body.password !== req.body.password_confirmation) {
      return res.status(400).send('Passwords must match');
    }

    const sql = 'INSERT INTO users (name, email, password) VALUES ($1, $2, $3)';
    const values = [req.body.name, req.body.email, req.body.password];

    const result = await pgsqlConnection.query(sql, values);

    if (result.rowCount > 0) {
      return res.redirect('signup-success.html');
    } else {
      const error = result.error;

      if (error && error.code === '23505') {
        return res.status(400).send('Email already taken');
      } else {
        return res.status(500).send('Database error');
      }
    }
  } catch (error) {
    console.error(error);
    return res.status(500).send('Internal server error');
  }
});

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});

function validateEmail(email) {
  // You can implement a more sophisticated email validation if needed
  return /\S+@\S+\.\S+/.test(email);
}