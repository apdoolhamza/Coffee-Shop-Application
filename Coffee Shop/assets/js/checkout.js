// format Card Numbers
const cardNumber = document.getElementById('cardNumber');
function formatCardNumber(input) {
    // Remove non-numeric characters
    let value = input.value.replace(/\D/g, "");
    if (value.length > 4){
        // Add space between every 4 numbers
        value = value.replace(/(.{4})/g, "$1 ").trim();
    }
    input.value = value;
}
cardNumber.addEventListener('input', (e) => {
    formatCardNumber(e.target);
})

// format exp. date
const expdate = document.getElementById('expdate');
function formatExpDate(input) {
    // Remove non-numeric characters
    let value = input.value.replace(/\D/g, "");
    if (value.length > 2){
        // Add Backslash(/) between two of them (MM / YY)
        value = value.substring(0, 2) + ' / ' + value.substring(2);
    }
    input.value = value;
}
expdate.addEventListener('input', (e) => {
    formatExpDate(e.target);
})

// format CVV
const cvv = document.getElementById('cvv');
function formatCVV(input) {
    // Remove non-numeric characters
    let value = input.value.replace(/\D/g, "");
    input.value = value;
}
cvv.addEventListener('input', (e) => {
    formatCVV(e.target);
})

// form inputs validation
const formInputs = document.querySelectorAll('form input');
function validateInputs() {
    for (let formInput of formInputs) {
        let inputvalue = formInput.value.trim();
        if (inputvalue === "") {
            formInput.style.boxShadow = "0 0 3px 2px white";
            formInput.style.outline = "1px solid red";
            popUp('Error','Inputs should not be empty!');
            event.preventDefault();
        }
        
    }  
}

// Remove boxShadow and outline of All Form Inputs as soon as mouse-down clicked in the document
document.addEventListener('keydown', () => {
    for (let formInput of formInputs) {
    formInput.style.boxShadow = "none";
    formInput.style.outline = "none";
    }
})

// add boxShadow and outline on any focusing Input as soon as it focused and close popUp
for (let formInput of formInputs) {
    formInput.addEventListener('focus', () => {
        formInput.style.boxShadow = "0 0 3px 2px white";
        formInput.style.outline = "1px solid #535353";
        closePopUp();
    })
    
}

// checkOut Payment Cards
const checkOutCardsIMGS = document.querySelectorAll('.checkOutCards img');
const cardNumContainerIMG = document.querySelector('.cardNumContainer img');

for (let checkOutCardsIMG of checkOutCardsIMGS) {
    checkOutCardsIMG.addEventListener('click', () => {
       cardNumContainerIMG.setAttribute('src', checkOutCardsIMG.getAttribute('src'));

       let checker = checkOutCardsIMG.getAttribute('value');
       if (checker == 1) {
           cardNumContainerIMG.style.width = "37px";
           cardNumContainerIMG.style.marginTop = "16px";
           cardNumContainerIMG.style.marginLeft = "-52px";

           checkOutCardsIMG.classList.add('active');
           checkOutCardsIMGS[1].classList.remove('active');
           checkOutCardsIMGS[2].classList.remove('active');
       } else if (checker == 2) {
           cardNumContainerIMG.style.width = "28px";
           cardNumContainerIMG.style.marginTop = "12px";
           cardNumContainerIMG.style.marginLeft = "-43px";

           checkOutCardsIMG.classList.add('active');
           checkOutCardsIMGS[0].classList.remove('active');
           checkOutCardsIMGS[2].classList.remove('active');
       } else if (checker == 3) {
          cardNumContainerIMG.style.width = "43px";
          cardNumContainerIMG.style.marginTop = "12px";
          cardNumContainerIMG.style.marginLeft = "-57px";

          checkOutCardsIMG.classList.add('active');
           checkOutCardsIMGS[0].classList.remove('active');
           checkOutCardsIMGS[1].classList.remove('active');
       }
        
    })
}