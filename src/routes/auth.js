const express = require('express');
const bcrypt = require('bcrypt');
const { getDb } = require('../db/database');

const router = express.Router();

router.post('/login', async (req, res) => {
  const { username, password } = req.body;

  if (!username || !password) {
    return res.redirect('/?error=emptyfields');
  }

  const db = getDb();
  const row = db.prepare('SELECT * FROM Employee_Records WHERE Username = ?').get(username);

  if (!row) {
    return res.redirect('/?error=Wrong Username or Password');
  }

  const match = await bcrypt.compare(password, row.Password);
  if (!match) {
    return res.redirect('/?error=Wrong Username or Password');
  }

  req.session.regenerate((err) => {
    if (err) return res.redirect('/?error=session_error');

    req.session.user = {
      ID: row.ID,
      Username: row.Username,
      First_Name: row.First_Name,
      Last_Name: row.Last_Name,
      DOB: row.DOB,
      Email: row.Email,
      Address: row.Address,
      City: row.City,
      State: row.State,
      Zip_Code: row.Zip_Code,
      SSN: row.SSN,
      Position: row.Position,
      Phone_Number: row.Phone_Number,
      P_Level: row.P_Level
    };

    req.session.save((err) => {
      if (err) return res.redirect('/?error=session_error');
      const dest = { 1: '/employee/homepage', 2: '/hr/homepage', 3: '/admin/homepage' };
      res.redirect(dest[row.P_Level] || '/employee/homepage');
    });
  });
});

router.get('/logout', (req, res) => {
  req.session.destroy(() => res.redirect('/'));
});

module.exports = router;
