function calculateAge(day, month, year) {
    const today = new Date();
    const birthDate = new Date(year, month - 1, day);
    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
}

function validateForm() {
    const day = parseInt(document.getElementById('day').value, 10);
    const month = parseInt(document.getElementById('month').value, 10);
    const year = parseInt(document.getElementById('year').value, 10);
    const gender = document.querySelector('input[name="gender"]:checked');
    const message = document.getElementById('message');

    if (!gender) {
        message.textContent = 'Оберіть стать!';
        return;
    }

    if (isNaN(day) || isNaN(month) || isNaN(year)) {
        message.textContent = 'Некоректна дата народження!';
        return;
    }

    const age = calculateAge(day, month, year);

    if ((gender.value === 'male' && age < 21) || (gender.value === 'female' && age < 18)) {
        message.textContent = 'Не можна зареєструватися';
        message.style.color = 'red'
    } else {
        message.textContent = 'Реєстрація успішна!';
        message.style.color = 'green';
    }
}