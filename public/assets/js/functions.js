
const date = new Date();

const TODAY = date.getDate();
const MONTH = date.getMonth() + 1;
const YEAR = date.getFullYear();

function getWeekNumber(date = new Date()) {
  // Copy date so we don’t mutate the original
  const d = new Date(Date.UTC(date.getFullYear(), date.getMonth(), date.getDate()));

  // Set to nearest Thursday: ISO week starts on Monday
  d.setUTCDate(d.getUTCDate() + 4 - (d.getUTCDay() || 7));

  // Get first day of year
  const yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));

  // Calculate full weeks to nearest Thursday
  const weekNo = Math.ceil((((d - yearStart) / 86400000) + 1) / 7);

  return weekNo;


}

const WEEK = getWeekNumber();



function isValidPhoneNumber(phone) {
  // Check if it's exactly 10 digits and contains only numbers
  return /^\d{10}$/.test(phone);
}

function isValidEmail(email) {
  // Simple regex for basic email validation
  const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return regex.test(email);
}

async function setAnalytics(units, where = {}) {
  let url = ROOT + 'OrdersController/ordersByDateCanteen';

  const res = await fetch(url, {
    method: 'POST',
    headers: {
      "Content-type": "application/json"
    },
    body: JSON.stringify({
      units: units,
      data: where
    })
  });

  const data = await res.json();
  return data; // returns a Promise that resolves to the data
}