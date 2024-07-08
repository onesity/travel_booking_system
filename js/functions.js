export function success_modal(message) {
    const form_div = document.querySelector('.form-div');
    let msg = document.createElement('h2');
    form_div.innerHTML = '';
    msg.textContent = message;
    msg.id = 'success_msg';
    form_div.append(msg);
}

// export function validateUsername(username) {
//     const pattern = /^[A-Z][A-Za-z0-9_]*$/;
//     return pattern.test(username);
// }


export function validateUsername(username) {
    if (username.length === 0) {
        return { status: false, message: "Please enter username." };
    }

    if (!username.match(/^[a-z_]/)) {
        return { status: false, message: "Username must start with a lowercase alphabet or an underscore." };
    }

    const invalidCharMatch = username.match(/[^a-z0-9_]/);
    if (invalidCharMatch) {
        return { status: false, message: `Invalid character detected: '${invalidCharMatch[0]}'. Username can only contain lowercase letters, numbers, and underscores.` };
    }


    const containsAlphabet = username.match(/[a-z]/);
    if (!containsAlphabet) {
        return { status: false, message: "Username must contain at least one lowercase alphabet." };
    }

    if (username.length < 3) {
        return { status: false, message: "Username must be at least 3 characters long." };
    }
    if (username.length > 20) {
        return { status: false, message: "Username cannot be longer than 20 characters." };
    }

    return { status: true };
}



export function validateEmail(email) {
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!email) {
        return { status: false, message: "Please enter email." };
    }
    if (email.length > 55) {
        return { status: false, message: "Email cannot be longer than 55 characters." };

    }


    if (!emailRegex.test(email)) {
        return { status: false, message: "Invalid email format." };
    }


    const [localPart, domain] = email.split('@');


    if (localPart.startsWith('.') || localPart.endsWith('.')) {
        return { status: false, message: "Local part of the email cannot start or end with a dot." };
    }


    if (localPart.includes('..')) {
        return { status: false, message: "Local part of the email cannot contain consecutive dots." };
    }


    const domainParts = domain.split('.');
    if (domainParts.length < 2) {
        return { status: false, message: "Domain part must contain a dot." };
    }


    for (const part of domainParts) {
        if (!/^[a-zA-Z0-9-]+$/.test(part)) {
            return { status: false, message: `Invalid character in domain part: '${part}'.` };
        }
    }


    const tld = domainParts[domainParts.length - 1];
    if (tld.length < 2 || tld.length > 6) {
        return { status: false, message: "Invalid top-level domain (TLD)." };
    }

    return { status: true };
}


export function validatePassword(password) {

    const uppercaseRegex = /[A-Z]/;
    const lowercaseRegex = /[a-z]/;
    const numberRegex = /[0-9]/;
    const specialCharRegex = /[!@#$%^&*()-=_+{};':"\\|,.<>?/]/;


    if (password == '') {
        return { status: false, message: "Please enter password." };
    }
    if (password.length < 8 || password.length > 16) {
        return { status: false, message: "Password must be between 8 and 16 characters long." };
    }

    if (!uppercaseRegex.test(password[0])) {
        return { status: false, message: "Password must start with an uppercase letter." };
    }

    if (!lowercaseRegex.test(password) || !numberRegex.test(password) || !specialCharRegex.test(password)) {
        return { status: false, message: "Password must contain at least one lowercase letter, one number, and one special character." };
    }

    return { status: true, message: "Password is valid." };
}

export function closeModal(selector) {
    selector.style.display = 'none';
}

export function openModal(selector) {
    selector.style.display = 'block';
}

/**
* Validates if the input is a valid 10-digit Indian phone number
* @param {string} phoneNumber - The phone number to validate
* @returns {boolean} - Returns true if the phone number is valid, otherwise false
*/
export function validateIndianPhoneNumber(phoneNumber) {
    const phoneRegex = /^[6-9]\d{9}$/;  // Regular expression to match a 10-digit phone number starting with 6, 7, 8, or 9
    if (phoneRegex.test(phoneNumber) == true) {
        return { status: true, message: "Phone is valid" };

    } else {

        return { status: false, message: "Invalid phone number!" };
    }
}


export function validateAddress(address) {
    const maxLength = 255;
    const validCharactersRegex = /^[a-zA-Z0-9\s,'-]*$/;

    if (address.trim() === '') {
        return { status: false, message: "Address cannot be empty!" };
    }

    if (address.length > maxLength) {
        return { status: false, message: "Address exceeds 255 characters!" };
    }

    if (validCharactersRegex.test(address)) {
        return { status: true, message: "Valid address!" };
    } else {
        return { status: false, message: "Invalid address!" };
    }
}

export function validateCity(city) {
    const maxLength = 100;
    const validCharactersRegex = /^[a-zA-Z\s,'-]*$/; // Regular expression to match valid characters for city names

    if (city.trim() === '') {
        return { status: false, message: "City cannot be empty!" };
    }

    if (city.length > maxLength) {
        return { status: false, message: "City name exceeds 100 characters!" };
    }

    if (validCharactersRegex.test(city)) {
        return { status: true, message: "Valid city name!" };
    } else {
        return { status: false, message: "Invalid city name!" };
    }
}

export function validateState(state) {
    // console.log(state);
    if (state != 0) {
        return { status: true, message: "Valid state" };
    } else {
        return { status: false, message: "Please select state!" };
    }
}

export function validateZipcode(zipcode) {
    const validZipcodeRegex = /^[1-9][0-9]{5}$/; // Regular expression to match a valid Indian ZIP code
    const numericRegex = /^[0-9]+$/; // Regular expression to match numeric values

    if (zipcode.trim() === '') {
        return { status: false, message: "ZIP code cannot be empty!" };
    }

    if (!numericRegex.test(zipcode)) {
        return { status: false, message: "ZIP code should contain only numeric values!" };
    }

    if (validZipcodeRegex.test(zipcode)) {
        return { status: true, message: "Valid ZIP code!" };
    } else {
        return { status: false, message: "Invalid ZIP code! It should be a 6-digit number starting with a non-zero digit." };
    }
}
