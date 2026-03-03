document.addEventListener("DOMContentLoaded", () => {

  const forms = document.querySelectorAll("form");

  forms.forEach((form) => {
    const btn = form.querySelector(".add-btn");
    if (!btn) return;

    form.addEventListener("submit", (e) => {

      e.preventDefault();

      btn.classList.remove("added");
      void btn.offsetWidth;
      btn.classList.add("added");

      setTimeout(() => {
        form.submit();
      }, 180);

    });
  });

});