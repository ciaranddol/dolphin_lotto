const { Client } = require('pg');

// Connection details
const host = 'db.fuhzxgckcobvsvhkqppo.supabase.co';
const databaseName = 'postgres';
const port = 5432;
const user = 'postgres';
const password = 'buckbeak1901!';

// Connection string
const connectionString = `postgresql://${user}:${password}@${host}:${port}/${databaseName}`;

// Create a new PostgreSQL client
const client = new Client({
  connectionString: connectionString,
});

// Connect to the database
client.connect()
  .then(() => {
    console.log('Connected to the database');

    // You can perform database operations here

    // Don't forget to close the connection when done
    client.end()
      .then(() => console.log('Connection closed'))
      .catch((err) => console.error('Error closing connection', err));
  })
  .catch((err) => {
    console.error('Error connecting to the database', err);
  });