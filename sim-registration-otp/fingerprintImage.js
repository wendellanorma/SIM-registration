const reportForm = document.querySelector('form#fingerprintlocal')

reportForm.addEventListener('submit', e => {
  e.preventDefault()

  console.log(reportForm)
  const imageFile = document.querySelector('input#exampleFormControlFile1').files[0]
  console.log(imageFile)
  const formData = new FormData()
  formData.append('image', imageFile)
  const config = {
      headers: {
          "Content-Type" : "multipart/form-data"
      }
  }
  axios.post('https://testcode-wendell.herokuapp.com/api/fingerprintUpload', formData, config)
    .then(response => {
      console.log(response)
      if (response.status === 200) {
        var bodyFormData = new FormData();
        bodyFormData.append('address', document.querySelector("input#address").value);
        bodyFormData.append('simcard', document.querySelector("select").value);
        bodyFormData.append('regisite', document.querySelector("input#regisite").value);
        bodyFormData.append('dateofregis', document.querySelector("input#dateregis").value);
        bodyFormData.append('simnum', document.querySelector("input#simnum").value);
        bodyFormData.append('ImageUrl', response.data.imageUrl);
        bodyFormData.append('reportbutton', 'submit');
        axios({
            method: "post",
            url: "https://sim-registration-php.herokuapp.com/includes/register_fingerprint.php",
            data: bodyFormData,
            headers: { "Content-Type": "multipart/form-data" },
        }).then(response => {
            console.log(response)                
            window.location.href = './register-users-local.php?signup=success'
        })
      } 
    })
    .catch(reason => {
        const error = reason.response.data.error
        switch (error) {
            case 'No file attached':
                window.location.href = './profile-user.php?reportPage&ReportStatus=imageempty'
                break
            case 'File too large':
                window.location.href = './profile-user.php?reportPage&ReportStatus=imagelarge'
                break
            case 'Invalid data type':
                window.location.href = './profile-user.php?reportPage&ReportStatus=imageformaterror'
                break
        }
    })
})


// <form class='' id='form' action='UserprofileBackEnd/Back_End_User_Profile.php' method='POST'>
