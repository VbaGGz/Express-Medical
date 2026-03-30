const express = require('express');
const bcrypt = require('bcrypt');
const { requireRole } = require('../middleware/auth');
const { getDb } = require('../db/database');
const { generateFinances } = require('../services/finances');

const router = express.Router();
router.use(requireRole(2));

const NAV_ITEMS = [
  { id: 'Home', label: 'Home', href: '/hr/homepage' },
  { id: 'My Info', label: 'My Info', href: '/hr/info' },
  { id: 'My Benefits', label: 'Edit Benefits', href: '/hr/benefits' },
  { id: 'My Taxes', label: 'My Finances', href: '/hr/taxes' },
  { id: 'Add Employee', label: 'Add Employee', href: '/hr/add-employee' },
  { id: 'Edit Employee', label: 'Edit Employee', href: '/hr/edit-employee' },
  { id: 'Contact', label: 'Contact', href: '/hr/contact' },
];

function locals(req, currentPage, extra) {
  return { user: req.session.user, navItems: NAV_ITEMS, currentPage, role: 'hr', ...extra };
}

router.get('/homepage', (req, res) => {
  res.render('hr/homepage', locals(req, 'Home'));
});

router.get('/info', (req, res) => {
  const db = getDb();
  const healthcare = db.prepare('SELECT * FROM Healthcare WHERE ID = ?').get(req.session.user.ID);
  res.render('hr/info', locals(req, 'My Info', { healthcare }));
});

router.get('/taxes', (req, res) => {
  const db = getDb();
  const finance = db.prepare('SELECT * FROM Employee_Finance WHERE ID = ?').get(req.session.user.ID);
  const healthcare = db.prepare('SELECT * FROM Healthcare WHERE ID = ?').get(req.session.user.ID);

  const grossPay = finance ? finance.Gross_Pay : 0;
  const hc = healthcare || {};
  const result = generateFinances(
    grossPay,
    hc.Marital_Status || 0, hc.Children || 0, hc['401k'] || 0,
    hc.Healthcare_Plan || 0, hc.Dental || 0, hc.Optical || 0,
    hc.Life_Insurance_Plan || 0
  );

  res.render('hr/taxes', locals(req, 'My Taxes', { finances: result.finances, benefits: result.benefits }));
});

router.get('/contact', (req, res) => {
  const db = getDb();
  const employees = db.prepare('SELECT ID, First_Name, Last_Name, Email, Position, Phone_Number FROM Employee_Records').all();
  res.render('hr/contact', locals(req, 'Contact', { employees }));
});

router.get('/profile', (req, res) => {
  const db = getDb();
  const emp = db.prepare('SELECT * FROM Employee_Records WHERE ID = ?').get(req.query.ID);
  res.render('hr/profile', locals(req, 'Contact', { employee: emp }));
});

router.get('/add-employee', (req, res) => {
  res.render('hr/addEmployee', locals(req, 'Add Employee', { error: req.query.error }));
});

router.post('/add-employee', async (req, res) => {
  const db = getDb();
  const { Password, First_Name, Last_Name, DOB, Email, Address, City, State, Zip_Code, SSN, Position, Phone_Number } = req.body;

  const hash = await bcrypt.hash(Password, 10);
  const info = db.prepare(`
    INSERT INTO Employee_Records (Password, First_Name, Last_Name, DOB, Email, Address, City, State, Zip_Code, SSN, Position, Phone_Number)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
  `).run(hash, First_Name, Last_Name, DOB, Email, Address, City, State, Zip_Code, SSN, Position, Phone_Number);

  const id = info.lastInsertRowid;
  const username = Last_Name + id;
  db.prepare('UPDATE Employee_Records SET Username = ? WHERE ID = ?').run(username, id);
  db.prepare('INSERT INTO Healthcare (ID) VALUES (?)').run(id);
  db.prepare('INSERT INTO Employee_Finance (ID, Gross_Pay) VALUES (?, 0)').run(id);

  res.redirect('/hr/add-employee?error=Successfully Added New User, ID = ' + id);
});

router.get('/edit-employee', (req, res) => {
  res.render('hr/editEmployee', locals(req, 'Edit Employee', { employee: null, error: req.query.error }));
});

router.post('/edit-employee/search', (req, res) => {
  const db = getDb();
  const emp = db.prepare('SELECT * FROM Employee_Records WHERE ID = ?').get(req.body.ID);
  res.render('hr/editEmployee', locals(req, 'Edit Employee', { employee: emp, error: null }));
});

router.post('/edit-employee/update', (req, res) => {
  const db = getDb();
  const id = req.query.ID;
  const { First_Name, Last_Name, DOB, Email, Address, City, State, Zip, Position, Phone_Number } = req.body;

  db.prepare(`
    UPDATE Employee_Records
    SET First_Name=?, Last_Name=?, DOB=?, Email=?, Address=?, City=?, State=?, Zip_Code=?, Position=?, Phone_Number=?
    WHERE ID=?
  `).run(First_Name, Last_Name, DOB, Email, Address, City, State, Zip, Position, Phone_Number, id);

  res.redirect('/hr/edit-employee?error=Success');
});

router.get('/benefits', (req, res) => {
  res.render('hr/benefits', locals(req, 'My Benefits', { healthcare: null, error: req.query.error }));
});

router.post('/benefits/search', (req, res) => {
  const db = getDb();
  const hc = db.prepare('SELECT * FROM Healthcare WHERE ID = ?').get(req.body.ID);
  res.render('hr/benefits', locals(req, 'My Benefits', { healthcare: hc, error: null }));
});

router.post('/benefits/update', (req, res) => {
  const db = getDb();
  const id = req.query.ID;
  const { Marital_Status, Children, k401, Healthcare_Plan, Dental, Optical, Life_Insurance_Plan } = req.body;

  db.prepare(`
    UPDATE Healthcare
    SET Marital_Status=?, Children=?, "401k"=?, Healthcare_Plan=?, Dental=?, Optical=?, Life_Insurance_Plan=?
    WHERE ID=?
  `).run(
    parseInt(Marital_Status) || 0, parseInt(Children) || 0, parseInt(k401) || 0,
    parseInt(Healthcare_Plan) || 0, parseInt(Dental) || 0, parseInt(Optical) || 0,
    parseInt(Life_Insurance_Plan) || 0, id
  );
  res.redirect('/hr/benefits?error=Success');
});

module.exports = router;
