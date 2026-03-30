require('dotenv').config({ path: require('path').resolve(__dirname, '../../.env') });
const bcrypt = require('bcrypt');
const { getDb, close } = require('./database');

async function seed() {
  const db = getDb();

  const existing = db.prepare('SELECT COUNT(*) AS cnt FROM Employee_Records').get();
  if (existing.cnt > 0) {
    console.log('Database already seeded (%d employees). Skipping.', existing.cnt);
    close();
    return;
  }

  const SALT_ROUNDS = 10;

  const employees = [
    {
      password: 'Admin123',
      first: 'Nicholas', last: 'Borghese',
      dob: '1985-03-15', email: 'nborghese@expressmedical.com',
      address: '5500 Hylan Blvd', city: 'Staten Island', state: 'NY', zip: '10306',
      ssn: '111223333', position: 'System Administrator', phone: '17185551001',
      pLevel: 3, grossPay: 95000,
      healthcare: { marital: 1, children: 2, k401: 1, plan: 2, dental: 1, optical: 1, life: 1 }
    },
    {
      password: 'HRpass12',
      first: 'Vincent', last: 'Ippolito',
      dob: '1990-07-22', email: 'vippolito@expressmedical.com',
      address: '123 Victory Blvd', city: 'Staten Island', state: 'NY', zip: '10301',
      ssn: '222334444', position: 'HR Manager', phone: '17185552002',
      pLevel: 2, grossPay: 78000,
      healthcare: { marital: 0, children: 0, k401: 1, plan: 1, dental: 1, optical: 0, life: 1 }
    },
    {
      password: 'Employ99',
      first: 'Carl', last: 'Mendez',
      dob: '1992-11-05', email: 'cmendez@expressmedical.com',
      address: '456 Forest Ave', city: 'Staten Island', state: 'NY', zip: '10310',
      ssn: '333445555', position: 'Nurse', phone: '17185553003',
      pLevel: 1, grossPay: 65000,
      healthcare: { marital: 1, children: 1, k401: 0, plan: 1, dental: 1, optical: 1, life: 0 }
    }
  ];

  const insertEmployee = db.prepare(`
    INSERT INTO Employee_Records
      (Password, First_Name, Last_Name, DOB, Email, Address, City, State, Zip_Code, SSN, Position, Phone_Number, P_Level)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
  `);

  const updateUsername = db.prepare('UPDATE Employee_Records SET Username = ? WHERE ID = ?');

  const insertHealthcare = db.prepare(`
    INSERT INTO Healthcare (ID, Marital_Status, Children, "401k", Healthcare_Plan, Dental, Optical, Life_Insurance_Plan)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
  `);

  const insertFinance = db.prepare('INSERT INTO Employee_Finance (ID, Gross_Pay) VALUES (?, ?)');

  const txn = db.transaction(async (emps) => {
    for (const emp of emps) {
      const hash = await bcrypt.hash(emp.password, SALT_ROUNDS);
      const info = insertEmployee.run(
        hash, emp.first, emp.last, emp.dob, emp.email,
        emp.address, emp.city, emp.state, emp.zip,
        emp.ssn, emp.position, emp.phone, emp.pLevel
      );
      const id = info.lastInsertRowid;
      const username = emp.last + id;
      updateUsername.run(username, id);

      const h = emp.healthcare;
      insertHealthcare.run(id, h.marital, h.children, h.k401, h.plan, h.dental, h.optical, h.life);
      insertFinance.run(id, emp.grossPay);

      console.log('  Created %s (ID %d, P_Level %d, user: %s)', emp.first + ' ' + emp.last, id, emp.pLevel, username);
    }
  });

  // better-sqlite3 transactions are synchronous, but bcrypt is async, so we run outside txn
  const hashes = [];
  for (const emp of employees) {
    hashes.push(await bcrypt.hash(emp.password, SALT_ROUNDS));
  }

  const syncTxn = db.transaction((emps, pwdHashes) => {
    for (let i = 0; i < emps.length; i++) {
      const emp = emps[i];
      const info = insertEmployee.run(
        pwdHashes[i], emp.first, emp.last, emp.dob, emp.email,
        emp.address, emp.city, emp.state, emp.zip,
        emp.ssn, emp.position, emp.phone, emp.pLevel
      );
      const id = info.lastInsertRowid;
      const username = emp.last + id;
      updateUsername.run(username, id);

      const h = emp.healthcare;
      insertHealthcare.run(id, h.marital, h.children, h.k401, h.plan, h.dental, h.optical, h.life);
      insertFinance.run(id, emp.grossPay);

      console.log('  Created %s (ID %d, P_Level %d, user: %s)', emp.first + ' ' + emp.last, id, emp.pLevel, username);
    }
  });

  console.log('Seeding database...');
  syncTxn(employees, hashes);
  console.log('Done. %d employees created.', employees.length);

  close();
}

seed().catch(err => {
  console.error('Seed failed:', err);
  process.exit(1);
});
