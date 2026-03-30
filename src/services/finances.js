function generateTaxes(preTaxIncome, married) {
  let taxesSocial = 0;
  let taxesMedicare = 0;
  let taxesFederal = 0;
  let taxesState = 0;
  let taxesCity = 0;

  const biweeklyIncome = preTaxIncome / 26;
  const taxableIncome = preTaxIncome;
  let netpay = taxableIncome;
  let netpayBiweekly = taxableIncome / 26;

  // Federal taxes — single or married-filing-separately
  if (married === 0 || married === 2) {
    if (taxableIncome <= 9525) {
      netpay -= netpay * 0.1;
    } else if (taxableIncome <= 38700) {
      netpay -= 952.50 + (taxableIncome - 9525) * 0.12;
    } else if (taxableIncome <= 82500) {
      netpay -= 4453.50 + (taxableIncome - 38700) * 0.22;
    } else if (taxableIncome <= 157000) {
      netpay -= 14089.50 + (taxableIncome - 82500) * 0.24;
    } else if (taxableIncome <= 200000) {
      netpay -= 32089.50 + (taxableIncome - 157500) * 0.32;
    } else if (taxableIncome <= 500000) {
      netpay -= 45689.50 + (taxableIncome - 200000) * 0.35;
    } else if (married === 0) {
      netpay -= 150789.50 + (taxableIncome - 500000) * 0.37;
    } else {
      netpay -= 80689 + (taxableIncome - 300000) * 0.37;
    }
    netpayBiweekly = netpay / 26;
    taxesFederal = taxableIncome / 26 - netpayBiweekly;
  }

  // Federal taxes — married filing jointly
  if (married === 1) {
    if (taxableIncome <= 19050) {
      netpay -= netpay * 0.1;
    } else if (taxableIncome <= 77400) {
      netpay -= 1905 + (taxableIncome - 19050) * 0.12;
    } else if (taxableIncome <= 165000) {
      netpay -= 8907 + (taxableIncome - 77400) * 0.22;
    } else if (taxableIncome <= 315000) {
      netpay -= 28179 + (taxableIncome - 165000) * 0.24;
    } else if (taxableIncome <= 400000) {
      netpay -= 64179 + (taxableIncome - 315000) * 0.32;
    } else if (taxableIncome <= 600000) {
      netpay -= 91379 + (taxableIncome - 400000) * 0.35;
    } else {
      netpay -= 161379 + (taxableIncome - 400000) * 0.37;
    }
    netpayBiweekly = netpay / 26;
    taxesFederal = taxableIncome / 26 - netpayBiweekly;
  }

  // State taxes — single or married-filing-separately
  if (married === 0 || married === 2) {
    if (taxableIncome <= 8450) {
      netpay -= taxableIncome * 0.04;
    } else if (taxableIncome <= 11650) {
      netpay -= taxableIncome * 0.045;
    } else if (taxableIncome <= 13850) {
      netpay -= taxableIncome * 0.0525;
    } else if (taxableIncome <= 21300) {
      netpay -= taxableIncome * 0.059;
    } else if (taxableIncome <= 80150) {
      netpay -= taxableIncome * 0.0645;
    } else if (taxableIncome <= 214000) {
      netpay -= taxableIncome * 0.0665;
    } else {
      netpay -= taxableIncome * 0.0685;
    }
    netpayBiweekly = netpay / 26;
    taxesState = taxableIncome / 26 - netpayBiweekly - taxesFederal;
  }

  // State taxes — married filing jointly
  if (married === 1) {
    if (taxableIncome <= 17050) {
      netpay -= taxableIncome * 0.04;
    } else if (taxableIncome <= 23450) {
      netpay -= taxableIncome * 0.045;
    } else if (taxableIncome <= 27750) {
      netpay -= taxableIncome * 0.0525;
    } else if (taxableIncome <= 42750) {
      netpay -= taxableIncome * 0.059;
    } else if (taxableIncome <= 165000) {
      netpay -= taxableIncome * 0.0645;
    } else if (taxableIncome <= 321050) {
      netpay -= taxableIncome * 0.0665;
    } else {
      netpay -= taxableIncome * 0.0685;
    }
    netpayBiweekly = netpay / 26;
    taxesState = taxableIncome / 26 - netpayBiweekly - taxesFederal;
  }

  // City taxes — single or married-filing-separately
  if (married === 0 || married === 2) {
    if (taxableIncome <= 12000) {
      netpay -= taxableIncome * 0.02907;
    } else if (taxableIncome <= 25000) {
      netpay -= taxableIncome * 0.0354;
    } else if (taxableIncome <= 50000) {
      netpay -= taxableIncome * 0.03591;
    } else if (taxableIncome <= 500000) {
      netpay -= taxableIncome * 0.03648;
    } else {
      netpay -= taxableIncome * 0.03876;
    }
    netpayBiweekly = netpay / 26;
    taxesCity = taxableIncome / 26 - netpayBiweekly - taxesFederal - taxesState;
  }

  // City taxes — married filing jointly
  if (married === 1) {
    if (taxableIncome <= 21600) {
      netpay -= taxableIncome * 0.02907;
    } else if (taxableIncome <= 45000) {
      netpay -= taxableIncome * 0.0354;
    } else if (taxableIncome <= 90000) {
      netpay -= taxableIncome * 0.03591;
    } else if (taxableIncome <= 500000) {
      netpay -= taxableIncome * 0.03648;
    } else {
      netpay -= taxableIncome * 0.03876;
    }
    netpayBiweekly = netpay / 26;
    taxesCity = taxableIncome / 26 - netpayBiweekly - taxesFederal - taxesState;
  }

  // Social Security
  if (taxableIncome > 128400) {
    netpay -= 7960.8;
  } else {
    netpay -= taxableIncome * 0.062;
  }
  netpayBiweekly = netpay / 26;
  taxesSocial = taxableIncome / 26 - netpayBiweekly - taxesFederal - taxesState - taxesCity;

  // Medicare
  if ((married === 1 && taxableIncome > 250000) ||
      (married === 2 && taxableIncome > 125000) ||
      (married === 0 && taxableIncome > 200000)) {
    netpay -= taxableIncome * 0.0235;
  } else {
    netpay -= taxableIncome * 0.0145;
  }
  netpayBiweekly = netpay / 26;
  taxesMedicare = taxableIncome / 26 - netpayBiweekly - taxesFederal - taxesState - taxesCity - taxesSocial;

  return {
    PRETAXbiweeklypay: biweeklyIncome,
    NETbiweeklypay: netpayBiweekly,
    federal_deductions: taxesFederal,
    state_deductions: taxesState,
    local_deductions: taxesCity,
    socialsecurity_deductions: taxesSocial,
    medicare_deductions: taxesMedicare
  };
}

function generateFinances(grossPay, married, children, k401, health, dental, optical, life) {
  let biweeklyIncome = grossPay / 26;

  let k401Deductions = 0;
  let healthDeductions = 0;
  let dentalDeductions = 0;
  let opticalDeductions = 0;
  let lifeDeductions = 0;

  const planCosts = { 1: 167, 2: 292, 3: 417 };
  const dentalCosts = { 1: 33.5, 2: 52, 3: 83.5 };
  const opticalCosts = { 1: 33.5, 2: 52, 3: 83.5 };

  if (health >= 1 && health <= 3) {
    const base = planCosts[health];
    const dBase = dentalCosts[health];
    const oBase = opticalCosts[health];
    const spouseRate = base / 2;
    const childRate = base / 2;

    biweeklyIncome -= base;
    healthDeductions += base;

    if (married === 1) {
      biweeklyIncome -= spouseRate;
      healthDeductions += spouseRate;
    }
    if (children > 0) {
      biweeklyIncome -= childRate * children;
      healthDeductions += childRate * children;
    }

    if (dental === 1) {
      biweeklyIncome -= dBase;
      dentalDeductions += dBase;
      if (married === 1) {
        biweeklyIncome -= dBase / 2;
        dentalDeductions += dBase / 2;
      }
      if (children > 0) {
        biweeklyIncome -= (dBase / 2) * children;
        dentalDeductions += (dBase / 2) * children;
      }
    }

    if (optical === 1) {
      biweeklyIncome -= oBase;
      opticalDeductions += oBase;
      if (married === 1) {
        biweeklyIncome -= oBase / 2;
        opticalDeductions += oBase / 2;
      }
      if (children > 0) {
        biweeklyIncome -= (oBase / 2) * children;
        opticalDeductions += (oBase / 2) * children;
      }
    }
  }

  if (life === 1) {
    biweeklyIncome -= 62.54;
    lifeDeductions += 62.54;
  } else if (life === 2) {
    biweeklyIncome -= 100;
    lifeDeductions += 100;
  }

  if (k401 === 1) {
    const contribution = biweeklyIncome * 0.025;
    biweeklyIncome -= contribution;
    k401Deductions += contribution;
  }

  const preTaxIncome = biweeklyIncome * 26;

  const benefits = {
    gross_income: grossPay / 26,
    taxable_income: preTaxIncome / 26,
    health_insurance_deductions: healthDeductions,
    dental_insurance_deductions: dentalDeductions,
    optical_insurance_deductions: opticalDeductions,
    '401k_deductions': k401Deductions,
    life_insurance_deductions: lifeDeductions
  };

  const finances = generateTaxes(preTaxIncome, married);
  return { finances, benefits };
}

module.exports = { generateTaxes, generateFinances };
