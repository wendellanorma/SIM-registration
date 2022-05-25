const loginForm = document.querySelector('form[name=otpForm]')

loginForm.addEventListener('submit', e => {
  console.log(loginForm)
  var submitButton = loginForm.querySelector("button")
  submitButton.disabled = true
  const errorMessage = loginForm.querySelector('p[class=errormessage]')
  if (errorMessage) {
    errorMessage.remove()
  }
  e.preventDefault()

  const userMobileNoField = loginForm.querySelector('input[name=IndexNumber]')
  console.log(userMobileNoField)
  const userMobileNumber = userMobileNoField.value

    // todo: check if number exist before api is called
    var bodyFormData = new FormData();
    bodyFormData.append('IndexNumber', userMobileNumber);
    bodyFormData.append('indexButton', 'submit');
    axios({
      method: "post",
      url: "https://sim-registration-php.herokuapp.com/UserprofileBackEnd/index.inc.php",
      data: bodyFormData,
      headers: { "Content-Type": "multipart/form-data" },
    })
      
  .then(response => {
    var parser = new DOMParser();
    var htmlDoc = parser.parseFromString(response.data, 'text/html');
    const responseForm = htmlDoc.querySelector('form[name=otpForm]')
    if (responseForm) {
      const errorMessage = responseForm.querySelector('p[class=errormessage]')
      const buttonNode = loginForm.querySelector('button')
      buttonNode.disabled = false
      if (errorMessage) { 
        loginForm.insertBefore(errorMessage, buttonNode) 
      }
    } else {
      axios.post('https://testcode-wendell.herokuapp.com/api/generate_otp', {
        phoneNumber: userMobileNumber
      })
      .then(response => {
        console.log(response)
        if (response.status === 200) {
          window.localStorage.setItem('user', JSON.stringify({
            phoneNumber: userMobileNumber
          }))
          window.location.href = './otp-page.php'
        }
      })
    }
  })
})
