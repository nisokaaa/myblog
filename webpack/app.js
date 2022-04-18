const express = require('express')
const path = require('path')
const app = express()
const PORT = 2000;
const HOST = '0.0.0.0';

app.get('/', (req, res) => res.send('Hello World!'))

app.listen(PORT, HOST)
console.log(`Running on http://${HOST}:${PORT}`)