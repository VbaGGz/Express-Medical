<?php

function generate_taxes($preTAX_income, $married)
{

    $taxes_social = 0;
    $taxes_medicare = 0;
    $taxes_federal = 0;
    $taxes_state = 0;
    $taxes_city = 0;
    $netpay_biweekly = 0;

    $biweekly_income = $preTAX_income / 26;
    $taxable_income = $preTAX_income;
    $netpay = $taxable_income;
    $netpay_biweekly = $taxable_income / 26;


    if ($married == 0 || $married == 2) {

        switch (true) {

            case ($taxable_income <= 9525):
                $netpay -= ($netpay * 0.1);
                break;
            case ($taxable_income > 9525 && $taxable_income <= 38700):
                $netpay -= 952.50 + (($taxable_income - 9525) * 0.12);
                break;
            case ($taxable_income > 38700 && $taxable_income <= 82500):
                $netpay -= 4453.50 + (($taxable_income - 38700) * 0.22);
                break;
            case ($taxable_income > 82500 && $taxable_income <= 157000):
                $netpay -= 14089.50 + (($taxable_income - 82500) * 0.24);
                break;
            case ($taxable_income > 157500 && $taxable_income <= 200000):
                $netpay -= 32089.50 + (($taxable_income - 157500) * 0.32);
                break;
            case ($taxable_income > 200000 && $taxable_income <= 500000):
                $netpay -= 45689.50 + (($taxable_income - 200000) * 0.35);
                break;
            case ($taxable_income > 500000):
                if ($married == 0) { //filing individually
                    $netpay -= 150789.50 + (($taxable_income - 500000) * 0.37);
                    break;
                } else if ($married == 2) { //married but filing separatelly
                    $netpay -= 80689 + (($taxable_income - 300000) * 0.37);
                    break;
                }
            default:
                echo "D:";
                break;
        }

        $netpay_biweekly = $netpay / 26;
        $taxes_federal = ($taxable_income / 26) - $netpay_biweekly;
    }

    if ($married == 1) {

        switch (true) {

            case ($taxable_income <= 19050):
                $netpay -= ($netpay * 0.1);
                break;
            case ($taxable_income > 19050 && $taxable_income <= 77400):
                $netpay -= 1905 + (($taxable_income - 19050) * 0.12);
                break;
            case ($taxable_income > 77400 && $taxable_income <= 165000):
                $netpay -= 8907 + (($taxable_income - 77400) * 0.22);
                break;
            case ($taxable_income > 165000 && $taxable_income <= 315000):
                $netpay -= 28179 + (($taxable_income - 165000) * 0.24);
                break;
            case ($taxable_income > 315000 && $taxable_income <= 400000):
                $netpay -= 64179 + (($taxable_income - 315000) * 0.32);
                break;
            case ($taxable_income > 400000 && $taxable_income <= 600000):
                $netpay -= 91379 + (($taxable_income - 400000) * 0.35);
                break;
            case ($taxable_income > 600000):
                $netpay -= 161379 + (($taxable_income - 400000) * 0.37);
                break;
            default:
                echo "Shits Broken D:";
                break;
        }

        $netpay_biweekly = $netpay / 26;
        $taxes_federal = ($taxable_income / 26) - $netpay_biweekly;
    }

//STATE TAXES
    if ($married == 0 || $married == 2) {
        switch (true) {

            case ($taxable_income <= 8450):
                $netpay -= ($taxable_income * 0.04);
                break;
            case ($taxable_income > 8450 && $taxable_income <= 11650):
                $netpay -= ($taxable_income * 0.045);
                break;
            case ($taxable_income > 11650 && $taxable_income <= 13850):
                $netpay -= ($taxable_income * 0.0525);
                break;
            case ($taxable_income > 13850 && $taxable_income <= 21300):
                $netpay -= ($taxable_income * 0.059);
                break;
            case ($taxable_income > 21300 && $taxable_income <= 80150):
                $netpay -= ($taxable_income * 0.0645);
                break;
            case ($taxable_income > 80150 && $taxable_income <= 214000):
                $netpay -= ($taxable_income * 0.0665);
                break;
            case ($taxable_income > 214000):
                $netpay -= ($taxable_income * 0.0685);
                break;
            default:
                echo "Shits Broken D:";
                break;
        }

        $netpay_biweekly = $netpay / 26;
        $taxes_state = ($taxable_income / 26) - $netpay_biweekly - $taxes_federal;
    }


    if ($married == 1) { //married filing jointly
        switch (true) {

            case ($taxable_income <= 17050):
                $netpay -= ($taxable_income * 0.04);
                break;
            case ($taxable_income > 17050 && $taxable_income <= 23450):
                $netpay -= ($taxable_income * 0.045);
                break;
            case ($taxable_income > 23450 && $taxable_income <= 27750):
                $netpay -= ($taxable_income * 0.0525);
                break;
            case ($taxable_income > 27750 && $taxable_income <= 42750):
                $netpay -= ($taxable_income * 0.059);
                break;
            case ($taxable_income > 42750 && $taxable_income <= 165000):
                $netpay -= ($taxable_income * 0.0645);
                break;
            case ($taxable_income > 165000 && $taxable_income <= 321050):
                $netpay -= ($taxable_income * 0.0665);
                break;
            case ($taxable_income > 321050):
                $netpay -= ($taxable_income * 0.0685);
                break;
            default:
                echo "Shits Broken D:";
                break;
        }

        $netpay_biweekly = $netpay / 26;
        $taxes_state = ($taxable_income / 26) - $netpay_biweekly - $taxes_federal;

    }

//CITY TAXES
    if ($married == 0 || $married == 2) {
        switch (true) {

            case ($taxable_income <= 12000):
                $netpay -= ($taxable_income * 0.02907);
                break;
            case ($taxable_income > 12000 && $taxable_income <= 25000):
                $netpay -= ($taxable_income * 0.0354);
                break;
            case ($taxable_income > 25000 && $taxable_income <= 50000):
                $netpay -= ($taxable_income * 0.03591);
                break;
            case ($taxable_income > 50000 && $taxable_income <= 500000):
                $netpay -= ($taxable_income * 0.03648);
                break;
            case ($taxable_income > 500000):
                $netpay -= ($taxable_income * 0.03876);
                break;
            default:
                echo "Shits Broken D:";
                break;
        }

        $netpay_biweekly = $netpay / 26;

        $taxes_city = ($taxable_income / 26) - $netpay_biweekly - $taxes_federal - $taxes_state;

    }

    if ($married == 1) { //married filling jointly
        switch (true) {
            case ($taxable_income <= 21600):
                $netpay -= ($taxable_income * 0.02907);
                break;
            case ($taxable_income > 21600 && $taxable_income <= 45000):
                $netpay -= ($taxable_income * 0.0354);
                break;
            case ($taxable_income > 45000 && $taxable_income <= 90000):
                $netpay -= ($taxable_income * 0.03591);
                break;
            case ($taxable_income > 90000 && $taxable_income <= 500000):
                $netpay -= ($taxable_income * 0.03648);
                break;
            case ($taxable_income > 500000):
                $netpay -= ($taxable_income * 0.03876);
                break;
            default:
                echo "Shits Broken D:";
                break;
        }

        $netpay_biweekly = $netpay / 26;

        $taxes_city = ($taxable_income / 26) - $netpay_biweekly - $taxes_federal - $taxes_state;

    }
// Social Security

    if ($taxable_income > 128400) {
        $netpay -= 7960.8;

        $netpay_biweekly = $netpay / 26;
        $taxes_social = ($taxable_income / 26) - $netpay_biweekly - $taxes_federal - $taxes_state - $taxes_city;

    } else if ($taxable_income < 128400) {
        $netpay -= (($taxable_income) * 0.062);

        $netpay_biweekly = $netpay / 26;
        $taxes_social = ($taxable_income / 26) - $netpay_biweekly - $taxes_federal - $taxes_state - $taxes_city;
    }

// Medicare

    if (($married == 1) && $taxable_income > 250000) {
        $netpay -= (($taxable_income) * 0.0235);

        $netpay_biweekly = $netpay / 26;
        $taxes_medicare = ($taxable_income / 26) - $netpay_biweekly - $taxes_federal - $taxes_state - $taxes_city - $taxes_social;
    } else if ($married == 2 && $taxable_income > 125000) {
        $netpay -= (($taxable_income) * 0.0235);

        $netpay_biweekly = $netpay / 26;
        $taxes_medicare = ($taxable_income / 26) - $netpay_biweekly - $taxes_federal - $taxes_state - $taxes_city - $taxes_social;
    } else if ($married == 0 && $taxable_income > 200000) {
        $netpay -= (($taxable_income) * 0.0235);

        $netpay_biweekly = $netpay / 26;
        $taxes_medicare = ($taxable_income / 26) - $netpay_biweekly - $taxes_federal - $taxes_state - $taxes_city - $taxes_social;
    } else {
        $netpay -= (($taxable_income) * 0.0145);

        $netpay_biweekly = $netpay / 26;
        $taxes_medicare = ($taxable_income / 26) - $netpay_biweekly - $taxes_federal - $taxes_state - $taxes_city - $taxes_social;
    }

    $financialValues = array(
        "PRETAXbiweeklypay" => $biweekly_income,
        "NETbiweeklypay" => $netpay_biweekly,
        "federal_deductions" => $taxes_federal,
        "state_deductions" => $taxes_state,
        "local_deductions" => $taxes_city,
        "socialsecurity_deductions" => $taxes_social,
        "medicare_deductions" => $taxes_medicare);

    return $financialValues;
}

function generate_finances($grossPay,$married,$children,$k401,$health,$dental,$optical,$life)
{
    $biweekly_income = $grossPay / 26;

    $k401_deductions = 0;
    $health_deductions = 0;
    $dental_deductions = 0;
    $optical_deductions = 0;
    $life_deductions = 0;
    
    if ($health == 1) {
        $biweekly_income -= 167;
        $health_deductions+=167;

        if ($married == 1) {
            $biweekly_income -= 83.5;
            $health_deductions += 83.5;
        }
        if ($children > 0) {
            $biweekly_income -= 83.5 * $children;
            $health_deductions += (83.5 * $children);
        }
        if ($dental == 1)
        {
            $biweekly_income -= 33.5;
            $dental_deductions+=33.5;

            if ($married == 1) {
                $biweekly_income -= 16.75;
                $dental_deductions += 16.75;
            }

            if ($children > 0) {
                $biweekly_income -= 16.75 * $children;
                $dental_deductions += (16.75 * $children);
            }
        }

        if ($optical == 1)
        {
            $biweekly_income -= 33.5;
            $optical_deductions+=33.5;

            if ($married == 1) {
                $biweekly_income -= 16.75;
                $optical_deductions += 33.5;
            }
            if ($children > 0)
            {
                $biweekly_income -= 16.75 * $children;
                $optical_deductions+=(33.5*$children);
            }
        }
    }
    else if ($health == 2) {

        $biweekly_income -= 292;
        $health_deductions+=292;

        if ($married == 1) {
            $biweekly_income -= 146;
            $health_deductions += 146;
        }
        if ($children > 0) {
            $biweekly_income -= 146*$children;
            $health_deductions += (146*$children);
        }
        if ($dental == 1)
        {
            $biweekly_income -= 52;
            $dental_deductions+=52;

            if ($married == 1) {
                $biweekly_income -= 26;
                $dental_deductions += 26;
            }
            if ($children > 0) {
                $biweekly_income -= 26*$children;
                $dental_deductions += 26;
            }
        }
        if ($optical == 1) {
            $biweekly_income -= 52;
            $optical_deductions+=52;

            if ($married == 1) {
                $biweekly_income -= 26;
                $optical_deductions += 26;
            }
            if ($children > 0) {
                $biweekly_income -= 26*$children;
                $optical_deductions += (26*$children);
            }
        }
    }
    else if ($health== 3) {
        $biweekly_income -= 417;
        $health_deductions += 417;

        if ($married == 1) {
            $biweekly_income -= 208.5;
            $health_deductions += 208.5;
        }

        if ($children > 0) {
            $biweekly_income -= 208.5 * $children;
            $health_deductions += (208.5 * $children);
        }

        if ($dental == 1) {
            $biweekly_income -= 83.5;
            $dental_deductions += 83.5;

            if ($married == 1) {
                $biweekly_income -= 41.75;
                $dental_deductions += 41.75;
            }
            if ($children > 0) {
                $biweekly_income -= 41.75 * $children;
                $dental_deductions += (41.75 * $children);
            }
        }

            if ($optical == 1) {
                $biweekly_income -= 83.5;
                $optical_deductions += 83.5;

                if ($married == 1) {
                    $biweekly_income -= 41.75;
                    $optical_deductions += 41.75;
                }
                if ($children > 0) {
                    $biweekly_income -= 41.75 * $children;
                    $optical_deductions += (41.75 * $children);
                }
            }
        }


    if ($life == 1) {
        $biweekly_income -= 62.54;
        $life_deductions += 62.54;
    }
    else if ($life == 2) {
        $biweekly_income -= 100;
        $life_deductions += 100;
    }
    if ($k401 == 1) {
        $biweekly_income -= $biweekly_income * .025;
        $k401_deductions += $biweekly_income * .025;
    }

    $preTAX_income = $biweekly_income * 26;

    $benefits = array (
        "gross_income"                 =>$grossPay/26,
        "taxable_income"               =>$preTAX_income/26,
        "health_insurance_deductions"  =>$health_deductions,
        "dental_insurance_deductions"  =>$dental_deductions,
        "optical_insurance_deductions" =>$optical_deductions,
        "401k_deductions"              =>$k401_deductions,
        "life_insurance_deductions"    =>$life_deductions);

    $finance = generate_taxes($preTAX_income,$married);

    return [$finance,$benefits];
}