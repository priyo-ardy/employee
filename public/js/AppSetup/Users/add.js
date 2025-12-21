const formData = document.getElementById("formData");

const buttons = {
  save: document.getElementById("btnSave"),
  cancel: document.getElementById("btnCancel"),
  close: document.getElementById("btnClose"),
};

const inputForm = {
  user_name: document.getElementById("data_username"),
  full_name: document.getElementById("data_fullname"),
  user_email: document.getElementById("data_email"),
  user_phone: document.getElementById("data_phone"),
  user_level: document.getElementById("data_level"),
  user_password: document.getElementById("data_password"),
};

const email_regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,63}$/;

function validasi() {
  let isValid = true;

  const requiredElement = document.querySelectorAll("[required]");
  if (requiredElement.length > 0) {
    requiredElement.forEach((element) => {
      if (element.value.trim() === "") {
        element.classList.add("is-invalid");
        element.parentNode.querySelector(".invalid-feedback").textContent =
          "This field is required.";
        isValid = false;
      } else {
        element.classList.remove("is-invalid");
      }
    });

    if (!inputForm.user_email.value.match(email_regex)) {
      inputForm.user_email.classList.add("is-invalid");
      inputForm.user_email.parentNode.querySelector(
        ".invalid-feedback"
      ).textContent = "Invalid email address.";
      isValid = false;
    } else {
      inputForm.user_email.classList.remove("is-invalid");
    }
  }

  return isValid;
}

inputForm.user_name.onchange = () => {
  if (inputForm.user_name.value.trim() === "") {
    inputForm.full_name.value = "";
  } else {
    try {
      loading();
      fetchData(baseurl + "/users/" + btoa(inputForm.user_name.value), "GET")
        .then((result) => {
          console.log(result.data);
          inputForm.full_name.value = result.data.nama_karyawan;
          hideLoading();
        })
        .catch((err) => {
          pesanError(err.message);
          hideLoading();
        });
    } catch (e) {
      pesanError(e.message);
      hideLoading();
    }
  }
};

function resetForm() {
  formData.reset();
  $(inputForm.user_name).trigger("change");
  $(inputForm.user_level).trigger("change");
  inputForm.user_name.focus();
}

buttons.cancel.addEventListener("click", () => {
  resetForm();
});

buttons.close.addEventListener("click", () => {
  loading();
  window.location.href = baseurl + "/users";
});

buttons.save.addEventListener("click", () => {
  if (validasi()) {
    try {
      loading();
      fetchData(baseurl + "/users/save", "POST", new FormData(formData))
        .then((result) => {
          pesanSukses(result.message);
          hideLoading();
        })
        .catch((err) => {
          pesanError(err.message);
          hideLoading();
        });
    } catch (e) {
      pesanError(e.message);
      hideLoading();
    }
  }
});
