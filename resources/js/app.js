import "./bootstrap";
import "preline";
import Swal from "sweetalert2";

window.toastAlert = function toastAlert(
    message,
    icon,
    position = "top-end",
    timer = 3000,
    progressbar = true
) {
    let Toast = Swal.mixin({
        toast: true,
        position: position,
        showConfirmButton: false,
        timer: timer,
        timerProgressBar: progressbar,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });
    Toast.fire({
        icon: icon,
        title: message,
    });
};

window.closeAlert = function closeAlert() {
    let Toast = Swal.mixin({
        toast: true,
        position: "top",
        showConfirmButton: false,
        timer: 0.00001,
    });
    Toast.fire({
        icon: "",
        title: "",
    });
};

window.confirmationAlert = function confirmationAlert(params = {}) {
    Swal.fire({
        title: params.title ?? "are you sure?",
        text: params.text ?? "",
        icon: params.icon ?? "warning",
        showCancelButton: params.showCancelButton ?? true,
        confirmButtonText: params.confirmButtonText ?? "confirm",
        cancelButtonText: params.cancelButtonText ?? "cancel",
    }).then((result) => {
        if (result.isConfirmed) {
            window.dispatchEvent(
                new CustomEvent("alert-confirmed", {
                    detail: params.data ?? [],
                })
            );
            return true;
        } else {
            window.dispatchEvent(new CustomEvent("alert-canceled"));
            return false;
        }
    });
};

window.loadingAlert = function loadingAlert(title, message) {
    Swal.fire({
        title: title,
        html: message,
        // icon: "info",
        allowOutsideClick: false,
        showCancelButton: false,
        showConfirmButton: false,
        didOpen: () => {
            Swal.showLoading();
        },
    });
};

window.addEventListener("showToastAlert", function (data) {
    let message = data.detail[0]?.message ?? data.detail.message;
    let icon = data.detail[0]?.icon ?? data.detail.icon;
    window.toastAlert(message, icon);
});

window.addEventListener("closeAlert", function () {
    window.closeAlert();
});

window.addEventListener("showConfirmationAlert", function (data) {
    window.confirmationAlert(data.detail);
});

window.addEventListener("showLoadingAlert", function (data) {
    window.loadingAlert(data.detail.title, data.detail.message);
});

window.callEvent = function callEvent(eventName, data) {
    window.dispatchEvent(new CustomEvent(eventName, { detail: data }));
};

function debounce(func, delay) {
  let timeout;
  return function () {
      const context = this, args = arguments;
      clearTimeout(timeout);
      timeout = setTimeout(() => func.apply(context, args), delay);
  };
}

// Debounced autoInit function
const debouncedAutoInit = debounce(() => {
  HSStaticMethods.autoInit();
}, 500);

// Event listeners with debounced function
window.addEventListener("refreshDatatable", debouncedAutoInit);
window.addEventListener("update-preline", debouncedAutoInit);