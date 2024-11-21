const form = document.getElementById("form");
const errorContainer = document.querySelector('.error-messages');
form.addEventListener("submit", async (event) => {
    event.preventDefault();

    const data = new FormData(form);

    errorContainer.innerHTML = '';
    try {
    const res = await fetch("http://10.10.139.82:8000/api/patrons", {
        method: "POST",
        body: data,
    });

    const resData = await res.json();
    console.log(resData); 

    if (!res.ok) {
        if (resData.errors && typeof resData.errors === 'object') {
            for (let field in resData.errors) {
                const fieldErrors = resData.errors[field];

                fieldErrors.forEach(errorMessage => {
                    const errorMessageElement = document.createElement('div');
                    errorMessageElement.classList.add('alert', 'alert-danger');
                    errorMessageElement.textContent = ${field.charAt(0).toUpperCase() + field.slice(1)}: ${errorMessage};
                    errorContainer.appendChild(errorMessageElement);
                })
            }
        }
    } else {

        alert("Registration Successful");
    }

    } catch (err) {
        console.log(err.message);
    }
    
});