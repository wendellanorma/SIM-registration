const otpForm = document.querySelector('form')

otpForm.addEventListener('submit', e => {
  e.preventDefault()

  const otpField = otpForm.querySelector('input[name=otpName]')
  const otpNumber = otpField.value
  const user = JSON.parse(window.localStorage.getItem('user'))

  axios.post('https://testcode-wendell.herokuapp.com/api/validate_otp', {
    phoneNumber: user.phoneNumber,
    token: otpNumber
  })
    .then(response => {
      console.log(response)
      if (response.status === 200) {
        window.location.href = './profile-user.php'
      } 
    })
    .catch(reason => {
        alert('Invalid OTP : ' + reason.message)
        console.log(reason)
    })
})
