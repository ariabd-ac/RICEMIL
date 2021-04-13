const form = document.querySelector(".card-register form"),
  continueBtn = form.querySelector(".card-register button"),
  errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
  e.preventDefault();
}

// continueBtn.onclick = () => {
//   alert('hshsjdshj')
// }

continueBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/signup.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        console.log('data: ', data)
        if (data === "success") {
          location.href = "./src/index.php";
        } else {
          errorText.style.display = "block";
          errorText.textContent = data;
        }
      }
    }
  }
  let formData = new FormData(form);
  xhr.send(formData);
}