// Initialize Nette Forms on page load
import netteForms from "nette-forms";

netteForms.initOnLoad();

document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".flash").forEach((flash) => {
    const timeout = parseInt(flash.dataset.timeout || 4000, 10);

    const hide = () => {
      flash.classList.add("hide");
      setTimeout(() => flash.remove(), 300);
    };

    setTimeout(hide, timeout);

    flash.querySelector(".flash-close")?.addEventListener("click", hide);
  });
});
