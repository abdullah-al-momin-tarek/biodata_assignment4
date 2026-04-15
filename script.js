document.getElementById('biodataForm').addEventListener('submit', function (e) {
    let valid = true;

    function setError(id, message) {
        document.getElementById(id).textContent = message;
        valid = false;
    }

    function clearError(id) {
        document.getElementById(id).textContent = '';
    }

    // Full Name
    const fullName = document.getElementById('fullName').value.trim();
    if (!fullName) setError('fullNameError', 'Full Name is required.');
    else clearError('fullNameError');

    // Date of Birth
    const dob = document.getElementById('dob').value;
    if (!dob) setError('dobError', 'Date of Birth is required.');
    else clearError('dobError');

    // Age
    const age = parseInt(document.getElementById('age').value);
    if (!age || age < 18 || age > 100) setError('ageError', 'Valid age between 18 and 100 is required.');
    else clearError('ageError');

    // Gender
    const gender = document.getElementById('gender').value;
    if (!gender) setError('genderError', 'Please select a gender.');
    else clearError('genderError');

    // Religion
    const religion = document.getElementById('religion').value.trim();
    if (!religion) setError('religionError', 'Religion is required.');
    else clearError('religionError');

    // Education
    const education = document.getElementById('education').value.trim();
    if (!education) setError('educationError', 'Education is required.');
    else clearError('educationError');

    // Profession
    const profession = document.getElementById('profession').value.trim();
    if (!profession) setError('professionError', 'Profession is required.');
    else clearError('professionError');

    // Father's Name
    const fatherName = document.getElementById('fatherName').value.trim();
    if (!fatherName) setError('fatherNameError', "Father's Name is required.");
    else clearError('fatherNameError');

    // Mother's Name
    const motherName = document.getElementById('motherName').value.trim();
    if (!motherName) setError('motherNameError', "Mother's Name is required.");
    else clearError('motherNameError');

    // Contact Number (10 to 15 digits)
    const contact = document.getElementById('contact').value.trim();
    if (!contact.match(/^[0-9]{10,15}$/)) setError('contactError', 'Enter a valid contact number (10–15 digits).');
    else clearError('contactError');

    // Address
    const address = document.getElementById('address').value.trim();
    if (!address) setError('addressError', 'Address is required.');
    else clearError('addressError');

    if (!valid) {
        e.preventDefault();
    } else {
        alert('Form submitted successfully!');
    }
});
