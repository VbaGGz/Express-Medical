require('dotenv').config();
const express = require('express');
const session = require('express-session');
const path = require('path');
const { getDb, close } = require('./db/database');

const app = express();
const PORT = process.env.PORT || 3000;

// Initialize database on startup
getDb();

app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, '..', 'views'));

app.use(express.urlencoded({ extended: true }));
app.use(express.json());
app.use(express.static(path.join(__dirname, '..', 'public')));

app.use(session({
  secret: process.env.SESSION_SECRET || 'fallback-secret',
  resave: false,
  saveUninitialized: false,
  cookie: { maxAge: 1000 * 60 * 60 * 2 }
}));

// Login page
app.get('/', (req, res) => {
  if (req.session && req.session.user) {
    const dest = { 1: '/employee/homepage', 2: '/hr/homepage', 3: '/admin/homepage' };
    return res.redirect(dest[req.session.user.P_Level] || '/employee/homepage');
  }
  res.render('login', { error: req.query.error || '' });
});

// Routes
app.use('/auth', require('./routes/auth'));
app.use('/admin', require('./routes/admin'));
app.use('/hr', require('./routes/hr'));
app.use('/employee', require('./routes/employee'));

app.listen(PORT, () => {
  console.log('Express Medical running on http://localhost:%d', PORT);
});

process.on('SIGINT', () => { close(); process.exit(); });
process.on('SIGTERM', () => { close(); process.exit(); });
