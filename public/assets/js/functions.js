console.log("functions.js");
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


function timeAgoOrDate(datetime, full = false, threshold = '1 month') {
    const now = new Date();
    const ago = new Date(datetime);
    const diffMs = now - ago;

    // Helper: parse threshold like "1 month", "2 weeks", "3 days"
    const thresholdDate = (() => {
        const [num, unit] = threshold.split(' ');
        const t = new Date(now);
        switch (unit.toLowerCase()) {
            case 'year':
            case 'years':
                t.setFullYear(t.getFullYear() - num);
                break;
            case 'month':
            case 'months':
                t.setMonth(t.getMonth() - num);
                break;
            case 'week':
            case 'weeks':
                t.setDate(t.getDate() - num * 7);
                break;
            case 'day':
            case 'days':
                t.setDate(t.getDate() - num);
                break;
            case 'hour':
            case 'hours':
                t.setHours(t.getHours() - num);
                break;
            case 'minute':
            case 'minutes':
                t.setMinutes(t.getMinutes() - num);
                break;
            default:
                break;
        }
        return t;
    })();

    // If before threshold → show formatted date
    if (ago < thresholdDate) {
        return ago.toLocaleString('en-US', {
            day: 'numeric',
            month: 'long',
            year: 'numeric',
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        }); // e.g. "2 January 2025, 3:45 PM"
    }

    // Calculate differences
    const diffSeconds = Math.floor(diffMs / 1000);
    const diffMinutes = Math.floor(diffSeconds / 60);
    const diffHours = Math.floor(diffMinutes / 60);
    const diffDays = Math.floor(diffHours / 24);
    const diffWeeks = Math.floor(diffDays / 7);
    const diffMonths = Math.floor(diffDays / 30.4375);
    const diffYears = Math.floor(diffDays / 365.25);

    const string = {
        y: diffYears ? `${diffYears} year${diffYears > 1 ? 's' : ''}` : null,
        m: diffMonths ? `${diffMonths} month${diffMonths > 1 ? 's' : ''}` : null,
        w: diffWeeks ? `${diffWeeks} week${diffWeeks > 1 ? 's' : ''}` : null,
        d: diffDays ? `${diffDays} day${diffDays > 1 ? 's' : ''}` : null,
        h: diffHours % 24 ? `${diffHours % 24} hour${diffHours % 24 > 1 ? 's' : ''}` : null,
        i: diffMinutes % 60 ? `${diffMinutes % 60} minute${diffMinutes % 60 > 1 ? 's' : ''}` : null,
        s: diffSeconds % 60 ? `${diffSeconds % 60} second${diffSeconds % 60 > 1 ? 's' : ''}` : null,
    };

    const filtered = Object.values(string).filter(Boolean);

    if (!full) {
        return filtered.length ? filtered[0] + ' ago' : 'just now';
    }

    return filtered.length ? filtered.join(', ') + ' ago' : 'just now';
}

function formatLabel(string) {
    // Replace underscores with spaces
    string = string.replace(/_/g, ' ');
    // Capitalize each word
    return string.replace(/\b\w/g, char => char.toUpperCase());
}

function getInitials(name) {
    return name
        .split(/[\s_-]+/) // split on space, underscore, or hyphen
        .filter(Boolean)
        .map(word => word[0].toUpperCase())
        .join('');
}

