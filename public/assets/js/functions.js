
const date = new Date();

const TODAY  = date.getDate();
const MONTH = date.getMonth() + 1;
const YEAR = date.getFullYear();


function isValidPhoneNumber(phone) {
    // Check if it's exactly 10 digits and contains only numbers
    return /^\d{10}$/.test(phone);
}

