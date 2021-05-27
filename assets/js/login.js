const form = document.querySelector(".content form"),
  continueBtn = form.querySelector(".content button"),
  errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
  e.preventDefault();
}

// continueBtn.onclick = () => {
//   alert('hshsjdshj');
// }

continueBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/login.php", true);

  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        console.log('status', data);
        if (data === "reseller") {
          location.href = "./reseller/";
        } if (data === "admin") {
          location.href = "./admin/";
        } if (data === "gudang") {
          location.href = "./gudang/";
        } if (data === "kasir") {
          location.href = "./kasir/";
        } if (data === "supplier") {
          location.href = "./supplier/";
        }

        else {
          errorText.style.display = "block";
          errorText.textContent = data;
        }
      }
    }
  }
  let formData = new FormData(form);
  xhr.send(formData);
}