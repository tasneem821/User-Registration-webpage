function validateWhatsApp() {
    let number = document.getElementById('whats').value.trim();
    if (number.startsWith('01')) {
        number = '2' + number;
    }
    
    fetch('https://whatsapp-number-validator3.p.rapidapi.com/WhatsappNumberHasItBulkWithToken', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-RapidAPI-Key': 'bfcbf612dbmshb02c835b3870c33p149424jsn82ad6d017bca',
            'X-RapidAPI-Host': 'whatsapp-number-validator3.p.rapidapi.com'
        },
        body: JSON.stringify({
            phone_numbers: [number]
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log("Full API Response:", data);

        const result = data[0]; 
        if (result && result.status === "valid") {
            alert("valid WhatsApp number");
        } else {
            console.log("Full API Response:", data);
            alert("this number is not registered on WhatsApp");
        }
    })
    .catch(error => {
        console.error("API Error:", error);
    });
}
