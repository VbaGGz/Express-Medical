const express = require('express');
const { requireRole } = require('../middleware/auth');
const { getDb } = require('../db/database');
const { generateFinances } = require('../services/finances');

const router = express.Router();
router.use(requireRole(1));

const NAV_ITEMS = [
  { id: 'Home', label: 'Home', href: '/employee/homepage' },
  { id: 'My Info', label: 'My Info', href: '/employee/info' },
  { id: 'My Benefits', label: 'My Benefits', href: '/employee/benefits' },
  { id: 'My Taxes', label: 'My Finances', href: '/employee/taxes' },
  { id: 'Contact', label: 'Contact', href: '/employee/contact' },
];

function locals(req, currentPage, extra) {
  return { user: req.session.user, navItems: NAV_ITEMS, currentPage, role: 'employee', ...extra };
}

router.get('/homepage', (req, res) => {
  res.render('employee/homepage', locals(req, 'Home'));
});

router.get('/info', (req, res) => {
  const db = getDb();
  const healthcare = db.prepare('SELECT * FROM Healthcare WHERE ID = ?').get(req.session.user.ID);
  res.render('employee/info', locals(req, 'My Info', { healthcare }));
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

  res.render('employee/taxes', locals(req, 'My Taxes', { finances: result.finances, benefits: result.benefits }));
});

router.get('/contact', (req, res) => {
  const db = getDb();
  const employees = db.prepare('SELECT ID, First_Name, Last_Name, Email, Position, Phone_Number FROM Employee_Records').all();
  res.render('employee/contact', locals(req, 'Contact', { employees }));
});

router.get('/profile', (req, res) => {
  const db = getDb();
  const emp = db.prepare('SELECT * FROM Employee_Records WHERE ID = ?').get(req.query.ID);
  res.render('employee/profile', locals(req, 'Contact', { employee: emp }));
});

router.get('/benefits', (req, res) => {
  const db = getDb();
  const hc = db.prepare('SELECT * FROM Healthcare WHERE ID = ?').get(req.session.user.ID);
  res.render('employee/benefits', locals(req, 'My Benefits', { healthcare: hc }));
});

module.exports = router;
