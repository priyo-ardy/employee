const protocol = window.location.protocol;
const hostname = window.location.hostname;
const port = window.location.port;
const baseurl = `${protocol}//${hostname}${port ? ":" + port : ""}`;

const formLogin = document.getElementById("formLogin");
const forgotPassword = document.getElementById("forgotPassword");

const inputForm = {
  email: document.getElementById("email"),
  password: document.getElementById("password"),
  resetEmail: document.getElementById("resetEmail"),
};

const buttons = {
  auth: document.getElementById("btnLogin"),
  reset: document.getElementById("btnReset"),
  cancel: document.getElementById("btnCancel"),
};

const alert = {
  error: document.getElementById("alertError"),
  message: document.getElementById("alertMessage"),
  success: document.getElementById("alertSuccess"),
  message_success: document.getElementById("alertSuccessMessage"),
};

inputForm.email.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    if (inputForm.email.value.trim() === "") {
      inputForm.email.classList.add("is-invalid");
      inputForm.email.parentNode.querySelector(
        ".invalid-feedback"
      ).textContent = "This field is required.";
    } else if (
      !inputForm.email.value.match(
        /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,63}$/
      )
    ) {
      inputForm.email.classList.add("is-invalid");
      inputForm.email.parentNode.querySelector(
        ".invalid-feedback"
      ).textContent = "Invalid email address.";
    } else {
      inputForm.email.classList.remove("is-invalid");
      inputForm.password.focus();
    }
  }
});

inputForm.password.addEventListener("keypress", (e) => {
  if (e.key === "Enter") {
    if (inputForm.password.value.trim() === "") {
      inputForm.password.classList.add("is-invalid");
      inputForm.password.parentNode.querySelector(
        ".invalid-feedback"
      ).textContent = "This field is required.";
    } else {
      inputForm.password.classList.remove("is-invalid");
      prosesLogin();
    }
  }
});

function validasi() {
  let isValid = true;

  if (inputForm.email.value.trim() === "") {
    inputForm.email.classList.add("is-invalid");
    inputForm.email.parentNode.querySelector(".invalid-feedback").textContent =
      "This field is required.";
    isValid = false;
  } else if (
    !inputForm.email.value.match(
      /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,63}$/
    )
  ) {
    inputForm.email.classList.add("is-invalid");
    inputForm.email.parentNode.querySelector(".invalid-feedback").textContent =
      "Invalid email address.";
    isValid = false;
  } else {
    inputForm.email.classList.remove("is-invalid");
  }

  if (inputForm.password.value.trim() === "") {
    inputForm.password.classList.add("is-invalid");
    inputForm.password.parentNode.querySelector(
      ".invalid-feedback"
    ).textContent = "This field is required.";
    isValid = false;
  } else {
    inputForm.password.classList.remove("is-invalid");
  }

  return isValid;
}

buttons.auth.addEventListener("click", () => {
  prosesLogin();
});

function kunciForm() {
  inputForm.email.setAttribute("readonly", true);
  inputForm.password.setAttribute("readonly", true);
  buttons.auth.setAttribute("disabled", true);
  buttons.auth.innerHTML =
    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
}

function bukaForm() {
  inputForm.email.removeAttribute("readonly");
  inputForm.password.removeAttribute("readonly");
  buttons.auth.removeAttribute("disabled");
  buttons.auth.innerHTML = `<i class="fas fa-sign-in-alt me-2"></i> Sign In`;
}
function prosesLogin() {
  if (validasi()) {
    try {
      kunciForm();
      fetchData(baseurl + "/login", "POST", new FormData(formLogin))
        .then((result) => {
          if (!alert.error.hasAttribute("hidden")) {
            alert.error.setAttribute("hidden", true);
          }

          alert.success.removeAttribute("hidden");
          alert.message_success.textContent = result.message;
          setTimeout(() => {
            window.location.href = baseurl + "/dashboard";
          }, 1000);
        })
        .catch((err) => {
          bukaForm();
          alert.error.removeAttribute("hidden");
          alert.message.textContent = err.message;
          return;
        });
    } catch (e) {
      bukaForm();
      alert.error.removeAttribute("hidden");
      alert.message.textContent = e.message;
      return;
    }
  }
}

buttons.reset.addEventListener("click", () => {
  if (inputForm.resetEmail.value.trim() === "") {
    inputForm.resetEmail.classList.add("is-invalid");
    inputForm.resetEmail.parentNode.querySelector(
      ".invalid-feedback"
    ).textContent = "This field is required.";
  } else {
    try {
      inputForm.resetEmail.classList.remove("is-invalid");
      inputForm.resetEmail.setAttribute("readonly", true);
      buttons.reset.innerHTML =
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';

      fetchData(
        baseurl + "/reset-password",
        "POST",
        new FormData(forgotPassword)
      )
        .then((result) => {
          inputForm.resetEmail.classList.remove("is-invalid");
          inputForm.resetEmail.parentNode.querySelector(
            ".invalid-feedback"
          ).textContent = "";
          inputForm.resetEmail.classList.add("is-valid");
          document.getElementById("emailMessage").innerHTML = result.message;
          inputForm.resetEmail.removeAttribute("readonly");
          buttons.reset.innerHTML = `<i class="fas fa-paper-plane me-2"></i>Send Reset Link`;
          alert.success.removeAttribute("hidden");
          alert.message_success.textContent = result.message;
        })
        .catch((err) => {
          inputForm.resetEmail.classList.add("is-invalid");
          inputForm.resetEmail.removeAttribute("readonly");
          inputForm.resetEmail.focus();
          inputForm.resetEmail.parentNode.querySelector(
            ".invalid-feedback"
          ).textContent = err.message;
          buttons.reset.innerHTML = `<i class="fas fa-paper-plane me-2"></i>Send Reset Link`;
        });
    } catch (e) {
      inputForm.resetEmail.classList.add("is-invalid");
      inputForm.resetEmail.removeAttribute("readonly");
      inputForm.resetEmail.focus();
      inputForm.resetEmail.parentNode.querySelector(
        ".invalid-feedback"
      ).textContent = e.message;
      buttons.reset.innerHTML = `<i class="fas fa-paper-plane me-2"></i>Send Reset Link`;
    }
  }
});
